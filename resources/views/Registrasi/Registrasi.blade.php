@extends('Layout.app')
@section('content')
    <div class=" flex w-full h-full items-center justify-center">
        <div class=" w-1/2">
            <img src="{{ asset('img/registrasi.png') }}" alt="">
        </div>
        <form action="{{ route('registrasi') }}" method="post">
            @csrf
            <h1 class=" text-xl font-semibold">Formulir Pendaftran</h1>
            <div class=" flex items-center mt-3">
                <label for="nik" class="block w-36">NIK KTP</label>
                <input type="text" placeholder="NIK KTP" name="nik" id="nik" value="{{ old('nik') }}"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            @error('nik')
                <span class=" text-[10px] text-red-500">{{ $message }}</span>
            @enderror
            <div class=" flex items-center mt-3">
                <label for="name" class="block w-36">Nama Lengkap</label>
                <input type="text" placeholder="Nama Lengkap" name="name" id="name" value="{{ old('name') }}"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            @error('name')
                <span class=" text-[10px] text-red-500">{{ $message }}</span>
            @enderror
            <div class=" flex items-center mt-3">
                <label for="no_hp" class="block w-36">No HP</label>
                <input type="text" placeholder="08574******" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            @error('no_hp')
                <span class=" text-[10px] text-red-500">{{ $message }}</span>
            @enderror
            <div class=" flex items-center mt-3">
                <label for="email" class="block w-36">Email</label>
                <input type="email" placeholder="Example@example.com" name="email" id="email"
                    value=" {{ old('email') }}"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            @error('email')
                <span class=" text-[10px] text-red-500">{{ $message }}</span>
            @enderror
            <div class=" flex items-center mt-3">
                <label for="password" class="block w-36">Password</label>
                <input type="password" placeholder="******" name="password" id="password"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            @error('password')
                <span class=" text-[10px] text-red-500">{{ $message }}</span>
            @enderror
            <div class=" flex items-center mt-3">
                <label for="password_confirmation" class="block w-36">Confirm Password</label>
                <input type="password" placeholder="******" name="password_confirmation" id="password_confirmation"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
            </div>
            <div class=" flex mt-6">

                <a href="{{ route('login') }}" class="underline mr-auto font-semibold">Sudah Punya Akun</a>
                <button type="submit" class=" bg-primary text-md py-1 font-bold text-white rounded-md px-3 block ">Next
                    ></button>
            </div>

        </form>
    </div>
@endsection
