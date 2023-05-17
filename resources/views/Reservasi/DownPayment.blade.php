@extends('Layout.App')
@section('content')
    <div class="p-2">
        <div class=" bg-white rounded-md shadow-md p-3">
            <h1 class="text-center text-2xl font-bold">Pesanan</h1>
            <div class="h-1 w-full bg-neutral-200 my-3 ">
                <div class="h-1 bg-primary" style="width: 80%"></div>
            </div>
            <div class="flex flex-col w-full">

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

            <h1 class="w-full text-center my-3">Daftar Pesanan</h1>
            <table class="table-auto  text-center w-full mt-4">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>@Harga</th>
                        <th>Total</th>

                    </tr>
                </thead>
                @php
                    $total = 0;
                @endphp
                <tbody class="border-b border-slate-500 text-sm">
                    @foreach ($pesanan->list as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->menu->name }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ number_format($item->menu->harga, 2, ',', '.') }}</td>
                            <td>
                                {{ number_format($item->menu->harga * $item->jumlah, 2, ',', '.') }}
                                @php
                                    $total += $item->menu->harga * $item->jumlah;
                                @endphp

                            </td>
                        </tr>
                    @endforeach
                    <tr class=" border-t-2 border-black">
                        <td>
                            Total
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Rp. {{ number_format($total, 2, ',', '.') }}</td>
                    </tr>
                </tbody>

            </table>
            <div class="flex mt-4 w-full ">
                <a class=" text-center text-primary border-primary border-2 py-1 mr-4 rounded-lg px-2 w-full"
                    href="{{ route('pesanan.list', ['id' => $pesanan->id]) }}">Kembali</a>

                <button id="pay-button"
                    class="bg-primary text-white py-1  rounded-lg px-2 w-full text-center  ">Lanjut</button>

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
                    window.location.href = "{{ route('home') }}"
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
