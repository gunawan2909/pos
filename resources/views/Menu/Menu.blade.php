<nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">

    <div x-data="{{ $panel[0] == 'datasantri' ? '{isActive: true, open: true}' : '{isActive: false, open: false}' }}">
        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
        <a href="#" @click="$event.preventDefault(); open = !open"
            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
            :aria-expanded="(open || isActive) ? 'true' : 'false'">
            <span aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path fill="currentColor"
                        d="M8 13.5a.5.5 0 0 0-1 0v2a.5.5 0 0 0 1 0v-2ZM10 9a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6A.5.5 0 0 1 10 9Zm3 2.5a.5.5 0 0 0-1 0v4a.5.5 0 0 0 1 0v-4ZM4 4a2 2 0 0 1 2-2h4.586a1.5 1.5 0 0 1 1.06.44l3.915 3.914A1.5 1.5 0 0 1 16 7.414V16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V8h-3.5A1.5 1.5 0 0 1 10 6.5V3H6Zm5.5 4h3.293L11 3.207V6.5a.5.5 0 0 0 .5.5Z" />
                </svg>
            </span>
            <span class="ml-2 text-sm"> Data Santri </span>
            <span class="ml-auto" aria-hidden="true">
                <!-- active class 'rotate-180' -->
                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </a>
        <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
            @if (Auth::user()->remote > 1)
                <a href="{{ route('datadaftarulang') }}" role="menuitem"
                    class="block p-2 text-sm {{ $panel[1] == 'data daftar ulang' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                    Data Santri Daftar Ulang
                </a>
                <a href="{{ route('datasantri') }}" role="menuitem"
                    class="block p-2 text-sm {{ $panel[1] == 'data santri' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                    Data Santri
                </a>
            @endif
            <a href="{{ route('daftarulang') }}" role="menuitem"
                class="block p-2 text-sm {{ $panel[1] == 'daftra ulang' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                Daftar Ulang
            </a>


        </div>
    </div>

    {{-- <div x-data="{{ $panel[0] == 'bendahara' ? '{isActive: true, open: true}' : '{isActive: false, open: false}' }}">
        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
        <a href="#" @click="$event.preventDefault(); open = !open"
            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
            :aria-expanded="(open || isActive) ? 'true' : 'false'">
            <span aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 10h4" />
                        <path stroke-width="1.5"
                            d="M20.833 11h-2.602C16.446 11 15 12.343 15 14s1.447 3 3.23 3h2.603c.084 0 .125 0 .16-.002c.54-.033.97-.432 1.005-.933c.002-.032.002-.071.002-.148v-3.834c0-.077 0-.116-.002-.148c-.036-.501-.465-.9-1.005-.933c-.035-.002-.076-.002-.16-.002Z" />
                        <path stroke-width="1.5"
                            d="M20.965 11c-.078-1.872-.328-3.02-1.137-3.828C18.657 6 16.771 6 13 6h-3C6.229 6 4.343 6 3.172 7.172C2 8.343 2 10.229 2 14c0 3.771 0 5.657 1.172 6.828C4.343 22 6.229 22 10 22h3c3.771 0 5.657 0 6.828-1.172c.809-.808 1.06-1.956 1.137-3.828" />
                        <path stroke-linecap="round" stroke-width="1.5"
                            d="m6 6l3.735-2.477a3.237 3.237 0 0 1 3.53 0L17 6" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.991 14h.01" />
                    </g>
                </svg>
            </span>
            <span class="ml-2 text-sm"> Syahriah</span>
            <span class="ml-auto" aria-hidden="true">
                <!-- active class 'rotate-180' -->
                <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </a>
        <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
            <a href="{{ route('bendahara.tagihan') }}" role="menuitem"
                class="block p-2 text-sm {{ $panel[1] == 'invoice' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                Invoice
            </a>
            @if ((Auth::user()->remote == 2) | Auth::user()->remote)
                <a href="{{ route('bendahara.tagihan.menejer') }}" role="menuitem"
                    class="block p-2 text-sm {{ $panel[1] == 'invoice.menejer' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                    Invoice Manager
                </a>
            @endif




        </div>
    </div> --}}
    @if (Auth::user()->status == 'aktif')
        <div x-data="{{ $panel[0] == 'wifi' ? '{isActive: true, open: true}' : '{isActive: false, open: false}' }}">
            <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
            <a href="#" @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'">
                <span aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 11c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2zm6 2c0-3.31-2.69-6-6-6s-6 2.69-6 6c0 2.22 1.21 4.15 3 5.19l1-1.74c-1.19-.7-2-1.97-2-3.45c0-2.21 1.79-4 4-4s4 1.79 4 4c0 1.48-.81 2.75-2 3.45l1 1.74c1.79-1.04 3-2.97 3-5.19zM12 3C6.48 3 2 7.48 2 13c0 3.7 2.01 6.92 4.99 8.65l1-1.73C5.61 18.53 4 15.96 4 13c0-4.42 3.58-8 8-8s8 3.58 8 8c0 2.96-1.61 5.53-4 6.92l1 1.73c2.99-1.73 5-4.95 5-8.65c0-5.52-4.48-10-10-10z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm"> WiFi</span>
                <span class="ml-auto" aria-hidden="true">
                    <!-- active class 'rotate-180' -->
                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </a>


            <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                <a href="{{ route('user.wifi') }}" role="menuitem"
                    class="block p-2 text-sm {{ $panel[1] == 'wifi' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                    Akun
                </a>




            </div>
        </div>
    @endif

    @if (Auth::user()->remote == 3)
        <div x-data="{{ $panel[0] == 'admin' ? '{isActive: true, open: true}' : '{isActive: false, open: false}' }}">
            <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
            <a href="#" @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'">
                <span aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 26 26">
                        <path fill="currentColor"
                            d="M16.563 15.9c-.159-.052-1.164-.505-.536-2.414h-.009c1.637-1.686 2.888-4.399 2.888-7.07c0-4.107-2.731-6.26-5.905-6.26c-3.176 0-5.892 2.152-5.892 6.26c0 2.682 1.244 5.406 2.891 7.088c.642 1.684-.506 2.309-.746 2.396c-3.324 1.203-7.224 3.394-7.224 5.557v.811c0 2.947 5.714 3.617 11.002 3.617c5.296 0 10.938-.67 10.938-3.617v-.811c0-2.228-3.919-4.402-7.407-5.557zm-5.516 8.709c0-2.549 1.623-5.99 1.623-5.99l-1.123-.881c0-.842 1.453-1.723 1.453-1.723s1.449.895 1.449 1.723l-1.119.881s1.623 3.428 1.623 6.018c0 .406-3.906.312-3.906-.028z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm"> Admin</span>
                <span class="ml-auto" aria-hidden="true">
                    <!-- active class 'rotate-180' -->
                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </a>
            <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                <a href="{{ route('police') }}" role="menuitem"
                    class="block p-2 text-sm {{ $panel[1] == 'police' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                    Police
                </a>
                <a href="{{ route('whatsapp') }}" role="menuitem"
                    class="block p-2 text-sm {{ $panel[1] == 'wa' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                    WhatsApp
                </a>



            </div>
        </div>
    @endif


</nav>
