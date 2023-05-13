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
                    <div class=" flex items-center mt-3">
                        <label for="status" class="block w-32">Status</label>
                        <input
                            class=" mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                            type="checkbox" role="switch" id="status" name="status"
                            {{ $menu->status == true ? 'checked' : '' }} />
                    </div>


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
