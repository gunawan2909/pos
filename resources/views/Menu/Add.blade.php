@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <div class=" bg-white rounded-md shadow-md p-3">
            <h1 class="text-center tetx-lg font-bold">Menambahkan Menu</h1>
            <div class="h-1 w-full bg-neutral-200 my-3 ">
                <div class="h-1 bg-primary" style="width: 10%"></div>
            </div>
            <div class="flex w-full">
                <form action="" method="post" enctype="multipart/form-data" class="w-full">
                    @csrf
                    <div class=" flex items-center mt-3 w-full">
                        <label for="name" class="block w-36">Nama</label>
                        <input type="text" placeholder="" name="name" id="name"
                            value="{{ old('name') ?? $menu->name }}"
                            class=" rounded-sm w-full block px-2 border border-slate-300 placeholder:text-slate-300">
                    </div>
                    @error('name')
                        <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                    @enderror
                    <div class=" flex items-center mt-3 w-full">
                        <label for="harga" class="block w-36">Harga</label>
                        <input type="text" name="harga" id="harga" value="{{ old('harga') ?? $menu->harga }}"
                            class=" rounded-sm w-full block px-2 border border-slate-300 placeholder:text-slate-300">
                    </div>
                    @error('harga')
                        <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                    @enderror
                    <div class=" flex items-center mt-3 w-full">

                        <label for="keterangan" class="block w-36">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class=" rounded-sm w-full block px-2 border border-slate-300 ">{{ $menu->keterangan }}</textarea>
                    </div>
                    @error('keterangan')
                        <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                    @enderror
                    <div class=" flex items-center mt-3">
                        <label for="foto" class="block w-36">Foto</label>
                        <input type="file" name="foto" id="foto" onchange="previewImage()"
                            class=" rounded-sm w-full block px-2 border border-slate-300 placeholder:text-slate-300">
                    </div>
                    @error('foto')
                        <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                    @enderror


                    <div class="flex mt-4 w-full ">
                        <a class=" text-center text-primary border-primary border-2 py-1 mr-4 rounded-lg px-2 w-full"
                            href="{{ route('menu.delete', ['id' => $menu->id]) }}">Hapus</a>
                        <button class="bg-primary text-white py-1  rounded-lg px-2 w-full" type="submit">Kelola
                            Bahan</button>
                    </div>


                </form>
                <img class="object-cover object-center h-40 w-40 ml-3 rounded-md shadow-md" id="imgPriview"
                    src="{{ asset($menu->foto ? 'storage/' . $menu->foto : '/img\No_image_available.svg.webp') }}"
                    alt="">
            </div>

            <table class="table-auto  text-center w-full mt-4">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah(Satuan)</th>

                    </tr>
                </thead>

                <tbody class="border-b border-slate-500 text-sm">
                    @foreach ($menu->persediaan as $item)
                        <tr>
                        </tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->persediaan->name }}</td>
                        <td>{{ $item->jumlah }}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function previewImage() {
            const img = document.querySelector('#foto');
            const imgPrivew = document.querySelector('#imgPriview');


            const oFReader = new FileReader();
            oFReader.readAsDataURL(img.files[0]);
            oFReader.onload = function(oFREvent) {
                console.log(img, imgPrivew, oFREvent.target.result);
                imgPrivew.src = oFREvent.target.result;
            }

        }
    </script>
@endsection
