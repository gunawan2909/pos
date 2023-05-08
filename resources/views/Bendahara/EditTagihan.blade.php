@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class=" text-2xl font-bold mt-6">Buat Invoice </h1>

    @switch($kind)
        @case('umum')
            <form action="" method="post" class=" flex flex-col bg-white rounded-md shadow-md px-6 py-6 mt-4">
                <a href="{{ route('bendahara.delete', ['id' => $data->id]) }}" class="ml-auto  fill-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
                    </svg>
                </a>
                @csrf
                <h1 class=" text-xl font-bold ">Invoice Umum</h1>

                <div class=" flex items-center">
                    <label class="block w-32" for="name">Nama</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="name" name="name"
                        value=" {{ $data->name }}">
                </div>
                @error('name')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror


                <div class=" flex items-center">
                    <label class="block w-32" for="jumlah">Nominal</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="jumlah" name="jumlah"
                        value=" {{ $data->jumlah }}">
                </div>
                @error('jumlah')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror

                <div class=" flex items-center">
                    <label class="block w-32" for="period">Interval</label>
                    <select name="period" id="period" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text"
                        id="period">

                        <option @if ($data->period == 'true') selected @endif value="true">Bulanan</option>
                        <option @if ($data->period == 'false') selected @endif value="false">1 Kali</option>
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
                        <option @if ($data->kepada->kelamin == '0') selected @endif value="0">Semua</option>
                        <option @if ($data->kepada->kelamin == '1') selected @endif value="1">Putra</option>
                        <option @if ($data->kepada->kelamin == '2') selected @endif value="2">Putri</option>

                    </select>
                </div>
                <div class=" flex items-center">
                    <label class="block w-32" for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text"
                        id="kelas_id" value=" {{ old('kelas_id') }}">
                        <option @if ($data->kepada->kelas == '0') selected @endif value="0">Semua</option>
                        <option @if ($data->kepada->kelas == '1') selected @endif value="1">Ibtida</option>
                        <option @if ($data->kepada->kelas == '2') selected @endif value="2">Awwaliyah</option>
                        <option @if ($data->kepada->kelas == '4') selected @endif value="3">Wustho</option>
                        <option @if ($data->kepada->kelas == '5') selected @endif value="4">Aliyah</option>
                        <option @if ($data->kepada->kelas == '6') selected @endif value="5">Tahfidz</option>
                    </select>
                </div>
                <input type="hidden" name="kind" value="spesifik">
                <div class=" flex items-center">
                    <label class="block w-32" for="keterangan">Keterangan</label>
                    <select name="keterangan" id="keterangan" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md"
                        type="text" id="keterangan">
                        <option {{ $data->keterngan == '1' ? 'slected' : '' }} value="1">Tagihan
                            diluar syahriah bulanan</option>
                        <option {{ $data->keterngan == '2' ? 'slected' : '' }} value="2">Syahriah bulanan tetap</option>
                        <option {{ $data->keterngan == '3' ? 'slected' : '' }} value="3">Syahriah bulanan tidak tetap</option>
                    </select>
                </div>

                <input type="hidden" name="kind" value="umum">
                <button class=" bg-primary rounded-md py-1 px-6 mt-4  text-white w-fit text-center font-semibold"
                    type="submit">Konfirmasi</button>



            </form>
        @break

        @case('spesifik')
            <form action="" method="post" class=" flex flex-col bg-white rounded-md shadow-md px-6 py-6 mt-4">
                <a href="{{ route('bendahara.delete', ['id' => $data->id]) }}" class="ml-auto  fill-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
                    </svg>
                </a>
                @csrf
                <h1 class=" text-xl font-bold ">Invoice Spesifik</h1>

                <div class=" flex items-center">
                    <label class="block w-32" for="name">Nama</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="name"
                        name="name" value=" {{ $data->name, old('name') }}">
                </div>
                @error('name')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror

                <div class=" flex items-center">
                    <label class="block w-32" for="keterangan">Keterangan</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="keterangan"
                        name="keterangan" value=" {{ $data->keterangan, old('keterangan') }}">
                </div>
                @error('keterangan')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="jumlah">Nominal</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="jumlah"
                        name="jumlah" value=" {{ $data->jumlah }}">
                </div>
                @error('jumlah')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror

                <div class=" flex items-center">
                    <label class="block w-32" for="period">Interval</label>
                    <select name="period" id="period" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md"
                        type="text" id="period">

                        <option @if ($data->period == 'true') selected @endif value="true">Bulanan</option>
                        <option @if ($data->period == 'false') selected @endif value="false">1 Kali</option>
                    </select>
                </div>
                @error('period')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="kepada">Kepada NIS</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="kepada"
                        name="kepada" value=" {{ $data->kepada->nis }}">
                </div>
                @error('kepada')
                    <span class=" text-xs text-red-400 ml-32 ">{{ $message }}</span>
                @enderror


                <input type="hidden" name="kind" value="spesifik">
                <div class=" flex items-center">
                    <label class="block w-32" for="keterangan">Keterangan</label>
                    <select name="keterangan" id="keterangan" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md"
                        type="text" id="keterangan">
                        <option {{ $data->keterngan == '1' ? 'slected' : '' }} value="1">Tagihan
                            diluar syahriah bulanan</option>
                        <option {{ $data->keterngan == '2' ? 'slected' : '' }} value="2">Syahriah bulanan tetap</option>
                        <option {{ $data->keterngan == '3' ? 'slected' : '' }} value="3">Syahriah bulanan tidak tetap
                        </option>
                    </select>
                </div>
                <button class=" bg-primary rounded-md py-1 px-6 mt-4  text-white w-fit text-center font-semibold"
                    type="submit">Konfirmasi</button>



            </form>
        @break

        @default
    @endswitch
@endsection
