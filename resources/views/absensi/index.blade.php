@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Data Materi</h2>
            <p class="text-gray-600">Daftar materi untuk sistem absensi</p>
        </div>
        <a href="{{ route('materi.create') }}"
            class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            <i class="ri-add-line text-lg leading-none"></i>
            <span>Tambah Materi</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($materis as $materi)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $materi->nama }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($materi->komisi === 'organisasi') bg-green-100 text-green-800
                            @elseif($materi->komisi === 'program-kerja') bg-blue-100 text-blue-800
                            @elseif($materi->komisi === 'rekomendasi') bg-purple-100 text-purple-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst(str_replace('-', ' ', $materi->komisi)) }}
                        </span>
                    </div>
                </div>

                <p class="text-gray-600 mb-6">{{ $materi->deskripsi }}</p>

                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm text-gray-500">
                        Dibuat: {{ $materi->created_at->format('d M Y') }}
                    </span>
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('absensi.scan', $materi->id) }}"
                        class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 flex items-center justify-center space-x-2">
                        <i class="ri-qr-scan-line"></i>
                        <span>Scan Absensi</span>
                    </a>
                    <a href="{{ route('absensi.export', $materi->id) }}"
                        class="flex-1 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center justify-center space-x-2">
                        <i class="ri-download-line"></i>
                        <span>Export</span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

    @if ($materis->hasPages())
        <div class="mt-6">
            {{ $materis->links() }}
        </div>
    @endif
@endsection
