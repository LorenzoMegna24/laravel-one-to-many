<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Support\facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // validazione
        /*$request->validate(
            [
                'project_title' => 'required|unique:project|max:200',
            ],
            [
                'project_title.required' => 'Il campo titolo è obbligatorio',
                'project_title.unique' => 'Il campo titolo è già esistente',
                'project_title.max' => 'Il campo titolo ha superato il limite di caratteri'
            ]
        );*/

        //$form_data = $request->all();
        $form_data = $request->validated();

        // trasformazione slug
        $slug = Project::generateSlug($request->project_title);

        $form_data['slug'] = $slug;

        // caricamento immagine
        if ($request->hasFile('img')) {

            $path = Storage::disk('public')->put('project_images', $request->img);

            $form_data['img'] = $path;
        }

        //fill
        $new_project = Project::create($form_data);
        // $new_project = new Project();

        // $new_project->fill($form_data);
        // $new_project->save();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
                /*$request->validate(
            [
                'project_title' => 'required|max:200',
            ],
            [
                'project_title.required' => 'Il campo titolo è obbligatorio',
                'project_title.max' => 'Il campo titolo ha superato il limite di caratteri'
            ]
        );*/

        //$form_data = $request->all();
        $form_data = $request->validated();

        // trasformazione slug
        $slug = Project::generateSlug($request->project_title);

        $form_data['slug'] = $slug;

        $project->update($form_data);
        return redirect()->route('admin.projects.index')->with('success', "Hai modificato correttamente il progetto:$project->project_title ");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->img) {
            Storage::delete($project->img);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index');

    }
}
