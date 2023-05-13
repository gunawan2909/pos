<nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">

    <div x-data="{{ $panel[0] == 'persediaan' ? '{isActive: true, open: true}' : '{isActive: false, open: false}' }}">
        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
        <a href="#" @click="$event.preventDefault(); open = !open"
            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
            :aria-expanded="(open || isActive) ? 'true' : 'false'">
            <span aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M11.27 13.5H2.73a2 2 0 0 1-2-2.22l.67-5.89a1 1 0 0 1 1-.89h9.2a1 1 0 0 1 1 .89l.65 5.89a2 2 0 0 1-1.98 2.22Z" />
                        <path d="M3 4.5a4 4 0 0 1 8 0m-6.5 3h5" />
                    </g>
                </svg>
            </span>
            <span class="ml-2 text-sm"> Persediaan </span>
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

            <a href="{{ route('persediaan') }}" role="menuitem"
                class="block p-2 text-sm {{ $panel[1] == 'index' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                Persediaan
            </a>
            <a href="{{ route('persediaan.riwayat') }}" role="menuitem"
                class="block p-2 text-sm {{ $panel[1] == 'riwayat' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                Riwayat
            </a>



        </div>
    </div>
    <div x-data="{{ $panel[0] == 'menu' ? '{isActive: true, open: true}' : '{isActive: false, open: false}' }}">
        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
        <a href="#" @click="$event.preventDefault(); open = !open"
            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
            :aria-expanded="(open || isActive) ? 'true' : 'false'">
            <span aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M14 8.775q0-.225.163-.463T14.524 8q.725-.25 1.45-.375T17.5 7.5q.5 0 .988.063t.962.162q.225.05.388.25t.162.45q0 .425-.275.625t-.7.1q-.35-.075-.737-.113T17.5 9q-.65 0-1.275.125t-1.2.325q-.45.175-.737-.025T14 8.775Zm0 5.5q0-.225.163-.463t.362-.312q.725-.25 1.45-.375T17.5 13q.5 0 .988.063t.962.162q.225.05.388.25t.162.45q0 .425-.275.625t-.7.1q-.35-.075-.737-.113T17.5 14.5q-.65 0-1.275.113t-1.2.312q-.45.175-.738-.013T14 14.276Zm0-2.75q0-.225.163-.463t.362-.312q.725-.25 1.45-.375t1.525-.125q.5 0 .988.063t.962.162q.225.05.388.25t.162.45q0 .425-.275.625t-.7.1q-.35-.075-.737-.113t-.788-.037q-.65 0-1.275.125t-1.2.325q-.45.175-.737-.025t-.288-.65ZM6.5 16q1.175 0 2.288.263T11 17.05V7.2q-1.025-.6-2.175-.9T6.5 6q-.9 0-1.788.175T3 6.7v9.9q.875-.3 1.738-.45T6.5 16Zm6.5 1.05q1.1-.525 2.212-.788T17.5 16q.9 0 1.763.15T21 16.6V6.7q-.825-.35-1.713-.525T17.5 6q-1.175 0-2.325.3T13 7.2v9.85Zm-6-5.4Zm5 7.825q-.35 0-.663-.088t-.587-.237q-.975-.575-2.05-.862T6.5 18q-1.05 0-2.063.275T2.5 19.05q-.525.275-1.012-.025T1 18.15V6.1q0-.275.138-.525T1.55 5.2q1.15-.6 2.4-.9T6.5 4q1.45 0 2.838.375T12 5.5q1.275-.75 2.663-1.125T17.5 4q1.3 0 2.55.3t2.4.9q.275.125.413.375T23 6.1v12.05q0 .575-.487.875t-1.013.025q-.925-.5-1.937-.775T17.5 18q-1.125 0-2.2.288t-2.05.862q-.275.15-.588.238t-.662.087Z" />
                </svg>
            </span>
            <span class="ml-2 text-sm"> Menu </span>
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

            <a href="{{ route('menu') }}" role="menuitem"
                class="block p-2 text-sm {{ $panel[1] == 'index' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                Menu
            </a>




        </div>
    </div>
    <div x-data="{{ $panel[0] == 'pesanan' ? '{isActive: true, open: true}' : '{isActive: false, open: false}' }}">
        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
        <a href="#" @click="$event.preventDefault(); open = !open"
            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
            :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
            :aria-expanded="(open || isActive) ? 'true' : 'false'">
            <span aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M4 9q-.425 0-.713-.288T3 8V6q0-.425.288-.713T4 5h2q.425 0 .713.288T7 6v2q0 .425-.288.713T6 9H4Zm5 0q-.425 0-.713-.288T8 8V6q0-.425.288-.713T9 5h11q.425 0 .713.288T21 6v2q0 .425-.288.713T20 9H9Zm0 5q-.425 0-.713-.288T8 13v-2q0-.425.288-.713T9 10h11q.425 0 .713.288T21 11v2q0 .425-.288.713T20 14H9Zm-5 0q-.425 0-.713-.288T3 13v-2q0-.425.288-.713T4 10h2q.425 0 .713.288T7 11v2q0 .425-.288.713T6 14H4Zm5 5q-.425 0-.713-.288T8 18v-2q0-.425.288-.713T9 15h11q.425 0 .713.288T21 16v2q0 .425-.288.713T20 19H9Zm-5 0q-.425 0-.713-.288T3 18v-2q0-.425.288-.713T4 15h2q.425 0 .713.288T7 16v2q0 .425-.288.713T6 19H4Z" />
                </svg>
            </span>
            <span class="ml-2 text-sm"> Pesanan </span>
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

            <a href="{{ route('pesanan.reservasi.index') }}" role="menuitem"
                class="block p-2 text-sm {{ $panel[1] == 'reservasi' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                Reservasi
            </a>

            <a href="{{ route('pesanan.pesanan.index') }}" role="menuitem"
                class="block p-2 text-sm {{ $panel[1] == 'no_reservasi' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                Langsung
            </a>
            <a href="{{ route('pesanan.monitoring') }}" role="menuitem"
                class="block p-2 text-sm {{ $panel[1] == 'monitoring' ? 'text-gray-700' : 'text-gray-400' }} transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                Monitoring
            </a>





        </div>
    </div>




</nav>
