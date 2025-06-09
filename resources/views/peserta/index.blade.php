@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Data Peserta</h2>
            <p class="text-gray-600">Data peserta untuk sistem absensi</p>
        </div>
        <a href="{{ route('peserta.create') }}"
            class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            <i class="ri-add-line text-lg leading-none"></i>
            <span>Tambah Data Peserta</span>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Daftar Peserta Terdaftar</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded hover:bg-green-200">
                        <i class="ri-download-line w-4 h-4 inline mr-1"></i>
                        Export
                    </button>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Kartu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal
                            Delegasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komisi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                            Kelamin
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                            Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="peserta-table" class="bg-white divide-y divide-gray-200">
                    @foreach ($peserta as $index => $p)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                {{ ($peserta->currentPage() - 1) * $peserta->perPage() + $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">{{ $p->id_rfid }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $p->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $p->asal_delegasi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $badgeColor =
                                        [
                                            'organisasi' => 'bg-green-100 text-green-800',
                                            'program-kerja' => 'bg-blue-100 text-blue-800',
                                            'rekomendasi' => 'bg-purple-100 text-purple-800',
                                        ][$p->komisi] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeColor }}">
                                    {{ ucfirst(str_replace('-', ' ', $p->komisi)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $p->jenis_kelamin }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $p->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('peserta.edit', $p->id) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="ri-edit-line w-4 h-4 inline"></i>
                                </a>
                                <form action="{{ route('peserta.destroy', $p->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                                        <i class="ri-delete-bin-line w-4 h-4 inline"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($peserta->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $peserta->links() }}
            </div>
        @endif
    </div>
@endsection
