@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <h1 class="font-bold text-2xl my-2 ">User Edit</h1>
        <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">
            <form action="" method="post" class="flex flex-col" enctype="multipart/form-data">
                @csrf
                <img class=" self-center mt-2 object-cover object-center h-40 w-40 ml-3 rounded-md shadow-md" id="imgPriview"
                    src="{{ asset($user->foto ? $user->foto : '/img\No_image_available.svg.webp') }}" alt="">
                <div class=" flex items-center mt-3">

                    <input type="file" name="foto" id="foto" onchange="previewImage()"
                        class=" rounded-sm w-full block px-2 border border-slate-300 placeholder:text-slate-300">
                </div>
                @error('foto')
                    <span class=" ml-36 text-[10px] text-red-500">{{ $message }}</span>
                @enderror
                <div class="flex mt-4 items-center justify-center">
                    <a class=" text-center bg-primary text-white py-1 mr-4 rounded-lg px-2 w-40"
                        href="{{ route('dashboard') }}">Kembali</a>
                    <button class="bg-primary text-white py-1  rounded-lg px-2 w-40" type="submit">Update</button>
                </div>
            </form>

        </div>
    </div>
    <script>
        function previewImage() {
            const img = document.querySelector('#foto');
            const imgPrivew = document.querySelector('#imgPriview');


            const oFReader = new FileReader();
            oFReader.readAsDataURL(img.files[0]);
            oFReader.onload = function(oFREvent) {
                console.log(img, imgPrivew, oFREvent.target.result);
                imgPrivew.src = oFREvent.target.result;
            }

        }
    </script>
@endsection
