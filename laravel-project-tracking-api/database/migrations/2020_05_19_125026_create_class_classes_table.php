<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_class_id');
            $table->unsignedBigInteger('child_class_id');
            $table->enum('association_type', ['parent_child', 'parent_extends', 'parent_includes']);
            $table->timestamps();

            $table->foreign('parent_class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('child_class_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_classes');
    }
}
