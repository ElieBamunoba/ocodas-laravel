<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::paginate(10);
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create', [
            'slide' => new Slide(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'required|image|max:2048', // 2MB Max
            'description' => 'nullable|string|max:255',
        ]);

        // Handle main image
        $validated['img'] = $request->file('img')->store('slides', 'public');

        Slide::create($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide created successfully.');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        // Handle main image update
        if ($request->hasFile('img')) {
            // Delete old image
            Storage::delete($slide->img);
            // Store new image
            $validated['img'] = $request->file('img')->store('slides', 'public');
        }

        $slide->update($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide updated successfully.');
    }

    public function destroy(Slide $slide)
    {
        // Delete images
        Storage::delete($slide->img);

        $slide->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide deleted successfully.');
    }
}
