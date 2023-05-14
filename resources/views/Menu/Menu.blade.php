@extends('Layout.Dashboard')
@section('dashboard')
    <div class=" p-2">
        <h1 class="text-2xl font-bold my-2">Menu</h1>
        <form class="w-full" action="{{ route('menu.cretae') }}" method="post">
            @csrf
            <button class="bg-primary w-full rounded-md px-3 py-1 w-30 text-lg text-white flex justify-center"
                type="submit">Tambah
                Menu</button>
        </form>

        <div class=" grid grid-cols-3 mt-3">
            @foreach ($menu as $item)
                <div class=" rounded-lg shadow-lg bg-white pb-1 w-60">
                    <img class=" object-cover rounded-t-lg " src="{{ asset('storage/' . $item->foto) }}" alt="">
                    <div class=" px-2 pb-3  flex flex-col ">
                        <p class="">{{ $item->name }}</p>
                        <p class=" truncate  text-[12px]">{{ $item->keterangan }}</p>
                        <p class=" font-bold mt-3">Rp. {{ number_format($item->harga, 2, ',', '.') }}</p>
                        <a href="{{ route('menu.add', ['id' => $item->id]) }}"
                            class=" mt-1 bg-primary rounded-md px-3 py-1 w-30 text-lg text-white">Edit
                            Menu</a>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
