@extends('Layout.App')
@section('content')
    <div class="p-2">

        <div class=" bg-white rounded-md shadow-md p-3">
            <div class=" flex items-center ">
                <img class=" h-16" src="{{ asset('\img\Logo.png') }}" alt="">
                <h1 class="text-center text-4xl ">Pesan Menu</h1>
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

            @foreach ($pesanan->list as $item)
                <div class="flex my-3 border-y-2 p-1">
                    <img class="w-24 rounded-md " src="{{ asset('storage/'.$item->menu->foto) }}" alt="">
                    <div class="ml-3">
                        <p>{{ $item->menu->name }}</p>
                        <p class=" text-xs">Catatan Khusus : <span class="font-semibold">{{ $item->keterangan }}</span></p>
                        <p class="font-bold">Rp. {{ number_format($item->menu->harga, 2, ',', '.') }}</p>
                    </div>
                    <div class=" ml-auto items-end flex space-x-4 fill-slate-500">
                        <a class="mr-10 border-l-2 px-2  justify-end flex"
                            href="{{ route('pesanan.reservasi.list.delete', ['id' => $item->id]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M5 21V6H4V4h5V3h6v1h5v2h-1v15H5Zm2-2h10V6H7v13Zm2-2h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
                            </svg>
                        </a>
                        <form class="flex {{ $item->jumlah == 1 ? 'fill-slate-400' : 'fill-red-400' }} "
                            action="{{ route('pesanan.reservasi.list.min', ['id' => $item->id]) }}" method="post">
                            @csrf
                            <button type="submit" {{ $item->jumlah == 1 ? 'disabled' : '' }}>
                                <input type="hidden" name="jumlah" value="{{ $item->jumlah }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 20c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2M7 13h10v-2H7" />
                                </svg>
                            </button>
                        </form>
                        <p>{{ $item->jumlah }}</p>
                        <form class="flex fill-green-400"
                            action="{{ route('pesanan.reservasi.list.add', ['id' => $item->id]) }}" method="post">
                            @csrf
                            <button type="submit">
                                <input type="hidden" name="jumlah" value="{{ $item->jumlah }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4v4Zm1 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                                </svg>
                            </button>
                        </form>




                    </div>
                </div>
            @endforeach



            <div class="flex mt-4 w-full ">
                <a class=" text-center text-primary border-primary border-2 py-1 mr-4 rounded-lg px-2 w-full"
                    href="{{ route('pesanan.reservasi.add') }}">Kembali</a>
                <a @if ($pesanan->list->count() > 0) href="{{ route('pesanan.invoice', ['id' => $pesanan->id]) }}" @endif
                    class="bg-primary text-white py-1  rounded-lg px-2 w-full text-center  ">Lanjut</a>

            </div>


        </div>
        <h1 class=" text-xl font-bold w-full text-center my-3">Menu yang tersedia</h1>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 mt-3 gap-4">
            @foreach ($menu as $item)
                <div class=" rounded-lg shadow-lg bg-white pb-1 w-40">
                    <img class=" object-cover rounded-t-lg " src="{{ asset($item->foto) }}" alt="">
                    <form method="post" action="" class=" px-2 pb-3  flex flex-col ">
                        @csrf
                        <p class="">{{ $item->name }}</p>
                        <p class=" truncate  text-[12px]">{{ $item->keterangan }}</p>
                        <p class=" font-bold mt-3">Rp. {{ number_format($item->harga, 2, ',', '.') }}</p>
                        <div class=" text-[12px] mt-2">
                            <label for="jumlah">Jumlah :</label>
                            <input value="1" type="number" name="jumlah" id="jumlah"
                                class=" text-center rounded-xl border w-10">
                            <input type="hidden" name="menu_id" value="{{ $item->id }}">
                            <input type="hidden" name="pesanan_id" value="{{ $pesanan->id }}">
                        </div>
                        <div class=" text-[12px] mt-2">

                            <input type="text" name="keterangan" placeholder="Keterangan" class=" text w-full">

                        </div>

                        <button class=" rounded-lg border border-primary text-primary font-semibold shadow-md mt-3"
                            type="submit">Pesan</button>

                    </form>
                </div>
            @endforeach

        </div>
    @endsection
