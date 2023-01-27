<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('technologies', 'type')->paginate(5);

        foreach($projects as $project){
            if($project->cover_image){
                $project->cover_image = url('storage/' . $project->cover_image);
            }else {
                $project->cover_image = 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png';
            }
        }

        return response()->json(compact('projects'));
    }


    public function details($slug){

        $project = Project::where('slug', $slug)->with('technologies', 'type')->first();

        $project->cover_image?
        $project->cover_image = url('storage/' . $project->cover_image) :
        $project->cover_image = 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png';

        return response()->json($project);

    }
}
