@extends('Layout.app')
@section('content')
    <div class=" flex flex-col items-center justify-center h-full w-full "
        style="background-image: url('{{ asset('img/backgroundLogin.png') }}')">
        <div class=" flex w-fit mx-auto mb-6">
            <h1 class=" text-4xl text-blue-950 font-bold mr-3">SSA</h1>
            <img src="{{ asset('img/LogoPondok.svg') }}">
        </div>
        <form action="{{ route('login') }}" method="post"
            class=" mx-auto bg-white shadow-lg border-t-2 border-blue-950 w-[500px] rounded-md p-6 flex flex-col items-center ">
            @csrf
            <h1 class=" text-xl font-bold mb-2">Silahkan login dengan Akun Anda</h1>
            <div class=" flex border border-slate-400 w-3/4 rounded-sm p-1 my-3 bg-white ">
                <label for="nis">
                    <i class="w-6 h-6  stroke-slate-400 " data-feather="user"></i>
                </label>
                <input type="text" name="nis" placeholder="Email Atus Nis" id="nis"
                    class="  ml-3 px-2  outline-none  w-full">
            </div>

            <div class=" flex border border-slate-400 w-3/4 rounded-sm p-1 bg-white ">
                <label for="password">
                    <i class="w-6 h-6  stroke-slate-400 " data-feather="lock"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password"
                    class="  ml-3 px-2  outline-none  w-full">
            </div>
            <div class=" w-3/4 flex my-1">
                <input type="checkbox" name="remembered" id="remembered">
                <label for="remembered" class=" ml-2"> Ingat Saya</label>
                <a href="{{ route('password.request') }}" class="ml-auto font-semibold">Lupa Password?</a>
            </div>
            <button type="submit" class=" w-3/4 bg-primary text-white p-1 mt-1 rounded-sm font-bold ">Login</button>
            @error('email')
                <span class=" text-xs text-red-500 mt-3">{{ $message }}</span>
            @enderror
            @if (Session::has('status'))
                <span class=" text-xs text-red-500 mt-3"> {{ Session::get('status') }}</span>
            @endif
        </form>
        <p class=" text-slate-700 mt-3">Copyright © 2022 - Pondok Pesantren Nurul Hikmah</p>
    </div>
@endsection
