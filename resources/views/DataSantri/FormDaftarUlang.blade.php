@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class="font-bold text-2xl my-2 ">Form Daftar Ulang Santri</h1>
    <form action="" method="post" class="flex">
        @csrf
        <div class=" flex  flex-col">
            <div class=" bg-white rounded-sm w-fit p-5 rounded-md shadow-md">
                <h1 class="font-bold text-lg ">Data santri</h1>
                <div class=" flex items-center">
                    <label class="block w-32" for="nik">NIK KTP</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="nik"
                        name="nik" value="{{ Auth::user()->nik }}" disabled>
                </div>
                @error('nik')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="name">Nama Lengkap</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="name"
                        name="name"value="{{ Auth::user()->name }}" disabled>
                </div>
                @error('name')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="kelamin">Jenis Kelamin</label>
                    <select class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" name="kelamin" id="kelamin">
                        <option value="">Pilih salah satu</option>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>

                </div>
                @error('kelamin')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="tempat_lahir">Tempat Lahir</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="tempat_lahir"
                        name="tempat_lahir"value="{{ old('tempat_lahir') }}">
                </div>
                @error('tempat_lahir')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="tanggal_lahir">Tanggal Lahir</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="date" id="tanggal_lahir"
                        name="tanggal_lahir"value="{{ old('tanggal_lahir') }}">
                </div>
                @error('tanggal_lahir')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="no_hp">No.HP</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="no_hp"
                        name="no_hp"value="{{ Auth::user()->no_hp }}" disabled>
                </div>
                @error('no_hp')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror

            </div>
            <div class=" bg-white rounded-sm w-fit p-5 rounded-md shadow-md mt-4">
                <h1 class="font-bold text-lg ">Alamat Asal</h1>

                <div class=" flex items-center">
                    <label class="block w-32" for="provinsi">Provinsi</label>
                    <select class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" name="provinsi" id="provinsi">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinsi as $item)
                            <option value="{{ $item->code }}">{{ $item->name }}</option>
                        @endforeach


                    </select>
                </div>
                <div class=" flex items-center">
                    <label class="block w-32" for="kabupaten">Kabupaten/Kota</label>
                    <select class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" name="kabupaten" id="kabupaten">
                        <option>-</option>

                    </select>
                </div>
                <div class=" flex items-center">
                    <label class="block w-32" for="kecamatan">Kecamatan</label>
                    <select class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" name="kecamatan" id="kecamatan">
                        <option>-</option>
                    </select>
                </div>
                <div class=" flex items-center">
                    <label class="block w-32" for="desa">Desa</label>
                    <select class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" name="alamat1" id="desa">
                        <option value="">-</option>
                    </select>

                </div>
                @error('alamat1')
                    <span class="text-red-400 text-xs ml-32">Pilih Tempat Asal</span>
                @enderror

                <div class=" flex items-start">
                    <label class="block w-32" for="alamat2">Alamat</label>
                    <textarea value="{{ old('alamat2') }}" class=" mt-3 px-2 w-80 border-slate-300 border rounded-md h-24 text-start"
                        id="alamat2" name="alamat2"></textarea>

                </div>
                @error('alamat2')
                    <span class="text-red-400 text-xs ml-32">Isikan Alamat Detail</span>
                @enderror


            </div>


        </div>
        <div class=" flex  flex-col ml-4 ">
            <div class=" bg-white rounded-sm w-fit p-5 rounded-md shadow-md ">
                <h1 class="font-bold text-lg ">Nasab Santri</h1>
                <div class=" flex items-center">
                    <label class="block w-32" for="ayah">Nama Ayah</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="ayah"
                        name="ayah" value="{{ old('ayah') }}">
                </div>
                @error('ayah')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror

                <div class=" flex items-center">
                    <label class="block w-32" for="ibu">Nama Ibu</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="ibu"
                        name="ibu"value="{{ old('ibu') }}">
                </div>
                @error('ibu')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="no_wali">No.HP Wali</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="no_wali"
                        name="no_wali"value="{{ old('no_wali') }}">
                </div>
                @error('no_wali')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror

            </div>
            <div class=" bg-white rounded-sm w-fit p-5 rounded-md shadow-md mt-4">
                <h1 class="font-bold text-lg ">Pendidikan yang ditempuh</h1>
                <div class=" flex items-center">
                    <label class="block w-32" for="universitas">Nama Sekolah/PT</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="universitas"
                        name="universitas"value="{{ old('universitas') }}">
                </div>
                @error('universitas')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="jenjang">Jenjang</label>
                    <select class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" name="jenjang" id="jenjang">
                        <option value="">Pilih salah satu</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>

                    </select>

                </div>

                @error('jenjang')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="prodi">Prodi</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="prodi"
                        name="prodi"value="{{ old('prodi') }}">
                </div>
                @error('prodi')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror
                <div class=" flex items-center">
                    <label class="block w-32" for="tahun_masuk">Tahun masuk</label>
                    <input class=" mt-3 px-2 w-80 border-slate-300 border rounded-md" type="text" id="tahun_masuk"
                        name="tahun_masuk"value="{{ old('tahun_masuk') }}">
                </div>
                @error('tahun_masuk')
                    <span class="text-red-400 text-xs ml-32">{{ $message }} </span>
                @enderror


            </div>

            <div class=" mt-3 w-[500px]">
                <input type="checkbox" name="acc" id="acc"> <label for="acc "
                    class="ml-3 w-96
                @error('acc')
                text-red-400
                @enderror

                ">Saya
                    menyatakan bahwa data
                    yang saya isi adalah data sebenarnya. Saya siap mempertanggungjawabkan bila data tersebut tidak
                    benar.</label>
            </div>
            <button type="submit" class="w-60  bg-primary rounded-md py-1 font-bold text-white mt-3">Kirim</button>



        </div>



        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(function() {
                    $('#provinsi').on('change', function() {
                        let code = $(this).val();

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('cities') }}",
                            data: {
                                code: code
                            },
                            chace: false,
                            success: function(msg) {
                                $('#kabupaten').html(msg);
                            }
                        })
                    });
                    $('#kabupaten').on('change', function() {
                        let code = $(this).val();

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('districts') }}",
                            data: {
                                code: code
                            },
                            chace: false,
                            success: function(msg) {
                                $('#kecamatan').html(msg);
                            }
                        })
                    });
                    $('#kecamatan').on('change', function() {
                        let code = $(this).val();

                        console.log(code);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('villages') }}",
                            data: {
                                code: code
                            },
                            chace: false,
                            success: function(msg) {
                                $('#desa').html(msg);
                            }
                        })
                    });
                })
            })
        </script>

    </form>
@endsection
