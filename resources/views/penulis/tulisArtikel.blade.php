@extends('layouts.user')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="card bg-gray-500 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Tulis Artikelmu Disini</h6>
            </div>
            <div class="card-body">
            <form action="/tulisArtikel" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="judul" class="block text-white text-sm font-bold mb-2">Judul</label>
                    <input type="text" name="judul" id="judul" maxlength="50"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="isi_artikel" class="block text-whitetext-sm font-bold mb-2">Isi Artikel</label>
                    <textarea name="isi_artikel" id="isi_artikel"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="80"></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{ route('penulis.daftarArtikel') }}"
                        class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">
                        Kembali
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
