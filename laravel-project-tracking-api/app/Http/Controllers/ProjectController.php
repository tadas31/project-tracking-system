<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Resources\Project as ProjectResources;
use App\ProjectUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Displays all projects.
     * 
     * TODO: Add search.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Gets all public projects
        $projects = Project::all();

        if (sizeof($projects) > 0)
            return ProjectResources::collection($projects);

        return response()->json(['error' => 'No projects found.'], 404);
    }

    /**
     * Creates new project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // Validates user input.
        $validator = $this->validator($request);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        // Adds user id to request array.
        $request['user_id'] = auth()->user()->id;

        // Creates new project.
        Project::create($request->all());

        return response()->json(['message' => 'Project created.'], 200);
    }

    /**
     * Displays specific project.
     * 
     * TODO: add all classes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            // Gets project form db.
            $project = Project::FindOrFail($id);
            return new ProjectResources($project);
        }
        catch (Exception $ex) {
            return response()->json(['error' => 'Project not found.'], 404);
        }
    }

    /**
     * Displays all projects that user is part of.
     * 
     * TODO: Add filters for owned and is added to.
     * TODO: Add search.
     */
    public function showAssociatedProjects() {
        $user = auth()->user();

        // Gets all owned projects.
        $ownedProjects = $user->ownedProjects;
        // Gets all projects user was added to.
        $partOfProjects = $user->projectUser;
        
        // Creates joined collection of all projects that user is part of.
        $projects = $ownedProjects;
        foreach($partOfProjects as $partOfProject) {
            $projects->push($partOfProject->project);
        }

        if (sizeof($projects) > 0)
            return ProjectResources::collection($projects);
        
        return response()->json(['error' => 'No projects found.'], 404);
    }

    /**
     * Displays all public projects.
     * Search public projects.
     * 
     * TODO: Add search.
     */
    public function showPublicProjects() {
        $search = request()->input('search');

        if ($search != null) {
            // Searches for public projects that match search query
            $projects = Project::where('is_public', true)
                ->where('name', 'LIKE', '%'.$search.'%')
                ->get();
        }
        else {
            // Gets all public projects
            $projects = Project::where('is_public', true)->get();
        }

        if (sizeof($projects) > 0)
            return ProjectResources::collection($projects);

        return response()->json(['error' => 'No projects found.'], 404);
    }

    /**
     * Updates project data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        // Validates user input.
        $validator =  $validator = Validator::make($request->all(), [
            'is_public' => 'numeric|max:1|min:0',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        try {
            // Gets project
            $project = Project::FindOrFail($id);

            // New data for project.
            $updateData = [
                'name' => $request->name != null ? $request->name : $project->name,
                'description' => $request->description != null ? $request->description : $project->description,
                'git_repository' => $request->git_repository != null ? $request->git_repository : $project->git_repository,
                'is_public' => $request->is_public != null ? $request->is_public : $project->is_public,
            ];
            
            // Updates project.
            $project->update($updateData);

            return response()->json(['message' => 'Project updated.'], 200);
        }
        catch (Exception $ex) {
            return response()->json(['error' => 'Project not found.'], 404);
        }
    }

    /**
     * Updates project notes.
     */
    public function updateNotes(Request $request, $id) {
        try {
            // Gets project.
            $project = Project::FindOrFail($id);

            // Updates project notes.
            $project->update([
                'notes' => $request->notes,
            ]);

            return response()->json(['message' => 'Project notes updated.'], 200);
        }
        catch (Exception $ex) {
            return response()->json(['error' => 'Project not found.'], 404);
        }
    }

    /**
     * Deletes project.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $project = Project::FindOrFail($id);
            $project->delete();

            return response()->json(['message' => 'Project deleted.'], 200);
        }
        catch (Exception $ex) {
            return response()->json(['error' => 'Project not found.'], 404);
        }
    }

    /**
     * Validation rules for user input.
     */
    public function validator($request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'is_public' => 'numeric|max:1|min:0'
        ]);

        return $validator;
    }
}
