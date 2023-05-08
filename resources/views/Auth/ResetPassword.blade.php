@extends('Layout.app')
@section('content')
    <div class=" flex w-full h-full items-center justify-center">
        <div class=" w-1/2">
            <img src="{{ asset('img/registrasi.png') }}" alt="">
        </div>
        <form action="{{ route('password.reset', ['token' => $token]) }}" method="post">
            @csrf
            <h1 class=" text-xl font-semibold">Formulir Pendaftran</h1>
            <input type="hidden" name="token" value="{{ $token }}">
            <div class=" flex items-center mt-3">
                <label for="email" class="block w-36">Email</label>
                <input type="email" placeholder="Example@example.com" name="email" id="email"
                    value=" {{ old('email') }}"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            @error('email')
                <span class=" text-[10px] ml-36 text-red-500">{{ $message }}</span>
            @enderror
            <div class=" flex items-center mt-3">
                <label for="password" class="block w-36">Password</label>
                <input type="password" placeholder="******" name="password" id="password"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            @error('password')
                <span class=" text-[10px] ml-36 text-red-500">{{ $message }}</span>
            @enderror
            <div class=" flex items-center mt-3">
                <label for="password_confirmation" class="block w-36">Confirm Password</label>
                <input type="password" placeholder="******" name="password_confirmation" id="password_confirmation"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            <div class=" flex mt-6">
                <button type="submit" class=" bg-primary text-md py-1 font-bold text-white rounded-md px-3 block ">Reset
                    Password</button>
            </div>

        </form>
    </div>
@endsection
