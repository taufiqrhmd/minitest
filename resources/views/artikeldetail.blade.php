<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>

    <!-- Styles --->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link href="cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @stack('styles')

    <!-- Scripts --->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

</head>
<body>
<div class="mt-32 mx-auto max-w-3xl">

<h1 class="text-2xl font-bold mb-6">{{ $artikel->judul }}</h1>
<div class="prose mb-8">
    {!! nl2br(e($artikel->isi_artikel)) !!}
</div>

{{-- Ini tampilan komentar --}}
<h2 class="text-xl font-bold my-4">Komentar:</h2>
<ul class="divide-y divide-gray-200 mb-8">
    @forelse ($komentar as $k)
        <li class="py-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex justify-start items-center">
                    <h4 class="text-lg font-medium text-red-500 mr-2">{{ $k->nama }}</h4>
                    |
                    <p class="text-sm ml-2">{{ $k->email }}</p>

                </div>
                <div class="text-right">
                    <p class="text-xs">{{ $k->created_at }}</p>
                </div>
            </div>
            <p class="text-gray-600 mt-4">{{ $k->isi_komentar }}</p>
        </li>
    @empty
        <li class="py-4 mb-8">
            <p class="text-gray-600">Tidak Ada Komentar</p>
        </li>
    @endforelse
</ul>

<h2 class="text-xl font-bold my-4">Berikan Komentar, Kritik, Ataupun Saran:</h2>
{{-- Formulir untuk menambahkan komentar --}}
<form action="{{ route('komentar.store') }}" method="POST">
    @csrf
    <input type="hidden" name="id_artikel" value="{{ $artikel->id_artikel }}">

    <div class="mb-4">
        <label for="nama" class="block font-bold mb-2">Nama:</label>
        <input type="text" name="nama" id="nama"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-red-500">
    </div>

    <div class="mb-4">
        <label for="isi_komentar" class="block font-bold mb-2">Komentar:</label>
        <textarea name="isi_komentar" id="isi_komentar" rows="4"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-red-500"></textarea>
    </div>

    <div class="mb-4">
        <label for="email" class="block font-bold mb-2">Email:</label>
        <input type="email" name="email" id="email"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-red-500">
    </div>

    <div>
        <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Tambah
            Komentar</button>
    </div>
</form>

<div class="mb-32">

</div>
</div>
    
    <!-- Scripts --->
    @stack('scripts')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>