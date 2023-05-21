@extends('layouts.admin')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    <div class="p-4 sm:ml-64">
        @livewire('semua-artikel-table')
    </div>
@endsection