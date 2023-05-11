@extends('Layout.Dashboard')
@section('dashboard')
    <div class=" p-2">
        <h1 class="text-2xl font-bold">Persediaan</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-4 mb-10 mt-3">

            <div class=" flex my-3">

                <p class="ml-auto"> Cari</p>
                <form action="">
                    <input type="search" name="search" value="{{ $search ?? '' }}" placeholder="Search... " id=""
                        class="border ml-2 px-2 border-slate-400 rounded-md w-56">
                    <button type="submit"></button>
                </form>
            </div>
            <table class="table-auto text-center">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="border-b border-slate-500 text-sm">

                    @foreach ($pesanan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->time }}</td>
                            <td>{{ $item->status }}</td>
                            <td><a href="{{ route('pesanan.reservasi.pay', ['id' => $item->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M13 5c2.21 0 4 1.79 4 4c0 1.5-.8 2.77-2 3.46v-1.22c.61-.55 1-1.35 1-2.24c0-1.66-1.34-3-3-3s-3 1.34-3 3c0 .89.39 1.69 1 2.24v1.22C9.8 11.77 9 10.5 9 9c0-2.21 1.79-4 4-4m7 15.5c-.03.82-.68 1.47-1.5 1.5H13c-.38 0-.74-.15-1-.43l-4-4.2l.74-.77c.19-.21.46-.32.76-.32h.2L12 18V9c0-.55.45-1 1-1s1 .45 1 1v4.47l1.21.13l3.94 2.19c.53.24.85.77.85 1.35v3.36M20 2H4c-1.1 0-2 .9-2 2v8a2 2 0 0 0 2 2h4v-2H4V4h16v8h-2v2h2v-.04l.04.04c1.09 0 1.96-.91 1.96-2V4a2 2 0 0 0-2-2Z" />
                                    </svg></a></td>

                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection
