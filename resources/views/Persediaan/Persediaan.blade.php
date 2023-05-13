@extends('Layout.Dashboard')
@section('dashboard')
    <div class=" p-2">
        <h1 class="text-2xl font-bold">Persediaan</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-4 mb-10 mt-3">

            <div class=" flex my-3">

                <p class="ml-auto"> Cari</p>
                <form action="">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Search... " id=""
                        class="border ml-2 px-2 border-slate-400 rounded-md w-56">
                    <button type="submit"></button>
                </form>
            </div>
            <table class="table-auto text-center">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah(Satuan)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="border-b border-slate-500 text-sm">
                    <form action="{{ route('persediaan.store') }}" method="POST">
                        @csrf
                        <tr>
                            <td>
                                #
                            </td>
                            <td>
                                <input name="name" type="text" class=" text-center border rounded-md w-full">
                            </td>
                            <td>
                                <select name="satuan">
                                    <option value="">Pilih salah satu</option>
                                    <option value="gram">gram</option>
                                    <option value="ml">ml</option>
                                    <option value="Pcs">Pcs</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4v4Zm1 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </form>
                    @foreach ($persediaan as $item)
                        <tr>
                            @if (Request::url() === route('persediaan.edit', ['id' => $item->id]))
                                <form action="{{ route('persediaan.edit', ['id' => $item->id]) }}" method="POST">
                                    @csrf

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <input name="name" value="{{ $item->name }}" type="text"
                                            class=" text-center border rounded-md w-full">
                                    </td>
                                    <td>
                                        {{ $item->jumlah }}
                                        <select name="satuan">
                                            <option @if ($item->satuan == 'gram') selected @endif value="gram">gram
                                            </option>
                                            <option @if ($item->satuan == 'liter') selected @endif value="ml">ml
                                            </option>
                                            <option @if ($item->satuan == 'Pcs') selected @endif value="Pcs">Pcs
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 2048 2048">
                                                <path fill="currentColor"
                                                    d="m1902 196l121 120L683 1657L25 999l121-121l537 537L1902 196z" />
                                            </svg>
                                        </button>
                                    </td>

                                </form>
                            @else
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ ucwords($item->name) }}</td>
                                <td>{{ $item->jumlah }} {{ $item->satuan }}</td>

                                <td>
                                    <div class="flex items-center justify-center">
                                        <form action="{{ route('persediaan.resetock', ['id' => $item->id]) }}"
                                            method="get">

                                            <button type="submit">
                                                <svg class="fill-green-400" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24">
                                                    <path
                                                        d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4v4Zm1 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('persediaan.edit', ['id' => $item->id]) }}" method="get">

                                            <button type="submit">
                                                <svg class="fill-yellow-600" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24">
                                                    <path
                                                        d="M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6V19ZM19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM4 21q-.425 0-.713-.288T3 20v-2.825q0-.2.075-.388t.225-.337l10.3-10.3l4.25 4.25l-10.3 10.3q-.15.15-.337.225T6.825 21H4ZM14.325 9.675l-.7-.7l1.4 1.4l-.7-.7Z" />
                                                </svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('persediaan.delete', ['id' => $item->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit">
                                                <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24">
                                                    <path
                                                        d="M7 21q-.825 0-1.413-.588T5 19V6q-.425 0-.713-.288T4 5q0-.425.288-.713T5 4h4q0-.425.288-.713T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5q0 .425-.288.713T19 6v13q0 .825-.588 1.413T17 21H7ZM7 6v13h10V6H7Zm0 0v13V6Zm5 7.9l1.9 1.9q.3.275.713.275t.687-.275q.3-.3.3-.713t-.3-.687l-1.9-1.9l1.9-1.9q.3-.3.3-.713t-.3-.687q-.275-.3-.688-.3t-.712.3L12 11.1l-1.9-1.9q-.275-.3-.688-.3t-.712.3q-.275.275-.275.688t.275.712l1.9 1.9l-1.9 1.9q-.275.275-.275.688t.275.712q.3.275.713.275t.687-.275l1.9-1.9Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif


                        </tr>
                    @endforeach





                </tbody>
            </table>

        </div>
    </div>
@endsection
