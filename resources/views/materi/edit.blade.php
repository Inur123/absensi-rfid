@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Edit Materi</h2>
            <p class="text-gray-600">Formulir pengeditan materi</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Form Edit Materi</h3>
        </div>

        <div class="p-6">
            <form action="{{ route('materi.update', $materi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Nama Materi -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Materi</label>
                        <input type="text" name="nama" id="nama" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan nama materi" value="{{ old('nama', $materi->nama) }}">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan deskripsi materi (opsional)"
                            value="{{ old('deskripsi', $materi->deskripsi) }}">
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Komisi -->
                    <div>
                        <label for="komisi" class="block text-sm font-medium text-gray-700 mb-1">Komisi</label>
                        <select name="komisi" id="komisi" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Komisi</option>
                            <option value="organisasi"
                                {{ old('komisi', $materi->komisi) == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
                            <option value="program-kerja"
                                {{ old('komisi', $materi->komisi) == 'program-kerja' ? 'selected' : '' }}>Program Kerja
                            </option>
                            <option value="rekomendasi"
                                {{ old('komisi', $materi->komisi) == 'rekomendasi' ? 'selected' : '' }}>Rekomendasi</option>
                        </select>
                        @error('komisi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Action -->
                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('materi.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="ri-close-line mr-1"></i>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 cursor-pointer">
                            <i class="ri-save-line mr-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
