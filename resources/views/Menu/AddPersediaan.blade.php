@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <div class=" bg-white rounded-md shadow-md p-3">
            <h1 class="text-center tetx-lg font-bold">Menambahkan Menu</h1>
            <div class="h-1 w-full bg-neutral-200 my-3 ">
                <div class="h-1 bg-primary" style="width: 50%"></div>
            </div>
            <div class="flex w-full">
                <form action="{{ route('menu') }}" method="get" class="w-full">

                    <div class=" flex items-center mt-3 w-full">
                        <label for="name" class="block w-36">Nama</label>
                        <input disabled type="text" placeholder="" name="name" id="name"
                            value="{{ old('name') ?? $menu->name }}"
                            class=" rounded-sm w-full block px-2 border border-slate-300 placeholder:text-slate-300">
                    </div>

                    <div class=" flex items-center mt-3 w-full">
                        <label for="harga" class="block w-36">Harga</label>
                        <input disabled type="text" name="harga" id="harga"
                            value="{{ old('harga') ?? $menu->harga }}"
                            class=" rounded-sm w-full block px-2 border border-slate-300 placeholder:text-slate-300">
                    </div>

                    <div class=" flex items-center mt-3 w-full">

                        <label for="keterangan" class="block w-36">Keterangan</label>
                        <textarea disabled name="keterangan" id="keterangan" class=" rounded-sm w-full block px-2 border border-slate-300 ">{{ $menu->keterangan }}</textarea>
                    </div>
                    <div class="flex mt-4 w-full ">
                        <a class=" text-center text-primary border-primary border-2 py-1 mr-4 rounded-lg px-2 w-full"
                            href="{{ route('menu.add', ['id' => $menu->id]) }}">Kembali</a>
                        <button class="bg-primary text-white py-1  rounded-lg px-2 w-full" type="submit">Simpan</button>
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
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="border-b border-slate-500 text-sm">
                    <form action="{{ route('menu.add.persediaan') }}" method="POST">
                        @csrf
                        <tr>
                            <td>
                                #
                            </td>
                            <td>

                                <select name="persediaan_id" id="">
                                    <option value="">Pilih Salah satu</option>
                                    @foreach ($persediaan as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </td>
                            <td>
                                <input type="text" name="jumlah" class=" px-2" placeholder="Dalam KG/L/Pcs">
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            </td>
                            <td>
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M11 17h2v-4h4v-2h-4V7h-2v4H7v2h4v4Zm1 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </form>

                    @foreach ($menu->persediaan as $item)
                        <tr>
                        </tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->persediaan->name }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            <form action="{{ route('menu.add.persediaan.delete', ['id' => $item->id]) }}" method="post">
                                @csrf
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="m9.4 16.5l2.6-2.6l2.6 2.6l1.4-1.4l-2.6-2.6L16 9.9l-1.4-1.4l-2.6 2.6l-2.6-2.6L8 9.9l2.6 2.6L8 15.1l1.4 1.4ZM5 21V6H4V4h5V3h6v1h5v2h-1v15H5Zm2-2h10V6H7v13ZM7 6v13V6Z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
