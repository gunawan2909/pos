@extends('Layout.App')
@section('content')
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);">
        <!-- Loading screen -->
        <div x-ref="loading"
            class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker">
            Loading.....
        </div>
        <div
            class="flex flex-col items-center justify-center min-h-screen  antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Brand -->
            <a href="{{ route('home') }}"
                class="inline-block mb-2 text-3xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
                <img src="{{ asset('/img/Logo.png') }}" alt="">
            </a>
            <main>
                <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md dark:bg-darker">
                    <h1 class="text-xl font-semibold text-center">Reservasi</h1>
                    <form action="" method="post" class="space-y-6">
                        @csrf
                        <div class=" flex">

                            <div class="flex flex-col w-full border-x-4 border-b rounded-xl p-2 border-primary">
                                <div class=" flex">
                                    <p class=" w-32">Atas Nama</p>
                                    <p>: {{ $pesanan->name }}</p>
                                </div>
                                <div class=" flex">
                                    <p class=" w-32">Tanggal</p>
                                    <p>: {{ $pesanan->date }}</p>
                                </div>
                                <div class=" flex">
                                    <p class=" w-32">Waktu</p>
                                    <p>: {{ $pesanan->time }}</p>
                                </div>




                            </div>

                        </div>
                        <label class=" text-center justify-center flex" for="jumlah">Jumlah yang tersedia
                            {{ $kuota }}
                            orang</label>
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="number" name="jumlah" placeholder="Jumlah orang" id="jumlah" />
                        @error('jumlah')
                            <span class=" text-[10px] text-red-500">{{ $message }}</span>
                        @enderror

                        <button type="submit"
                            class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                            Reservasi
                        </button>
                </div>
                </form>



        </div>
        </main>
    </div>

    </div>
@endsection
