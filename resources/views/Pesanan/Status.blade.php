@extends('Layout.App')
@section('content')
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);">
        <!-- Loading screen -->
     
        <div
            class="flex flex-col items-center justify-center min-h-screen  antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">

            <main>
                <div class="w-full  px-4 py-4 space-y-2 bg-white rounded-md dark:bg-darker mb-10">
                    <a href="{{ route('home') }}" class=" flex items-center ">
                        <img class=" h-16" src="{{ asset('\img\Logo.png') }}" alt="">
                        <h1 class="text-center text-xl ">Struk Pembayaran</h1>
                    </a>
                    <div class="flex">

                        <div class=" flex flex-col w-full border-x-4 border-b rounded-xl p-2 border-primary">
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
                            <div class=" flex">
                                <p class=" w-32">Total</p>
                                <p>: Rp {{ number_format($total) }}</p>
                            </div>



                        </div>

                    </div>

                    <div class=" grid grid-cols-1 gap-3 md:grid-cols-3 lg:grid-cols-4">
                        @foreach ($pesanan->list as $item)
                            <div class="flex my-3 border-y-2 p-1">
                                <img class="w-24 rounded-md " src="{{ asset('storage/' . $item->menu->foto) }}"
                                    alt="">
                                <div class="ml-3">
                                    <p>{{ $item->menu->name }}</p>
                                    <p class=" text-xs">Catatan Khusus : <span
                                            class="font-semibold">{{ $item->keterangan }}</span></p>
                                    <p class="font-bold">{{ $item->jumlah }} </p>
                                    <p class="font-bold">{{ number_format($item->menu->harga) }} </p>
                                </div>
                            </div>
                        @endforeach


                    </div>


                </div>
            </main>
        </div>

    </div>
@endsection
