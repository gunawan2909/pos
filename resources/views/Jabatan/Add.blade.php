@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <h1 class="font-bold text-2xl my-2 ">Tambah Jabatan</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
            <form action="" method="post">
                @csrf
                <label for="name" class="block w-36">Nama</label>
                <input name="name" id="name" type="text" value="{{ old('name') }}"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
                @error('name')
                    <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                @enderror
                <label for="gaji" class="block w-36">Gaji/Hari</label>
                <input name="gaji" id="gaji" type="text" value="{{ old('gaji') }}"
                    class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
                @error('gaji')
                    <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                @enderror

                <div class="flex mt-4">
                    <a class=" text-center bg-primary text-white py-1 mr-4 rounded-lg px-2 w-40"
                        href="{{ route('jabatan.index') }}">Kembali</a>
                    <button class="bg-primary text-white py-1  rounded-lg px-2 w-40" type="submit">Tambahkan
                        Jabatan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
