<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $types= Type::orderBY('name','asc')->get();

        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //
        $form_data = $request->validated();

        //$form_data = $request->all();

        $base_slug = Str::slug($form_data['title']);
        $slug = $base_slug;
        $n = 0;
        do{
            $find = Project::where('slug', $slug)->first();
            if($find !== null){
                $n++;
                $slug = $base_slug .'-'. $n;
            }
        }while($find !== null);
        $form_data['slug'] = $slug;

        $new_project = Project::create($form_data);

        $new_project->technologies()->sync($form_data['technologies']);
      
 
    




        return to_route('admin.projects.index', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //

        $technologies = Technology::all();

        return view('admin.projects.show', compact('project', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
        $types = Type::all();

        $technologies = Technology::all();
        
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
        $request->validated();
        
        $form_data = $request->all();

        $base_slug = Str::slug($form_data['title']);
        $slug = $base_slug;
        $n = 0;
        do{
            $find = Project::where('slug', $slug)->first();
            if($find !== null){
                $n++;
                $slug = $base_slug .'-'. $n;
            }
        }while($find !== null);
        $form_data['slug'] = $slug;



        



        $project->fill($form_data); //non salva automaticamente sul db
        
        // se qui dobbiamo fare qualcos'altro
        $project->save();

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            
            $project->technologies()->detach();
            
        }

        //redirect alla comics show
        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        $project->delete();

        return to_route('admin.projects.index');
    }
}
