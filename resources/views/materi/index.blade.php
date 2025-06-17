@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Data Materi</h2>
            <p class="text-gray-600">Data Materi untuk sistem absensi</p>
        </div>
        <a href="{{ route('materi.create') }}"
            class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            <i class="ri-add-line text-lg leading-none"></i>
            <span>Tambah Data Materi</span>
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Daftar Materi</h3>
            </div>
        </div>

        <div id="sesi-container" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($materis as $materi)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="font-semibold text-gray-900 text-lg">{{ $materi->nama }}</h4>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">{{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        <div class="space-y-2 text-sm text-gray-500 mb-4">
                            <div class="flex items-center">
                                <i class="ri-stack-line w-4 h-4 mr-2"></i>
                                <span>Komisi: {{ ucfirst(str_replace('-', ' ', $materi->komisi)) }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-calendar-line w-4 h-4 mr-2"></i>
                                <span>Dibuat: {{ $materi->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="ri-time-line w-4 h-4 mr-2"></i>
                                <span>Diupdate: {{ $materi->updated_at->format('Y-m-d H:i') }}</span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex space-x-2 ml-auto">
                                <a href="{{ route('materi.edit', $materi->id) }}"
                                    class="text-xs px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 inline-flex items-center justify-center">
                                    <i class="ri-edit-line text-sm mr-1"></i> Edit
                                </a>

                                <form action="{{ route('materi.destroy', $materi->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-xs px-4 py-2 bg-red-100 text-red-700 rounded hover:bg-red-200 inline-flex items-center justify-center cursor-pointer">
                                        <i class="ri-delete-bin-line text-sm mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
