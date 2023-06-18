@extends('Layout.Dashboard')
@section('dashboard')
    <div class=" p-2">
        <h1 class="text-2xl ">Reservasi</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-4 mb-10 mt-3">

            <div class=" flex mb-2">
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
                            @endswitch {{ $tahun }}

                        </a>

                        <a href="{{ route('laporan.index') . '?bulan=' . $bulan + 1 . '&tahun=' . $tahun }}"
                            class=" font-bold text-2xl hover:text-blue-400">
                            >
                        </a>
            </div>
            <form class=" flex items-center ">
                <p class=" w-16">Tanggal</p>
                <input type="hidden" name="bulan" value="{{ $bulan }}">
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <input type="hidden" name="search" value="{{ $search }}">
                <input type="hidden" name="pagination" value="{{ $page }}">
                <select name="hari" id="" class=" border-slate-400 border-2 px-2">
                    <option value="All">All</option>
                    @for ($con = 1; $con < 32; $con++)
                        <option value="{{ $con }}" {{ $con == $hari ? 'selected' : '' }}>
                            {{ $con }}
                        </option>
                    @endfor

                </select>

                <p class=" w-16 ml-10">Tampilan</p>
                <select name="pagination" id="" class=" border-2 ml-2 border-slate-400" v>
                    <option value="10" {{ $page == 10 ? 'selected' : '' }}>10</option>
                    <option value="50" {{ $page == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $page == 100 ? 'selected' : '' }}>100</option>
                    <option value="1000" {{ $page == 1000 ? 'selected' : '' }}>1000</option>
                </select>
                <p class=" w-16 ml-10">Status</p>
                <select name="status" id="" class=" border-2 ml-2 border-slate-400" v>
                    <option value="">All</option>
                    <option value="Unpaid" {{ $status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="Down Payment Paid" {{ $status == 'Down Payment Paid' ? 'selected' : '' }}>Down Payment
                        Paid</option>
                    <option value="Paid" {{ $status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Completed" {{ $status == 'Completed' ? 'selected' : '' }}>Complited</option>
                </select>


                <button class=" block bg-primary rounded-md p-2 ml-auto text-white " type="submit">Terapkan</button>
            </form>
            <div class=" flex justify-end mt-2">

                <p class="ml"> Cari</p>
                <form action="">
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="pagination" value="{{ $page }}">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Search... "
                        id="" class="border ml-2 px-2 border-slate-400 rounded-md w-56">
                    <button type="submit"></button>
                </form>
            </div>
            <table class="table-auto text-center">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="border-b border-slate-500 text-sm">

                    @foreach ($pesanan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->time }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->status }}</td>
                            <td><a href="{{ route('pesanan.reservasi.pay', ['id' => $item->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M13 5c2.21 0 4 1.79 4 4c0 1.5-.8 2.77-2 3.46v-1.22c.61-.55 1-1.35 1-2.24c0-1.66-1.34-3-3-3s-3 1.34-3 3c0 .89.39 1.69 1 2.24v1.22C9.8 11.77 9 10.5 9 9c0-2.21 1.79-4 4-4m7 15.5c-.03.82-.68 1.47-1.5 1.5H13c-.38 0-.74-.15-1-.43l-4-4.2l.74-.77c.19-.21.46-.32.76-.32h.2L12 18V9c0-.55.45-1 1-1s1 .45 1 1v4.47l1.21.13l3.94 2.19c.53.24.85.77.85 1.35v3.36M20 2H4c-1.1 0-2 .9-2 2v8a2 2 0 0 0 2 2h4v-2H4V4h16v8h-2v2h2v-.04l.04.04c1.09 0 1.96-.91 1.96-2V4a2 2 0 0 0-2-2Z" />
                                    </svg></a></td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class=" flex w-full pl-3  pt-3 border-t border-blue-950">
                <p>Halaman {{ $pesanan->currentPage() }} Dari {{ $pesanan->lastPage() }} </p>
                <div class="ml-auto flex text-lg font-bold">

                    <a
                        @if ($pesanan->previousPageUrl()) class="mr-10 " href="{{ $pesanan->previousPageUrl() }}&pagination={{ $page }}&search={{ $search }}&bulan={{ $bulan }}&tahun={{ $tahun }}&status={{ $status }}"
                    @else class="mr-10 text-slate-300" @endif>
                        < </a>

                            <a
                                @if ($pesanan->nextPageUrl()) class="mr-10 " href="{{ $pesanan->nextPageUrl() }}&pagination={{ $page }}&search={{ $search }}&bulan={{ $bulan }}&tahun={{ $tahun }}&status={{ $status }}" @else class="mr-10 text-slate-300" @endif>>
                            </a>
                </div>
            </div>
        </div>
    </div>
@endsection
