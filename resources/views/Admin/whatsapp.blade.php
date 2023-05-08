@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class="font-bold text-2xl my-2 ">Data santri</h1>
    <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">

        <div id="app">
            <h1 class=" font-bold">Whatsapp API</h1>
            <img class="w-32 hidden" src="" alt="QR Code" id="qrcode">
            <h3>Logs:</h3>
            <ul class="logs"></ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            var socket = io.connect('https://ppnh.co.id:2053', {
                path: '/socket.io'

            })
            socket.on('message', function(msg) {
                $('.logs').prepend($('<li>').text(msg));
            });

            socket.on('qr', function(src) {
                $('#qrcode').attr('src', src);
                $('#qrcode').show();
            });

            socket.on('ready', function(data) {
                $('#qrcode').hide();
            });

            socket.on('authenticated', function(data) {
                $('#qrcode').hide();
            });

        })
    </script>
@endsection
