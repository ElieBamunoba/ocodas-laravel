<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create', [
            'project' => new Project(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048', // 2MB Max
            'description' => 'required|string',
            'additional_images.*' => 'image|max:2048',
            'link' => 'nullable|string|max:255|url',
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|string|max:255',
        ]);

        // Handle image
        $validated['image'] = $request->file('image')->store('projects', 'public');

        // Handle additional images
        $additionalImages = [];
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $additionalImages[] = $image->store('projects');
            }
        }
        $validated['additional_images'] = $additionalImages;

        // Filter out empty categories
        if (isset($validated['categories'])) {
            $validated['categories'] = array_filter($validated['categories'], fn($value) => !is_null($value) && $value !== '');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string',
            'additional_images.*' => 'nullable|image|max:2048',
            'link' => 'nullable|string|max:255|url',
            'categories' => 'nullable|array',
            'categories.*' => 'nullable|string|max:255',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::delete($project->image);
            // Store new image
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        // Handle additional images
        if ($request->hasFile('additional_images')) {
            // Delete old images
            foreach (($project->additional_images ?? []) as $image) {
                Storage::delete($image);
            }

            // Store new images
            $additionalImages = [];
            foreach ($request->file('additional_images') as $image) {
                $additionalImages[] = $image->store('projects', 'public');
            }
            $validated['additional_images'] = $additionalImages;
        }



        // Filter out empty categories
        if (isset($validated['categories'])) {
            $validated['categories'] = array_filter($validated['categories'], fn($value) => !is_null($value) && $value !== '');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete image
        Storage::delete($project->image);

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}