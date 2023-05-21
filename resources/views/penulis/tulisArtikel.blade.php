@extends('layouts.user')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    <div class="p-4 sm:ml-64">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">Tulis Artikelmu Disini</h6>
            </div>
            <div class="card-body">
                <form action="/author/add-article" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="Masukkan judul">
                    </div>
                    <div class="form-group">
                        <label for="body">Artikel</label>
                        <textarea name="body" class="form-control" id="body" cols="30" rows="5" placeholder="Masukkan sebuah artikel"></textarea>
                    </div>

                    <div class="form-group d-flex justify-content-end">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
