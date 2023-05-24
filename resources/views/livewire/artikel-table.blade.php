@php
    $no = 1;
@endphp

<div class="container">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-white dark:text-gray-400">
            <div class="flex items-center justify-between">
                <!-- <button type="button"
                    onclick="window.location.href='{{ route( 'penulis.tulisArtikel' ) }}'"
                    class="flex items-center justify-center w-full text-white bg-yellow-400 hover:bg-yellow-300 focus:ring-4 focus:ring-red-200 font-medium text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-200">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Tulis Artikel Baru
                </button> -->
            </div>
            <thead class="bg-yellow-500 text-white uppercase dark:bg-gray-700">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">No
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Judul
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Tanggal
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Preview
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                {{-- {{dd($artikels)}} --}}
                @foreach ($artikels as $artikel)
                    @if ($artikel->id_penulis === Auth::user()->id_penulis)
                        <tr class="bg-white">
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black dark:text-gray-200">
                                {{ $no++ }}</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black dark:text-gray-200">
                                {{ $artikel->judul }}</td>
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex">
                                    <a href="{{ route('artikel.edit', $artikel->id_artikel) }}"
                                        class="flex items-center bg-gray-200 hover:bg-gray-100 text-gray-500 hover:text-green-500 font-semibold py-1 px-4 mx-1 border border-gray-300 rounded shadow">
                                        <svg class="mx-1 stroke-current hover:text-green-500"
                                            xmlns="http://www.w3.org/2000/svg" width="12"
                                            height="12" viewBox="0 0 24 24" fill="none"
                                            stroke="#000000" stroke-width="1" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                                            </path>
                                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                        </svg>
                                    </a>
                                    <button id="TombolModalDeleteArtikel{{ $artikel->id_artikel }}"
                                        data-modal-toggle="ModalDeleteArtikel{{ $artikel->id_artikel }}"
                                        class="flex items-center bg-gray-200 hover:bg-gray-100 text-gray-500 hover:text-red-500 font-semibold py-1 px-4 mx-1 border border-gray-300 rounded shadow">
                                        <svg class="mx-1 stroke-current hover:text-red-500"
                                            xmlns="http://www.w3.org/2000/svg" width="12"
                                            height="12" viewBox="0 0 24 24" fill="none"
                                            stroke="#000000" stroke-width="1" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10"
                                                y2="17">
                                            </line>
                                            <line x1="14" y1="11" x2="14"
                                                y2="17">
                                            </line>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('components.modal-delete-artikel')
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
