<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::all();
        return view('materi.index', compact('materis'));
    }

    public function create()
    {
        $komisiList = Materi::getKomisiList();
        return view('materi.create', compact('komisiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'komisi' => 'required|in:organisasi,program-kerja,rekomendasi',
        ]);

        Materi::create($request->all());
        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Materi $materi)
    {
        return view('materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        $komisiList = Materi::getKomisiList();
        return view('materi.edit', compact('materi', 'komisiList'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'komisi' => 'required|in:organisasi,program-kerja,rekomendasi',
        ]);

        $materi->update($request->all());
        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        $materi->delete();
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
