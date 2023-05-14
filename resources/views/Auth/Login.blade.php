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
            class="flex flex-col items-center justify-center min-h-screen p-4 space-y-4 antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Brand -->
            <a href="{{ route('home') }}"
                class="inline-block mb-6 text-3xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
                <img src="{{ asset('/img/Logo.png') }}" alt="">
            </a>
            <main>
                <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md dark:bg-darker">
                    <h1 class="text-xl font-semibold text-center">Login</h1>
                    @error('email')
                        <h1 class="text-sm text-red-500 font-semibold text-center">{{ $message }}</h1>
                    @enderror
                    <form action="" method="post" class="space-y-6">
                        @csrf
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="email" name="email" placeholder="Email address" required />
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="password" name="password" placeholder="Password" required />
                        <div class="flex items-center justify-between">
                            <!-- Remember me toggle -->
                            <label class="flex items-center">
                                <div class="relative inline-flex items-center">
                                    <input type="checkbox" name="remembered"
                                        class="w-10 h-4 transition bg-gray-200 border-none rounded-full shadow-inner outline-none appearance-none toggle checked:bg-primary-light disabled:bg-gray-200 focus:outline-none" />
                                    <span
                                        class="absolute top-0 left-0 w-4 h-4 transition-all transform scale-150 bg-white rounded-full shadow-sm"></span>
                                </div>
                                <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">Ingat saya</span>
                            </label>

                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa
                                Password?</a>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                Login
                            </button>
                        </div>
                    </form>

                    <!-- Register link -->
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Apakah belum memiliki akun? <a href="{{ route('registrasi') }}"
                            class="text-blue-600 hover:underline">Registrasi</a>
                    </div>
                </div>
            </main>
        </div>


    </div>
@endsection
