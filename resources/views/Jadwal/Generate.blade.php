@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <h1 class="font-bold text-2xl my-2 ">Absen</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
            <h1>Code Absen</h1>
            <h1 class="text-4xl">{{ $absen->code ?? '' }}</h1>
            <h1>Expired pada {{ date('d F Y H:i', strtotime($absen->created_at) + 1800) ?? '' }}
            </h1>
            <form action="" method="post">
                @csrf
                <button class=" bg-primary px-2 py-1 text-white " type="submit">Buat Kode Baru</button>
            </form>
        </div>
    </div>
@endsection
