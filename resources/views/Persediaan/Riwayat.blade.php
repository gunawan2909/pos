@extends('Layout.Dashboard')
@section('dashboard')
    <div class=" p-2">
        <h1 class="text-2xl font-bold">Persediaan</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-4 mb-10 mt-3">

            <div class=" flex my-3">
                <form class=" flex mr-auto" action="" method="get">
                    <p>Tampilan</p>
                    <select name="pagination" id="" class=" border-2 ml-2 border-slate-400" v>
                        <option value="10" {{ $page == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ $page == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $page == 100 ? 'selected' : '' }}>100</option>
                        <option value="1000" {{ $page == 1000 ? 'selected' : '' }}>1000</option>
                    </select>
                    <p class="ml-2"> Data</p>
                    <button class=" bg-primary text-white px-3 rounded-md ml-3" type="submit">Terapkan</button>
                </form>
                <p class="ml"> Cari</p>
                <form action="">


                    <input type="hidden" name="pagination" value="{{ $page }}">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Search... " id=""
                        class="border ml-2 px-2 border-slate-400 rounded-md w-56">
                    <button type="submit"></button>
                </form>
            </div>
            <table class="table-auto text-center">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jumlah(Satuan)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="border-b border-slate-500 text-sm">

                    @foreach ($riwayat as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ date_format($item->created_at, 'd M Y') }}
                            </td>
                            <td>
                                {{ $item->transaksi->keterangan }}
                            </td>
                            <td>
                                {{ $item->jumlah }}
                            </td>
                            <td>
                                <div class=" flex  justify-center">
                                    <form action="{{ route('persediaan.riwayat.edit', ['id' => $item->id]) }}"
                                        method="get">

                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 1024 1024">
                                                <g transform="rotate(180 512 512)">
                                                    <path fill="currentColor"
                                                        d="M600.704 64a32 32 0 0 1 30.464 22.208l35.2 109.376c14.784 7.232 28.928 15.36 42.432 24.512l112.384-24.192a32 32 0 0 1 34.432 15.36L944.32 364.8a32 32 0 0 1-4.032 37.504l-77.12 85.12a357.12 357.12 0 0 1 0 49.024l77.12 85.248a32 32 0 0 1 4.032 37.504l-88.704 153.6a32 32 0 0 1-34.432 15.296L708.8 803.904c-13.44 9.088-27.648 17.28-42.368 24.512l-35.264 109.376A32 32 0 0 1 600.704 960H423.296a32 32 0 0 1-30.464-22.208L357.696 828.48a351.616 351.616 0 0 1-42.56-24.64l-112.32 24.256a32 32 0 0 1-34.432-15.36L79.68 659.2a32 32 0 0 1 4.032-37.504l77.12-85.248a357.12 357.12 0 0 1 0-48.896l-77.12-85.248A32 32 0 0 1 79.68 364.8l88.704-153.6a32 32 0 0 1 34.432-15.296l112.32 24.256c13.568-9.152 27.776-17.408 42.56-24.64l35.2-109.312A32 32 0 0 1 423.232 64H600.64zm-23.424 64H446.72l-36.352 113.088l-24.512 11.968a294.113 294.113 0 0 0-34.816 20.096l-22.656 15.36l-116.224-25.088l-65.28 113.152l79.68 88.192l-1.92 27.136a293.12 293.12 0 0 0 0 40.192l1.92 27.136l-79.808 88.192l65.344 113.152l116.224-25.024l22.656 15.296a294.113 294.113 0 0 0 34.816 20.096l24.512 11.968L446.72 896h130.688l36.48-113.152l24.448-11.904a288.282 288.282 0 0 0 34.752-20.096l22.592-15.296l116.288 25.024l65.28-113.152l-79.744-88.192l1.92-27.136a293.12 293.12 0 0 0 0-40.256l-1.92-27.136l79.808-88.128l-65.344-113.152l-116.288 24.96l-22.592-15.232a287.616 287.616 0 0 0-34.752-20.096l-24.448-11.904L577.344 128zM512 320a192 192 0 1 1 0 384a192 192 0 0 1 0-384zm0 64a128 128 0 1 0 0 256a128 128 0 0 0 0-256z" />
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('persediaan.riwayat.delete', ['id' => $item->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit">
                                            <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M7 21q-.825 0-1.413-.588T5 19V6q-.425 0-.713-.288T4 5q0-.425.288-.713T5 4h4q0-.425.288-.713T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5q0 .425-.288.713T19 6v13q0 .825-.588 1.413T17 21H7ZM7 6v13h10V6H7Zm0 0v13V6Zm5 7.9l1.9 1.9q.3.275.713.275t.687-.275q.3-.3.3-.713t-.3-.687l-1.9-1.9l1.9-1.9q.3-.3.3-.713t-.3-.687q-.275-.3-.688-.3t-.712.3L12 11.1l-1.9-1.9q-.275-.3-.688-.3t-.712.3q-.275.275-.275.688t.275.712l1.9 1.9l-1.9 1.9q-.275.275-.275.688t.275.712q.3.275.713.275t.687-.275l1.9-1.9Z" />
                                            </svg>
                                        </button>
                                </div>

                            </td>
                        </tr>
                    @endforeach





                </tbody>
            </table>
            <div class=" flex w-full pl-3  pt-3 border-t border-primary">
                <p>Halaman {{ $riwayat->currentPage() }} Dari {{ $riwayat->lastPage() }} </p>
                <div class="ml-auto flex text-lg font-bold">

                    <a
                        @if ($riwayat->previousPageUrl()) class="mr-10 " href="{{ $riwayat->previousPageUrl() }}&pagination={{ $page }}&search={{ $search }}&bulan={{ $bulan }}&tahun={{ $tahun }}"
                    @else class="mr-10 text-slate-300" @endif>
                        < </a>

                            <a
                                @if ($riwayat->nextPageUrl()) class="mr-10 " href="{{ $riwayat->nextPageUrl() }}&pagination={{ $page }}&search={{ $search }}&bulan={{ $bulan }}&tahun={{ $tahun }}" @else class="mr-10 text-slate-300" @endif>>
                            </a>
                </div>
            </div>
        </div>
    @endsection
