@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class=" font-bold text-2xl">Syahriah</h1>

    <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
        <h1>Catatan Syahriah Santri</h1>
        <div class=" flex">
            <a href="{{ route('bendahara.tagihan') . '?bulan=' . $bulan - 1 . '&tahun=' . $tahun }}"
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

                    <a href="{{ route('bendahara.tagihan') . '?bulan=' . $bulan + 1 . '&tahun=' . $tahun }}"
                        class=" font-bold text-2xl hover:text-blue-400">
                        >
                    </a>
        </div>


        <table class="table-auto text-center">
            <thead class="border-b border-slate-500">
                <tr>
                    <th>No</th>
                    <th>Jenis Syahriah</th>
                    <th>Nama Syahriah</th>
                    <th>Kewajiban(Rp)</th>


                </tr>
            </thead>
            <tbody>

                <td>No</td>
                <td>Jenis Syahriah</td>
                <td>Nama Syahriah</td>
                <td>Kewajiban(Rp)</td>





            </tbody>
        </table>

    </div>
@endsection
