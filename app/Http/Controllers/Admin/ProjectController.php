<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    private $validations = [
        'title' => 'required|string|min:5|max:100',
        'type_id' => 'required|integer|exists:types,id',
        'url_image' => 'required|url|max:400',
        'content' => 'required|string',
        'technologies'          => 'nullable|array',
        'technologies.*'        => 'integer|exists:technologies,id',
    ];

    private $validationMessages = [
        'required' => 'Il campo :attribute è richiesto.',
        'exists' => 'Valore non valido',
        'url' => 'Il campo deve essere un url valido',
        'min' => 'Il campo :attribute deve avere almeno :min caratteri',
        'max' => 'Il campo :attribute non deve superare i :max caratteri.',
    ];

    public function index()
    {
        $projects = Project::paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->type_id = $data['type_id'];
        $newProject->url_image = $data['url_image'];
        $newProject->content = $data['content'];
        $newProject->save();

        $newProject->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.projects.show', ['project' => $newProject]);
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        $project->title = $data['title'];
        $project->type_id = $data['type_id'];
        $project->url_image = $data['url_image'];
        $project->content = $data['content'];
        $project->update();

        $project->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.projects.index');
    }

    public function destroy(Project $project)
    {
        $project->technologies()->detach();

        $project->delete();

        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}