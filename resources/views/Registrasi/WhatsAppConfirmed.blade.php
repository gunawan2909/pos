@extends('Layout.app')
@section('content')
    <form action="{{ route('otp', ['nik' => $user->nik]) }}" method="POST"
        class=" flex flex-col items-center justify-center h-full w-full">
        @csrf
        <img class=" w-[240px]" src="{{ asset('img/registrasi.png') }}" alt="">
        <h1 class=" w-80 text-center my-6">Silahkan Masukan Kode OTP yang sudah dikirimkan ke No {{ $user->no_hp ?? '' }}
            melalui WhatsApp
        </h1>
        @error('otp')
            <span class=" text-xs text-red-500 my-1">{{ $message }}</span>
        @enderror
        <input type="text" class=" border border-slate-700 w-72 rounded-md text-center" name="otp" id="otp">
        <button class=" w-60 mt-8 bg-primary text-white rounded-sm py-1" type="submit">Kirim</button>

        <a class=" mt-6 underline text-sm" href="{{ route('sendotp', ['nik' => $user->nik]) }}"> Kirim Ulang Kode </a>
    </form>
@endsection
