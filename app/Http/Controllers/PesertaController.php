<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $peserta = Peserta::paginate(20);
        return view('peserta.index', compact('peserta'));
    }
    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        return view('peserta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_rfid' => 'required|unique:peserta',
            'nama' => 'required',
            'asal_delegasi' => 'required',
            'komisi' => 'required|in:organisasi,program-kerja,rekomendasi',
        ]);

        Peserta::create($request->all());

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $peserta = Peserta::findOrFail($id);
    return view('peserta.edit', compact('peserta'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $peserta = Peserta::findOrFail($id);

    $request->validate([
        'id_rfid' => 'required|unique:peserta,id_rfid,' . $id,
        'nama' => 'required',
        'asal_delegasi' => 'required',
        'komisi' => 'required|in:organisasi,program-kerja,rekomendasi',
    ]);

    $peserta->update($request->all());

    return redirect()->route('peserta.index')->with('success', 'Peserta berhasil diupdate.');
}
    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Peserta $peserta)
{
    $peserta->delete();
    return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
}

}
