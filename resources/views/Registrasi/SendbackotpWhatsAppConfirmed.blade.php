@extends('Layout.app')
@section('content')
    <form action="{{ route('sendotp', ['nik' => $user->nik]) }}" method="POST"
        class=" flex flex-col items-center justify-center h-full w-full">
        @csrf
        <img class=" w-[240px]" src="{{ asset('img/registrasi.png') }}" alt="">
        <h1 class=" w-80 text-center my-6">Silahkan priksa Nomor yang Anda gunakan dan pastikan terdaftar dalam
            <span class=" font-bold">WhatsApp</span>

        </h1>
        @error('no_hp')
            <span class=" text-xs text-red-500 my-1">{{ $message }}</span>
        @enderror
        <input type="text" class=" border border-slate-700 w-72 rounded-md text-center" name="no_hp"
            value="{{ $user->no_hp }}" id="no_hp" value="{{ $user->no_hp }}">
        <button class=" w-60 mt-8 bg-primary text-white rounded-sm py-1" type="submit">Kirim Ulang Kode</button>

    </form>
@endsection
