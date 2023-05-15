@extends('Layout.Dashboard')
@section('dashboard')
    <div class="p-2">
        <h1 class="font-bold text-2xl my-2 ">Anggota Karyawan</h1>

        <div class="flex flex-col w-full bg-white shadow-md px-3 py-1 mb-10 mt-3">

            <div class=" flex my-3">
                <form class=" flex mr-auto" action="" method="get">
                    <p>Tampilan</p>
                    <input type="hidden" name="search" value="{{ $search }}">
                    <select name="pagination" id="" class=" border-2 ml-2 border-slate-400" v>
                        <option value="10" {{ $page == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ $page == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $page == 100 ? 'selected' : '' }}>100</option>
                        <option value="1000" {{ $page == 1000 ? 'selected' : '' }}>1000</option>
                    </select>
                    <p class="ml-2"> Data</p>
                    <button class=" bg-primary text-white px-3 rounded-md ml-3" type="submit">Terapkan</button>
                </form>
                <p class="ml"> Cari</p>
                <form action="">
                    <input type="hidden" name="pagination" value="{{ $page }}">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Search... " id=""
                        class="border ml-2 px-2 border-slate-400 rounded-md w-56">
                    <button type="submit"></button>
                </form>
            </div>

            <table class="table-auto text-center">
                <thead class="border-b border-slate-500 text-sm">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($user as $item)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->jabatan->name ?? '' }}</td>
                            <td><a href="{{ route('user.edit', ['id' => $item->id]) }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20">
                                        <path fill="currentColor"
                                            d="M11.078 0c.294 0 .557.183.656.457l.706 1.957c.253.063.47.126.654.192c.201.072.46.181.78.33l1.644-.87a.702.702 0 0 1 .832.131l1.446 1.495c.192.199.246.49.138.744l-.771 1.807c.128.235.23.436.308.604c.084.183.188.435.312.76l1.797.77c.27.115.437.385.419.674l-.132 2.075a.69.69 0 0 1-.46.605l-1.702.605c-.049.235-.1.436-.154.606a8.79 8.79 0 0 1-.298.774l.855 1.89a.683.683 0 0 1-.168.793l-1.626 1.452a.703.703 0 0 1-.796.096l-1.676-.888a7.23 7.23 0 0 1-.81.367l-.732.274l-.65 1.8a.696.696 0 0 1-.64.457L9.11 20a.697.697 0 0 1-.669-.447l-.766-2.027a14.625 14.625 0 0 1-.776-.29a9.987 9.987 0 0 1-.618-.293l-1.9.812a.702.702 0 0 1-.755-.133L2.22 16.303a.683.683 0 0 1-.155-.783l.817-1.78a9.517 9.517 0 0 1-.302-.644a14.395 14.395 0 0 1-.3-.811L.49 11.74a.69.69 0 0 1-.49-.683l.07-1.921a.688.688 0 0 1 .392-.594L2.34 7.64c.087-.319.163-.567.23-.748a8.99 8.99 0 0 1 .314-.712L2.07 4.46a.683.683 0 0 1 .15-.79l1.404-1.326a.702.702 0 0 1 .75-.138l1.898.784c.21-.14.4-.253.572-.344c.205-.109.479-.223.824-.346l.66-1.841A.696.696 0 0 1 8.984 0h2.094Zm-.49 1.377H9.475L8.87 3.071a.693.693 0 0 1-.434.423c-.436.145-.751.27-.935.367c-.195.103-.444.26-.74.47a.703.703 0 0 1-.673.074l-1.83-.755l-.713.674l.743 1.57a.68.68 0 0 1-.006.597c-.2.401-.335.697-.403.879a10.31 10.31 0 0 0-.27.922a.69.69 0 0 1-.37.45l-1.79.859l-.036.98l1.62.492c.215.065.385.23.456.442c.16.48.288.834.38 1.056a10 10 0 0 0 .404.827a.68.68 0 0 1 .019.606l-.751 1.638l.711.668l1.782-.762a.703.703 0 0 1 .603.024c.365.192.637.325.809.398c.175.073.51.195.996.361a.693.693 0 0 1 .424.41l.708 1.871l.926-.02l.597-1.654a.692.692 0 0 1 .409-.413l1.037-.388c.262-.097.58-.25.951-.46a.703.703 0 0 1 .674-.008l1.577.835l.887-.791L15.856 14a.681.681 0 0 1-.001-.56c.182-.407.305-.714.367-.91c.061-.192.124-.469.185-.825a.69.69 0 0 1 .451-.533l1.648-.585l.072-1.14l-1.62-.694a.692.692 0 0 1-.377-.394a15.337 15.337 0 0 0-.378-.944a11.01 11.01 0 0 0-.42-.794a.682.682 0 0 1-.035-.606l.725-1.7l-.764-.79l-1.488.788a.703.703 0 0 1-.633.013a11.296 11.296 0 0 0-.968-.426a7.185 7.185 0 0 0-.857-.23a.694.694 0 0 1-.508-.441l-.668-1.853Zm-.564 4.264c2.435 0 4.41 1.953 4.41 4.361c0 2.408-1.975 4.36-4.41 4.36c-2.436 0-4.41-1.952-4.41-4.36c0-2.408 1.974-4.36 4.41-4.36Zm0 1.378c-1.667 0-3.018 1.335-3.018 2.983c0 1.648 1.351 2.984 3.018 2.984c1.666 0 3.017-1.336 3.017-2.984s-1.35-2.983-3.017-2.983Z" />
                                    </svg></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class=" flex w-full pl-3  pt-3 border-t border-blue-950">
                <p>Halaman {{ $user->currentPage() }} Dari {{ $user->lastPage() }} </p>
                <div class="ml-auto flex text-lg font-bold">

                    <a
                        @if ($user->previousPageUrl()) class="mr-10 " href="{{ $user->previousPageUrl() }}&pagination={{ $page }}&search={{ $search }}"
                    @else class="mr-10 text-slate-300" @endif>
                        < </a>

                            <a
                                @if ($user->nextPageUrl()) class="mr-10 " href="{{ $user->nextPageUrl() }}&pagination={{ $page }}&search={{ $search }}" @else class="mr-10 text-slate-300" @endif>>
                            </a>
                </div>
            </div>
        </div>
    </div>
@endsection
