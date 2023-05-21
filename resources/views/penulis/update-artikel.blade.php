@extends('layouts.user')

@push('styles')
    @livewireStyles
@endpush

@section('content')
<div class="container mx-auto py-8">
        <div class="w-full max-w-lg mx-auto">
            <h1 class="text-2xl font-bold mb-4">Update Artikel</h1>
            <form action="{{ route('artikel.update', $artikel->id_artikel) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                    <input type="text" name="judul" id="judul" maxlength="50" value="{{ $artikel->judul }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="isi_artikel" class="block text-gray-700 text-sm font-bold mb-2">Isi Artikel</label>
                    <textarea name="isi_artikel" id="isi_artikel"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="80">{{ $artikel->isi_artikel }}</textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                    <a href="{{ route('penulis.management-artikel') }}"
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
