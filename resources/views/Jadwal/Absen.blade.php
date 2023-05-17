@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <h1 class="font-bold text-2xl my-2 ">Absen</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
            <form action="" method="post">
                @csrf
                <input
                    class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                    type="text" name="code" placeholder="Code Absen" />
                @error('code')
                    <span class=" text-[10px] text-red-500">{{ $message }}</span>
                @enderror
                <button class=" bg-primary px-2 py-1 text-white " type="submit">Absen</button>
            </form>
        </div>
    </div>
@endsection
