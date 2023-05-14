@extends('Layout.App')
@section('content')
    <form action="{{ route('password.request') }}" method="POST"
        class=" flex flex-col items-center justify-center h-full w-full">
        @csrf
        <img class=" w-[240px]" src="{{ asset('img/registrasi.png') }}" alt="">
        <h1 class=" w-80 text-center my-6">Silahkan masukan Email yang anda daftarkan
        </h1>
        <input name="email" type="email" class=" px-2 w-64 rounded-md border border-slate-300">
        @error('email')
            <span>{{ $message }}</span>
        @enderror
        @if (Session::has('status'))
            <p class=" text-md text-green-400">
                {{ Session::get('status') }}
            </p>
        @endif
        <button class=" w-60 mt-8 bg-primary text-white rounded-sm py-1" type="submit">Kirim Link Ke Email</button>
    </form>
@endsection
