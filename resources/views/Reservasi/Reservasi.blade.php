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
                    <img class="w-24 rounded-md " src="{{ asset($item->menu->foto) }}" alt="">
                    <div class="ml-3">
                        <p>{{ $item->menu->name }}</p>
                        <p class=" text-xs">Catatan Khusus : <span class="font-semibold">{{ $item->keterangan }}</span></p>
                        <p class="font-bold">{{ $item->jumlah }} </p>
                    </div>
                </div>
            @endforeach
            <div class="">

                <h1 class="font-bold border-b border-black">Rinngkasan Pembayaran</h1>
                <h1 class=" text-slate-300">
                    Total pesanan ( {{ $jumlah }} memu) Rp. {{ number_format($total * 2, 2, ',', '.') }}
                </h1>
                <h1 class="border-b-2 border-black">
                    Down Payement yang sudah dibayar Rp. {{ number_format($total, 2, ',', '.') }}
                    Total kekurangan Rp. {{ number_format($total, 2, ',', '.') }}

                </h1>
            </div>



            <div class="flex mt-4 w-full ">
                <a class=" text-center text-primary border-primary border-2 py-1 mr-4 rounded-lg px-2 w-full"
                    href="{{ route('pesanan.reservasi.list', ['id' => $pesanan->id]) }}">Tunai</a>
                <button id="pay-button" class="bg-primary text-white py-1  rounded-lg px-2 w-full text-center  ">Non
                    Tunai</button>

            </div>


        </div>
    </div>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    window.location.href = "{{ route('pesanan.downpayment', ['id' => $pesanan->id]) }}"
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
@endsection
