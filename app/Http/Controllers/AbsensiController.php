<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Absensi;
use App\Models\Peserta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $materis = Materi::latest()->paginate(10);
        return view('absensi.index', compact('materis'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_rfid' => 'required|string',
            'materi_id' => 'required|exists:materis,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first());
        }

        // Find participant by RFID
        $peserta = Peserta::where('id_rfid', $request->id_rfid)->first();

        if (!$peserta) {
            return redirect()->back()
                ->with('error', 'Peserta tidak ditemukan dengan RFID tersebut');
        }

        // Check if participant matches material's commission
        $materi = Materi::findOrFail($request->materi_id);
        if ($peserta->komisi !== $materi->komisi) {
            return redirect()->back()
                ->with('error', 'Peserta tidak terdaftar untuk materi ini');
        }

        // Check if attendance already exists
        $existingAbsensi = Absensi::where('peserta_id', $peserta->id)
            ->where('materi_id', $materi->id)
            ->exists();

        if ($existingAbsensi) {
            return redirect()->back()
                ->with('error', 'Peserta sudah tercatat absensinya untuk materi ini');
        }

        // Create new attendance record
        $absensi = Absensi::create([
            'peserta_id' => $peserta->id,
            'materi_id' => $materi->id,
            'status' => 'hadir',
        ]);

        return redirect()->back()
            ->with('success', "Absensi berhasil dicatat untuk {$peserta->nama} ({$peserta->asal_delegasi})");
    }

    public function scan($materiId)
    {
        // Ambil data materi
        $materi = Materi::findOrFail($materiId);

        // Ambil peserta yang komisinya sama dengan materi, dan preload absensi mereka hanya untuk materi ini
        $peserta = Peserta::where('komisi', $materi->komisi)
            ->with(['absensi' => function ($query) use ($materiId) {
                $query->where('materi_id', $materiId);
            }])
            ->orderBy('nama')
            ->get();

        return view('absensi.scan', compact('materi', 'peserta'));
    }
    public function export($materiId)
{
    $materi = Materi::findOrFail($materiId);

    // Ambil semua peserta dan absensinya untuk materi ini
    $peserta = Peserta::where('komisi', $materi->komisi)
        ->with(['absensi' => function ($query) use ($materiId) {
            $query->where('materi_id', $materiId);
        }])
        ->orderBy('nama')
        ->get();

    // Ambil waktu sekarang dalam format lokal
    $currentDateTime = Carbon::now()->translatedFormat('d F Y H:i') . ' WIB';

    // Kirim semuanya ke view
    $pdf = Pdf::loadView('absensi.export', compact('materi', 'peserta', 'currentDateTime'));

    return $pdf->download('absensi_' . $materi->nama . '.pdf');
}
}
