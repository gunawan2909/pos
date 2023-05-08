@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class="font-bold text-2xl my-2 ">Data santri</h1>

    <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
        <h1 class="font-bold text-center text-lg">Tambahkan Data</h1>
        <form action="{{ route('addAdmin') }}" method="POST" class=" flex flex-col border-b-2 pb-2">
            @csrf
            <div class="flex mt-2">
                <label class=" w-32" for="nis">NIS</label>
                <input class=" border border-slate-500 rounded-sm w-60" type="text" name="nis" id="nis"
                    value="{{ old('nis') }}">
            </div>
            @error('nis')
                <span class=" text-xs text-red-400 ml-32">{{ $message }}</span>
            @enderror
            <div class="flex  mt-2">
                <label class=" w-32" for="remote">Remote</label>
                <select class=" border border-slate-500 rounded-sm w-60" name="remote" id="remote">
                    <option value="">Pilihan anda</option>
                    <option value="2">Bendahara</option>
                    <option value="3">Administrator</option>

                </select>
            </div>
            @error('remote')
                <span class=" text-xs text-red-400 ml-32">{{ $message }}</span>
            @enderror
            <button class=" bg-blue-950 text-white py-1 rounded-md font-bold my-3 hover:bg-blue-500"
                type="submit">Tambahkan</button>
        </form>
        <div class=" flex my-3">
            <form class=" flex mr-auto" action="" method="get">
                <p>Tampilan</p>
                <select name="pagination" id="" class=" border-2 ml-2 border-slate-400" v>
                    <option value="10" {{ $page == 10 ? 'selected' : '' }}>10</option>
                    <option value="50" {{ $page == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $page == 100 ? 'selected' : '' }}>100</option>
                    <option value="1000" {{ $page == 1000 ? 'selected' : '' }}>1000</option>
                </select>
                <p class="ml-2"> Data</p>
                <button class=" bg-blue-950 text-white px-3 rounded-md ml-3" type="submit">Terapkan</button>
            </form>
            <p class="ml"> Cari</p>
            <form action="">
                <input type="hidden" name="pagination" value="{{ $page }}">
                <input type="search" name="search" value="{{ $search }}" placeholder="Search... " id=""
                    class="border ml-2 px-2 border-slate-400 rounded-md w-56">
                <button type="submit"></button>
            </form>
        </div>
        <table class="table-auto text-center">
            <thead class="border-b border-slate-500 text-sm">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Remote</th>
                    <th>Action</th>



                </tr>
            </thead>
            <tbody>

                @foreach ($user as $item)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @switch($item->remote)
                                @case(2)
                                    Bendahara
                                @break

                                @case(3)
                                    Administrator
                                @break

                                @default
                            @endswitch

                        </td>
                        <td> <a href="{{ route('removeAdmin', ['nis' => $item->nis]) }}" class=" group bg-blue-950"> <i
                                    class="mx-auto my-2  group-hover:stroke-blue-600" data-feather="trash"></i></a></td>


                    </tr>
                @endforeach




            </tbody>
        </table>
        <div class=" flex w-full pl-3  pt-3 border-t border-blue-950">
            <p>Halaman {{ $user->currentPage() }} Dari {{ $user->lastPage() }} </p>
            <div class="ml-auto flex text-lg font-bold">

                <a
                    @if ($user->previousPageUrl()) class="mr-10 " href="{{ $user->previousPageUrl() }}&pagination={{ $page }}&search={{ $search }}"
                @else class="mr-10 text-slate-300" @endif>
                    < </a>

                        <a
                            @if ($user->nextPageUrl()) class="mr-10 " href="{{ $user->nextPageUrl() }}&pagination={{ $page }}&search={{ $search }}" @else class="mr-10 text-slate-300" @endif>>
                        </a>
            </div>
        </div>
    </div>
@endsection
