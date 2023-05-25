@php
    $no = 1;
@endphp

<div class="container">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-white dark:text-gray-400">
            <thead class="bg-blue-300 text-white uppercase dark:bg-gray-700">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-black uppercase">No
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-black uppercase">Username
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-black uppercase">Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-black uppercase">Tanggal
                        Pendaftaran
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold text-black uppercase">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-white">
                @foreach ($penulis as $pena)
                    <tr class="bg-white">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black dark:text-gray-200">
                            {{ $no++ }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black dark:text-gray-200">
                            {{ $pena->username }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black dark:text-gray-200">
                            {{ $pena->status }}</td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-black dark:text-gray-200">
                            {{ $pena->created_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex">
                                <button id="TombolModalUpdateStatus{{ $pena->id_penulis }}"
                                    data-modal-toggle="ModalUpdateStatus{{ $pena->id_penulis }}"
                                    class="flex items-center bg-gray-200 hover:bg-gray-100 text-gray-500 hover:text-red-500 font-semibold py-1 px-4 mx-1 border border-gray-300 rounded shadow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="#000000" stroke-width="1" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @include('admin.ModalUpdateStatus')
                @endforeach
            </tbody>
        </table>
    </div>
</div>
