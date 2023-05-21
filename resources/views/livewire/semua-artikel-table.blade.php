@php
    $no = 1;
@endphp

<div class="container">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-white dark:text-gray-400">
            <thead class="bg-yellow-400 text-white uppercase dark:bg-gray-700">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">No
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Judul
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Penulis
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Tanggal
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Preview
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-white">
                @foreach ($artikels as $artikel)
                    <tr class="bg-white">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black dark:text-gray-200">
                            {{ $no++ }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black dark:text-gray-200">
                            {{ $artikel->judul }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black dark:text-gray-200">
                            {{ $artikel->penulis->username }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-gray-200">
                            {{ $artikel->tanggal }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-gray-200">
                            <a href="{{ route('artikel.show', ['id' => $artikel->id_artikel]) }}"
                                class="underline">
                                Menuju Preview
                            </a>
                        </td>
                    </tr>
                    @include('components.modal-delete-artikel')
                @endforeach
            </tbody>
        </table>
    </div>
</div>
