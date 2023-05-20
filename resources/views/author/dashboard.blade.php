@extends('layouts.user')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    <div class="p-4 sm:ml-64">
    <div class="jumbotron">
                <h1 class="display-4 font-weight-bold">Selamat Datang !</h1>
                <p class="lead">Yuk, Sampaikan dan simpan sebuah informasi yang kamu punya kedalam sebuah artikel.</p>
                <a class="btn btn-primary btn-lg" href="/author/add-article" role="button">Buat Artikel</a>
              </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
