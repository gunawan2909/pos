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
            <a href="../index.html"
                class="inline-block mb-6 text-3xl font-bold tracking-wider uppercase text-primary-dark dark:text-light">
                <img src="{{ asset('/img/Logo.png') }}" alt="">
            </a>
            <main>
                <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md dark:bg-darker">
                    <h1 class="text-xl font-semibold text-center">Register</h1>
                    <form action="" method="post" class="space-y-6">
                        @csrf
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="email" name="email" placeholder="Email address" />

                        @error('email')
                            <span class=" text-[10px] text-red-500">{{ $message }}</span>
                        @enderror
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="text" name="name" placeholder="Full Name" />
                        @error('name')
                            <span class=" text-[10px] text-red-500">{{ $message }}</span>
                        @enderror
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="password" name="password" placeholder="Password" />
                        @error('password')
                            <span class=" text-[10px] text-red-500">{{ $message }}</span>
                        @enderror
                        <input
                            class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                            type="password" name="password_confirmation" placeholder="Confirm Password" />
                        <div>
                            <button type="submit"
                                class="w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker">
                                Register
                            </button>
                        </div>
                    </form>


                    <!-- Login link -->
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Already have an account? <a href="{{ route('login') }}"
                            class="text-blue-600 hover:underline">Login</a>
                    </div>
                </div>
            </main>
        </div>

    </div>
@endsection
