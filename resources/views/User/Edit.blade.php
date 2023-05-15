@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <h1 class="font-bold text-2xl my-2 ">User Edit</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
            <form action="" method="post">
                @csrf
                <div class="flex mt-3">
                    <h1 class=" w-10">Nama</h1>
                    <h1>:{{ $user->name }}</h1>
                </div>
                <div class="flex mt-3">
                    <h1 class=" w-10">Email</h1>
                    <h1>:{{ $user->email }}</h1>
                </div>

                <div class=" flex items-center mt-3">
                    <label for="jabatan_id" class="block w-36">Jabatan</label>
                    <select name="jabatan_id" id="jabatan_id"
                        class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
                        <option value="">Pilih salah satu</option>
                        @foreach ($jabatan as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('jabatan_id')
                    <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                @enderror
                <div class="flex mt-4">
                    <a class=" text-center bg-primary text-white py-1 mr-4 rounded-lg px-2 w-40"
                        href="{{ route('user.index') }}">Kembali</a>
                    <button class="bg-primary text-white py-1  rounded-lg px-2 w-40" type="submit">Tambah Data</button>
                </div>
            </form>

        </div>
    </div>
@endsection
