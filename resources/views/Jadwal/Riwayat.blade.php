@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <h1 class="font-bold text-2xl my-2 ">Riwayat Absen</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
            <h1 class=" font-bold text-xl text-center">Kas </h1>
            @foreach ($kas as $item)
                <div class="flex">
                    <h1 class=" font-bold text-md w-24">{{ ucfirst($item->name) }} </h1>
                    <h1 class="  text-md">Rp. {{ number_format($item->nominal, 2, ',', '.') }} </h1>
                </div>
            @endforeach


        </div>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
            <div class=" flex">
                <a href="{{ route('laporan.index') . '?bulan=' . $bulan - 1 . '&tahun=' . $tahun }}"
                    class=" font-bold text-2xl hover:text-blue-400">
                    < </a>
                        <a class=" font-bold text-xl mx-auto">
                            @switch($bulan)
                                @case(1)
                                    Januari
                                @break

                                @case(2)
                                    Februari
                                @break

                                @case(3)
                                    Maret
                                @break

                                @case(4)
                                    April
                                @break

                                @case(5)
                                    Mei
                                @break

                                @case(6)
                                    Juni
                                @break

                                @case(7)
                                    Juli
                                @break

                                @case(8)
                                    Agustus
                                @break

                                @case(9)
                                    September
                                @break

                                @case(10)
                                    Oktober
                                @break

                                @case(11)
                                    November
                                @break

                                @case(12)
                                    Desember
                                @break

                                @default
                            @endswitch {{ $tahun }} </a>

                        <a href="{{ route('laporan.index') . '?bulan=' . $bulan + 1 . '&tahun=' . $tahun }}"
                            class=" font-bold text-2xl hover:text-blue-400">
                            >
                        </a>
            </div>
            <div class=" flex my-3">
                <form class=" flex mr-auto" action="" method="get">
                    <p>Tampilan</p>
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="search" value="{{ $search }}">
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
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="pagination" value="{{ $page }}">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Search... "
                        id="" class="border ml-2 px-2 border-slate-400 rounded-md w-56">
                    <button type="submit"></button>
                </form>
            </div>
            <form class=" w-full flex items-center" action="" method="get">
                <input type="hidden" name="bulan" value="{{ $bulan }}">
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <input type="hidden" name="search" value="{{ $search }}">
                <input type="hidden" name="pagination" value="{{ $page }}">
                <label for="kind" class=" mr-3">Jenis</label>
                <select name="kind" id="kind">
                    <option value="">Semua</option>
                    <option {{ $kind == '600' ? 'selected' : '' }} value="600">Penjualan</option>
                    <option {{ $kind == '500' ? 'selected' : '' }} value="500">Pembelian</option>
                </select>
                <label for="metode" class=" mx-3">Metode</label>
                <select name="metode" id="metode">
                    <option value="">Semua</option>
                    <option {{ $metode == 'Tunai' ? 'selected' : '' }} value="Tunai">Tunai</option>
                    <option {{ $metode == 'Non Tunai' ? 'selected' : '' }} value="Non Tunai">Non Tunai</option>
                </select>

                <button class=" block bg-primary rounded-md p-2 ml-auto text-white " type="submit">Terapkan</button>
            </form>
            <table class="table-auto text-center">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($absen as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class=" flex w-full pl-3  pt-3 border-t border-blue-950">
                <p>Halaman {{ $absen->currentPage() }} Dari {{ $absen->lastPage() }} </p>
                <div class="ml-auto flex text-lg font-bold">

                    <a
                        @if ($absen->previousPageUrl()) class="mr-10 " href="{{ $absen->previousPageUrl() }}&pagination={{ $page }}&search={{ $search }}&bulan={{ $bulan }}&tahun={{ $tahun }}&kind={{ $kind }}&metode={{ $tmetode }}"
                @else class="mr-10 text-slate-300" @endif>
                        < </a>

                            <a
                                @if ($absen->nextPageUrl()) class="mr-10 " href="{{ $absen->nextPageUrl() }}&pagination={{ $page }}&search={{ $search }}&bulan={{ $bulan }}&tahun={{ $tahun }}&kind={{ $kind }}&metode={{ $tmetode }}" @else class="mr-10 text-slate-300" @endif>>
                            </a>
                </div>
            </div>
        </div>
    </div>
@endsection
