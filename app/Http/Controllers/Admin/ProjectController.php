<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $projects = Project::with(['type', 'type.projects'])->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $types = Type::all();
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

        $base_slug = Str::slug($form_data['name']);
        $slug = $base_slug;

        $n = 1;

        do {
            $find = Project::where('slug', $slug)->first();

            if ($find !== null) {
                $slug = $base_slug . '-' . $n;
                $n++;
            }
        } while ($find !== null);

        $form_data['slug'] = $slug;

        $project = Project::create($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->attach($form_data['technologies']);
        }

        return to_route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        $project->load(['type', 'type.projects']);
        return view('admin.projects.show', compact('project'));
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
        $form_data = $request->validated();
        $project->update($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($form_data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        $project->technologies()->detach();
        $project->delete();

        return to_route('admin.projects.index');
    }
}
