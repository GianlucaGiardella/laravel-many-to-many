<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.types.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        //
    }

    public function destroy(Type $type)
    {
        foreach ($type->projects as $project) {
            $project->type_id = 1;
            $project->update();
        }

        $type->delete();

        return to_route('admin.types.index')->with('delete_success', $type);
    }
}