@extends('Layout.Dashboard')
@section('dashboard')
    <h1 class="font-bold text-2xl my-2 ">Data Santri</h1>

    <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">

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
                <button class=" bg-primary text-white px-3 rounded-md ml-3" type="submit">Terapkan</button>
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
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Status</th>


                </tr>
            </thead>
            <tbody>

                @foreach ($user as $item)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ strtoupper($item->name) }}</td>
                        <td>
                            <div class=" bg-green-600 rounded-md w-fit mx-auto px-3">
                                {{ ucwords($item->status) }}</div>
                        </td>


                    </tr>
                @endforeach




            </tbody>
        </table>
        <div class=" flex w-full pl-3  pt-3 border-t border-primary">
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
