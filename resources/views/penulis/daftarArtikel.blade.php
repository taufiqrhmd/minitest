@extends('layouts.user')

@push('styles')
    @livewireStyles
@endpush

@section('content')
    <div class="p-4 sm:ml-64">
        @livewire('artikel-table')
    </div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
