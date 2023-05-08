@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class=" text-2xl font-bold mt-6">Buat Invoice </h1>

    @switch(request('kind'))
        @case('umum')
            <form action="" method="post" class=" flex flex-col bg-white rounded-md shadow-md px-6 py-6 mt-4">
                @csrf
                <h1 class=" text-xl font-bold ">Invoice Umum</h1>

                <div class=" flex items-center">
                    <label class="block w-32" for="name">Nama</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="name" name="name"
                        value=" {{ old('name') }}">
                </div>
                @error('name')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror


                <div class=" flex items-center">
                    <label class="block w-32" for="jumlah">Nominal</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="jumlah" name="jumlah"
                        value=" {{ old('jumlah') }}">
                </div>
                @error('jumlah')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror

                <div class=" flex items-center">
                    <label class="block w-32" for="period">Interval</label>
                    <select name="period" id="period" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text"
                        id="period" value=" {{ old('period') }}">
                        <option value="true">Bulanan</option>
                        <option value="false">1 Kali</option>
                    </select>
                </div>
                @error('period')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror
                @error('kepada')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror

                <div class=" flex items-center">
                    <label class="block w-32" for="kelamin">Kang/Mbak</label>
                    <select name="kelamin" id="kelamin" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text"
                        id="kelamin" value=" {{ old('kelamin') }}">
                        <option value="0">Semua</option>
                        <option value="1">Putra</option>
                        <option value="2">Putri</option>

                    </select>
                </div>
                <div class=" flex items-center">
                    <label class="block w-32" for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text"
                        id="kelas_id" value=" {{ old('kelas_id') }}">
                        <option value="0">Semua</option>
                        <option value="1">Ibtida</option>
                        <option value="2">Awwaliyah</option>
                        <option value="3">Wustho</option>
                        <option value="4">Aliyah</option>
                        <option value="5">Tahfidz</option>
                    </select>
                </div>

                <div class=" flex items-center">
                    <label class="block w-32" for="keterangan">Keterangan</label>
                    <select name="keterangan" id="keterangan" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md"
                        type="text" id="keterangan">
                        <option value="1">Tagihan diluar syahriah bulanan</option>
                        <option value="2">Syahriah bulanan tetap</option>
                        <option value="3">Syahriah bulanan tidak tetap</option>
                    </select>
                </div>
                <input type="hidden" name="kind" value="umum">
                <button class=" bg-primary rounded-md py-1 px-6 mt-4  text-white w-fit text-center font-semibold"
                    type="submit">Konfirmasi</button>



            </form>
        @break

        @case('spesifik')
            <form action="" method="post" class=" flex flex-col bg-white rounded-md shadow-md px-6 py-6 mt-4">
                @csrf
                <h1 class=" text-xl font-bold ">Invoice Spesifik</h1>

                <div class=" flex items-center">
                    <label class="block w-32" for="name">Nama</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="name" name="name"
                        value=" {{ old('name') }}">
                </div>
                @error('name')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror

                
             
                <div class=" flex items-center">
                    <label class="block w-32" for="jumlah">Nominal</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="jumlah"
                        name="jumlah" value=" {{ old('jumlah') }}">
                </div>
                @error('jumlah')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror

                <div class=" flex items-center">
                    <label class="block w-32" for="period">Interval</label>
                    <select name="period" id="period" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md"
                        type="text" id="period" value=" {{ old('period') }}">
                        <option value="true">Bulanan</option>
                        <option value="false">1 Kali</option>
                    </select>
                </div>
                @error('period')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="kepada">Kepada NIS</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="kepada"
                        name="kepada" value=" {{ old('kepada') }}">
                </div>
                @error('kepada')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror


                <input type="hidden" name="kind" value="spesifik">
                <div class=" flex items-center">
                    <label class="block w-32" for="keterangan">Keterangan</label>
                    <select name="keterangan" id="keterangan" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md"
                        type="text" id="keterangan">
                        <option value="1">Tagihan diluar syahriah bulanan</option>
                        <option value="2">Syahriah bulanan tetap</option>
                        <option value="3">Syahriah bulanan tidak tetap</option>
                    </select>
                </div>
                <button class=" bg-primary rounded-md py-1 px-6 mt-4  text-white w-fit text-center font-semibold"
                    type="submit">Konfirmasi</button>



            </form>
        @break

        @default
    @endswitch
@endsection
