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
                    <h1 class="text-lg  text-center">Silahkan menuju Ke kasir Untuk menyelaesaiakn Pembayaran</h1>
                    <a href="{{ $urlback }}"
                        class="text-lg flex justify-center bg-primary text-white rounded-md text-center">Kembali</a>



                </div>
            </main>
        </div>

    </div>
@endsection
