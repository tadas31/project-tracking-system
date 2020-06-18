<?php

namespace App\Http\Middleware;

use App\Project;
use Closure;
use Exception;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $requiredPermissions = null)
    {
        // Gets id from route
        $id = $request->route('id');

        try {
            // If user owns project he can perform action.
            $project = Project::FindOrFail($id);
            if (auth('user')->user()->id == $project->user_id)
                return $next($request);

            // If user is part of project checks if he has permission to perform action.
            if ($requiredPermissions != null) {
                $partOfProject = auth()->user()->projectUser
                    ->where('project_id', $id)
                    ->first();

                if ($partOfProject == null) 
                    return response()->json(['error' => 'Project not found.'], 404);

                $requiredPermissions = explode("|", $requiredPermissions);
                $partOfProject = $partOfProject->whereIn('project_permissions', $requiredPermissions)
                    ->first();

                if ($partOfProject != null)
                    return $next($request);

                return response()->json(['error' => 'User does not have permission to perform this action.'], 403);
            }
           
            return response()->json(['error' => 'Project not found.'], 404);

        }
        catch (Exception $ex) {
            return response()->json(['error' => 'Project not found.'], 404);
        }
    }
}
