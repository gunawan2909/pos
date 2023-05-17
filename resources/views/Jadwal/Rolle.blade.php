@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <h1 class=" text-center text-lg font-bold">Pembagaian Jadwal</h1>
        <div flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3>

            <table class="table-auto text-center">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th rowspan="2">Nama</th>
                        <th>Jadwal</th>

                    </tr>
                    <tr>
                        <th>Senin</th>
                        <th>Selasa</th>
                        <th>Rabu</th>
                        <th>Kamis</th>
                        <th>Jum'at</th>
                        <th>Sabtu</th>
                        <th>Minggu</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($jadwal as $item)
                        <tr>
                            <form action="" method="post">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->senin }}</td>
                                <td>{{ $item->selasa }}</td>
                                <td>{{ $item->rabu }}</td>
                                <td>{{ $item->kamis }}</td>
                                <td>{{ $item->jumat }}</td>
                                <td>{{ $item->sabtu }}</td>
                                <td>{{ $item->minggu }}</td>
                                <td><button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M17 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3zM6 6h9v4H6z" />
                                        </svg></button></td>
                            </form>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
