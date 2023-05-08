@extends('Layout.Dashboard')
@section('dashboard')
    @if (Auth::user()->status == 'belum daftar ulang')
        <div class=" flex flex-col h-[80vh] items-center justify-center">
            <img class=" w-38 my-10" src="{{ Vite::asset('resources/img/sukses.png') }}" alt="">
            <h1 class=" font-bold text-3xl text-center ">Selamat!</h1>
            <p class=" text-center mt-3">Bendahara telah mengkonfirmasi pembayaran anda silahkan melanjutkan daftar ulang
                dengan mengisi Form dibawah ini</p>
            <a href="{{ route('formdaftarulang') }}" class=" bg-primary text-white font-bold py-2 px-4 rounded-md mt-10">Form
                Daftar Ulang</a>
        </div>
    @endif
    @if (Auth::user()->status == 'belum lunas pembayaran')
        <div class=" flex flex-col h-[80vh] items-center justify-center">
            <img class=" w-38 my-10" src="{{ Vite::asset('resources/img/sukses.png') }}" alt="">
            <h1 class=" font-bold text-3xl text-center ">Selamat!</h1>
            <p class=" text-center mt-3">Formulir anda telah terkirim. Segera hubungi bendahara untuk
                verifikasi pembayaran untuk melanjutkan pengisian form daftar Ulang.</p>
            <a class="bg-slate-300 text-white font-bold py-2 px-4 rounded-md mt-10">Form Daftar Ulang</a>
        </div>
    @endif
    @if (Auth::user()->status == 'aktif')
        <div class=" flex flex-col h-[80vh] items-center justify-center">
            <img class=" w-38 my-10" src="{{ Vite::asset('resources/img/sukses.png') }}" alt="">
            <h1 class=" font-bold text-3xl text-center ">Selamat!</h1>
            <p class=" text-center mt-3">Proses Daftar Ulang Telah Selesai</p>
        </div>
    @endif
@endsection
