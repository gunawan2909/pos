@extends('Layout.App')
@section('content')
    <form action="/email/verification-notification" method="POST"
        class=" flex flex-col items-center justify-center h-full w-full">
        @csrf
        <img class=" w-[240px]" src="{{ asset('img/registrasi.png') }}" alt="">
        <h1 class=" w-80 text-center my-6">Silahkan cek email anda Untuk verifikasi akun, periksa email. Ikuti petunjuk dalam
            email untuk menyelesaikan proses verifikasi dan dapatkan akses layanan sepenuhnya. <span class=" font-bold">
                {{ Auth::user()->email }}</span>

        </h1>
        <button class=" w-60 mt-8 bg-primary text-white rounded-sm py-1" type="submit">Kirim Ulang</button>
    </form>
@endsection
