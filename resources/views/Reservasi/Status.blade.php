@extends('Layout.App')
@section('content')
    <div class="p-2">

        <div class=" bg-white rounded-md shadow-md p-3">
            <div class=" flex items-center ">
                <img class=" h-16" src="{{ asset('\img\Logo.png') }}" alt="">
                <h1 class="text-center text-4xl ">Reservasi</h1>
            </div>
            <div class=" flex">

                <div class="grid grid-cols-1 md:grid-cols-2 w-full border-x-4 border-b rounded-xl p-2 border-primary">
                    <div class=" flex">
                        <p class=" w-32">Atas Nama</p>
                        <p>: {{ $pesanan->name }}</p>
                    </div>
                    <div class=" flex">
                        <p class=" w-32">Tanggal</p>
                        <p>: {{ $pesanan->date }}</p>
                    </div>
                    <div class=" flex">
                        <p class=" w-32">Waktu</p>
                        <p>: {{ $pesanan->time }}</p>
                    </div>
                    <div class=" flex">
                        <p class=" w-32">Jumlah kursi</p>
                        <p>: {{ $pesanan->jumlah }}</p>
                    </div>
                    <div class=" flex">
                        <p class=" w-32">Status</p>
                        <p>: {{ $pesanan->status }}</p>
                    </div>



                </div>

            </div>
            @php
                $jumlah = 0;
            @endphp
            @foreach ($pesanan->list as $item)
                @php
                    $jumlah += $item->jumlah;
                @endphp
                <div class="flex my-3 border-y-2 p-1">
                    <img class="w-24 rounded-md " src="{{ asset('storage/' . $item->menu->foto) }}" alt="">
                    <div class="ml-3">
                        <p>{{ $item->menu->name }}</p>
                        <p class=" text-xs">Catatan Khusus : <span class="font-semibold">{{ $item->keterangan }}</span></p>
                        <p class="font-bold">{{ $item->jumlah }} </p>
                    </div>
                </div>
            @endforeach

        </div>





    </div>


    </div>
    </div>
@endsection
