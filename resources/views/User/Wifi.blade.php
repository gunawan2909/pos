@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class=" font-bold text-xl">Akun WiFi</h1>
    <div class=" flex w-full">
        <div class=" bg-white rounded-md shadow-md p-3 mr-6 w-1/2">
            <h1 class=" font-bold text-lg mb-4">List Perangkat yang tertaut</h1>

            @foreach ($aktif as $item)
                <li class=" flex items-center w-full">
                    <span class="font-bold">
                        {{ $item['dhcp']['host-name'] ?? 'Tidak Diketahui ' }}
                    </span> &ensp;dengan IP &ensp;
                    <span class=" italic underline">
                        {{ $item['address'] }}
                    </span>
                    <form class="ml-auto" action="{{ route('user.wifi.aktif.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item['.id'] }}">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6q-.425 0-.713-.288T4 5q0-.425.288-.713T5 4h4q0-.425.288-.713T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5q0 .425-.288.713T19 6v13q0 .825-.588 1.413T17 21H7ZM7 6v13h10V6H7Zm0 0v13V6Zm5 7.9l1.9 1.9q.3.275.713.275t.687-.275q.3-.3.3-.713t-.3-.687l-1.9-1.9l1.9-1.9q.3-.3.3-.713t-.3-.687q-.275-.3-.688-.3t-.712.3L12 11.1l-1.9-1.9q-.275-.3-.688-.3t-.712.3q-.275.275-.275.688t.275.712l1.9 1.9l-1.9 1.9q-.275.275-.275.688t.275.712q.3.275.713.275t.687-.275l1.9-1.9Z"/></svg>
                        </button>
                    </form>
                </li>
            @endforeach
            @if (Session::has('sukses_perangkat'))
                <p class=" text-green-500">
                    {{ Session::get('sukses_perangkat') }}
                </p>
            @endif

        </div>

        @if ($wifi)
            <form action="{{ route('user.wifi.update') }}" method="POST" class=" bg-white rounded-md shadow-md p-3 w-1/2">
                <h1 class=" font-bold">Akun WiFi</h1>
                @csrf
                @if (Session::has('status'))
                    <p class=" text-green-500"> {{ Session::get('status') }} </p>
                @endif

                <div class=" flex items-center mt-3">
                    <p class="block w-36">Username</p>
                    <p class=" w-80 block ">{{ $wifi['name'] }}</p>
                </div>
                <input type="hidden" name="id" value="{{ $wifi['.id'] }}">
                <div class=" flex items-center mt-3">
                    <label for="password" class="block w-36">Confirm Password</label>
                    <input type="text" name="password" id="password" value="{{ $wifi['password'] }}"
                        class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
                </div>
                @error('password')
                    <span class=" text-[10px] text-red-500">{{ $message }}</span>
                @enderror
                <button class=" bg-blue-950 px-2 py-1 text-white text-md font-bold rounded-md w-64 mt-4">Ubah
                    Password</button>
            </form>
        @else
            <form action="{{ route('user.wifi.add') }}" method="POST" class=" bg-white rounded-md shadow-md p-3 w-1/2">
                <h1 class=" font-bold">Akun WiFi</h1>
                @csrf
                @if (Session::has('status'))
                    <p class=" text-green-500"> {{ Session::get('status') }} </p>
                @endif
                <div class=" flex items-center mt-3">
                    <p class="block w-36">Username</p>
                    <p class=" w-80 block ">{{ Auth::user()->nis }}</p>
                    <input type="hidden" name="name" value="{{ Auth::user()->nis }}">
                </div>
                <div class=" flex items-center mt-3">
                    <label for="password" class="block w-36">Password</label>
                    <input type="text" name="password" id="password"
                        class=" rounded-sm w-80 block px-2 border border-slate-300 ">
                </div>
                @error('password')
                    <span class=" text-[10px] text-red-500">{{ $message }}</span>
                @enderror

                <button class=" bg-blue-950 px-2 py-1 text-white text-md font-bold rounded-md w-64 mt-4">Buat Akun</button>
            </form>
        @endif
    </div>
@endsection
