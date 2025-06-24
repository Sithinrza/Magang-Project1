<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'project_leader' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        // Handle upload foto jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Buat project baru dengan data yang sudah divalidasi
        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Menggunakan Route Model Binding untuk mengambil project
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // FIX: Menggunakan Route Model Binding untuk mengambil data project
        // Data ini akan dikirim ke view untuk mengisi form edit
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // FIX: Menggunakan Route Model Binding ($project) untuk langsung mendapatkan model Project.
        // Tidak perlu lagi mencari manual dengan Project::find($id).

        // Validasi request
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'project_leader' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // FIX: Menyamakan nama field menjadi 'photo'
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        // Handle upload foto baru jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($project->photo) {
                Storage::disk('public')->delete($project->photo);
            }
            // Simpan foto baru dan update path di data yang divalidasi
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Update data project
        $project->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Hapus foto dari storage
        if ($project->photo) {
            Storage::disk('public')->delete($project->photo);
        }

        // Hapus data project dari database
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }
}
