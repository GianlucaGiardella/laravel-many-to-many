<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    private $validations = [
        'title'                 => 'required|string|min:5|max:80',
        'type_id'               => 'required|integer|exists:types,id',
        'author'                => 'required|string|min:5|max:100',
        'image'                 => 'nullable|image|max:1024',
        'github_url'            => 'required|url|max:400',
        'description'           => 'required|string',
        'technologies'          => 'nullable|array',
        'technologies.*'        => 'integer|exists:technologies,id',
    ];

    private $validationMessages = [
        'required'              => 'Field required.',
        'exists'                => 'Value not valid.',
        'url'                   => 'Url is not valid.',
        'min'                   => 'Field :attribute must be at least :min characters.',
        'max'                   => 'field :attribute must not exceed :max characters.',
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

        $imagePath = Storage::put('uploads', $data['image']);

        $newProject = new Project();
        $newProject->title          = $data['title'];
        $newProject->type_id        = $data['type_id'];
        $newProject->author         = $data['author'];
        $newProject->image          = $imagePath;
        $newProject->slug           = Project::slugger($data['title']);
        $newProject->github_url     = $data['github_url'];
        $newProject->description    = $data['description'];
        $newProject->save();

        $newProject->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.projects.show', ['project' => $newProject]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('admin.projects.show', compact('project'));
    }

    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        if ($data['image']) {
            $imagePath = Storage::put('uploads', $data['image']);

            if ($project->image) {
                Storage::delete($project->image);
            }

            $project->image = $imagePath;
        }

        $project->title             = $data['title'];
        $project->type_id           = $data['type_id'];
        $project->author            = $data['author'];
        $project->github_url        = $data['github_url'];
        $project->description       = $data['description'];
        $project->update();

        $project->technologies()->sync($data['technologies'] ?? []);

        return to_route('admin.projects.index');
    }

    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->technologies()->detach();
        $project->delete();

        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}