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
                class="inline-block  text-3xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
                <img src="{{ asset('/img/Logo.png') }}" alt="">
            </a>
            <main>
                <h1 class="sr-only">Reset password</h1>
                <div class="w-full max-w-sm px-4 py-6 space-y-2 bg-white rounded-md dark:bg-darker">
                    <p class="text-lg font-bold text-center  dark:text-gray-400">
                        Masukan password baru
                    </p>

                    <form action="{{ route('password.reset', ['token' => $token]) }}" method="post" class="space-y-6">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="hidden" name="email" value="{{ request()->email }}" />
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="password" name="password" placeholder="Password" />
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="password" name="password_confirmation" placeholder="Confirm Password" />
                        <div class="flex w-full items-center justify-center">

                            @error('password')
                                <span class="  text-[10px]  text-red-500">{{ $message }}</span>
                            @enderror
                            @error('token')
                                <span class=" text-[10px] text-center  text-red-500">{{ $message }}</span>
                            @enderror
                            @error('email')
                                <span class=" text-[10px] text-center  text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                Reset password
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>

    </div>
@endsection
