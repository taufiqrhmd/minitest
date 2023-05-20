@extends('layouts.user')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    <div class="p-4 sm:ml-64">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Tulis Artikelmu Disini</h6>
        </div>
        <div class="card-body">
            <div>
                <label for="small-input" class="block mb-2 text-sm font-medium text-white dark:text-white">Judul Artikel</label>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <br>
            <label for="message" class="block mb-2 text-sm font-medium text-white dark:text-white">Isi Artikel</label>
            <textarea id="message" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="Tulis isi artikel mu disini..."></textarea>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
