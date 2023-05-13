@extends('Layout.App')
@section('content')
    <div class="p-2">

        <div class=" bg-white rounded-md shadow-md p-3">
            <div class=" flex items-center ">
                <img class=" h-16" src="{{ asset('\img\Logo.png') }}" alt="">
                <h1 class="text-center text-4xl "></h1>
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
                    <div class=" flex">
                        <p class=" w-32">Total</p>
                        <p>
                            : Rp. {{ number_format($total * 2, 2, ',', '.') }}
                        </p>
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
                    <img class="w-24 rounded-md " src="{{ asset($item->menu->foto) }}" alt="">
                    <div class="ml-3">
                        <p>{{ $item->menu->name }}</p>
                        <p class=" text-xs">Catatan Khusus : <span class="font-semibold">{{ $item->keterangan }}</span></p>
                        <p class="font-bold">Rp. {{ number_format($item->menu->harga, 2, ',', '.') }}</p>
                    </div>
                    @if ($pesanan->status != 'Paid')
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4v4Zm1 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                                    </svg>
                                </button>
                            </form>




                        </div>
                    @endif
                </div>
            @endforeach
            @if ($pesanan->status != 'Paid')
                <div class="">

                    <h1 class="font-bold border-b border-black">Rinngkasan Pembayaran</h1>
                    <h1 class=" text-slate-300">
                        Total pesanan ( {{ $jumlah }} memu) Rp. {{ number_format($total, 2, ',', '.') }}
                    </h1>
                    <h1 class="border-b-2 border-black">
                        Total Rp. {{ number_format($total, 2, ',', '.') }}

                    </h1>
                </div>



                <div class="flex mt-4 w-full ">
                    <form class="w-full mr-4" action="{{ route('pesanan.pay.customer', ['id' => $pesanan->id]) }}"
                        method="get">
                        <button
                            class="w-full  text-center text-primary border-primary border-2 py-1  rounded-lg px-2">Tunai</button>

                    </form>
                    <button id="pay-button" class="bg-primary text-white py-1  rounded-lg px-2 w-full text-center  ">Non
                        Tunai</button>

                </div>
            @endif


        </div>
    </div>

    @if ($snapToken != null)
        <script type="text/javascript">
            // For example trigger on button clicked, or any time you need
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function() {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        /* You may add your own implementation here */
                        alert("payment success!");
                        window.location.href =
                            "{{ route('pesanan.reservasi.add') }}"
                    },
                    onPending: function(result) {
                        /* You may add your own implementation here */
                        alert("wating your payment!");
                        console.log(result);
                    },
                    onError: function(result) {
                        /* You may add your own implementation here */
                        alert("payment failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                })
            });
        </script>
    @endif
@endsection
