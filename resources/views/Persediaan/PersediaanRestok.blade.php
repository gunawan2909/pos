@extends('Layout.Dashboard')
@section('dashboard')
    <div class=" p-2">
        <H1 class=" font-bold text-3xl">Restock {{ $persediaan->name }}</H1>
        <div class=" bg-white rounded-sm p-6 rounded-md shadow-md w-fit">
            <p class=" ">
                Jumlah Stok hari ini sebanyak
                <span class=" font-bold">
                    {{ $persediaan->jumlah }}
                </span>
                {{ $persediaan->satuan }}
            </p>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class=" flex items-center mt-3">
                    <label for="jumlah" class="block w-36">Jumlah</label>
                    <input type="text" placeholder="" name="jumlah" id="jumlah" value="{{ old('jumlah') }}"
                        class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
                    <label for="jumlah" class="block w-36 ml-2">{{ $persediaan->satuan }}</label>
                </div>
                @error('jumlah')
                    <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                @enderror
                <div class=" flex items-center mt-3">
                    <label for="nominal" class="block w-36">Harga</label>
                    <input type="text" name="nominal" id="nominal" value="{{ old('nominal') }}"
                        class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
                </div>
                @error('nominal')
                    <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                @enderror
                <div class=" flex items-center mt-3">
                    <label for="kuitansi" class="block w-36">Bukti Transaksi</label>
                    <input type="file" name="kuitansi" id="kuitansi"
                        class=" rounded-sm w-80 block px-2 border border-slate-300 placeholder:text-slate-300">
                </div>
                @error('kuitansi')
                    <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                @enderror
                <div class="flex mt-4">

                    <a class=" text-center bg-primary text-white py-1 mr-4 rounded-lg px-2 w-40"
                        href="{{ route('persediaan') }}">Kembali</a>
                    <button class="bg-primary text-white py-1  rounded-lg px-2 w-40" type="submit">Restock
                        Persediaan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
