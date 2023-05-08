@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class=" text-2xl font-bold">Data {{ $user[0]->name }}</h1>
    <form action="" method="post" class=" flex flex-col bg-white rounded-md shadow-md px-6 py-6 mt-4">
        <a href="{{ route('deleteDataDaful', ['nik' => $user[0]->nik]) }}" class="ml-auto  fill-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                    d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
            </svg>
        </a>
        @csrf
        <div class="flex">
            <h1 class=" font-semibold w-32">Email</h1>
            <h1>:</h1>
            <h1 class="ml-1">{{ $user[0]->email }}</h1>
        </div>
        <div class="flex">
            <h1 class=" font-semibold w-32">Nama</h1>
            <h1>:</h1>
            <h1 class="ml-1">{{ $user[0]->name }}</h1>
        </div>
        <div class="flex">
            <h1 class=" font-semibold w-32">NIK KTP</h1>
            <h1>:</h1>
            <h1 class="ml-1">{{ $user[0]->nik }}</h1>
        </div>
        <div class="flex">
            <h1 class=" font-semibold w-32">No.HP</h1>
            <h1>:</h1>
            <h1 class="ml-1">{{ $user[0]->no_hp }}</h1>


        </div>

        <div class=" flex items-center">
            <label class="block w-32" for="nis">NIS</label>
            <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="nis" name="nis"
                value=" {{ old('nis') }}">
        </div>
        @error('nis')
            <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
        @enderror
        <div class=" flex items-center">
            <label class="block w-32" for="kelas_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text"
                id="kelas_id" value=" {{ old('kelas_id') }}">
                <option value="">Pilih kelas</option>
                <option value="1">Ibtida</option>
                <option value="2">Awwaliyah</option>
                <option value="3">Wustho</option>
                <option value="4">Aliyah</option>
                <option value="5">Tahfidz</option>
            </select>
        </div>
        @error('kelas_id')
            <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
        @enderror
        <div class=" w-[500px] text-sm flex items-start my-3">

            <input class=" mt-1 mr-2" type="checkbox" name="konfirmasi" id="konfirmasi">
            <a @error('konfirmasi')
            class=" text-red-400"
            @enderror>Konfirmasi Bahwa santri
                telah menghubungi bendahara untuk koordinasi mengenai
                pembayaran tanggunagan Daftar
                Ulang
                Pondok Pesantren Nurul Hikmah </a>
        </div>
        <button class=" bg-primary rounded-md py-1 px-6 ml-4  text-white w-fit text-center font-semibold"
            type="submit">Konfirmasi</button>



    </form>
@endsection
