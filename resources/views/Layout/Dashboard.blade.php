@extends('Layout.App')
@section('content')
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dar': isDark }">
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker">
                Loading.....
            </div>

            <!-- Sidebar -->
            <aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
                <div class="flex flex-col h-full">
                    <!-- Sidebar links -->
                    @include('Side.Menu')

                    <!-- Sidebar footer -->
                    <div class="flex-shrink-0 px-2 py-4 space-y-2">
                        <button @click="openSettingsPanel" type="button"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                            <span aria-hidden="true">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </span>
                            <span>Customize</span>
                        </button>
                    </div>
                </div>
            </aside>

            <div class="flex-1 h-full overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                @include('Navbar.Navbar')

                <!-- Main content -->
                <main>
                    <div class="px-4 ">
                        @yield('dashboard')
                    </div>

                </main>

                <!-- Main footer -->
                <footer class="flex items-center justify-center p-4 mt-20">
                    <p>Tim 30 Caption Teknik Komputer Universitas Diponegoro &copy; 2023</p>
                </footer>
            </div>

            <!-- Panels -->

            <!-- Settings Panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="isSettingsPanelOpen"
                @click="isSettingsPanelOpen = false" class="fixed inset-0 z-10 bg-primary-darker" style="opacity: 0.5"
                aria-hidden="true"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" x-ref="settingsPanel"
                tabindex="-1" x-show="isSettingsPanelOpen" @keydown.escape="isSettingsPanelOpen = false"
                class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
                aria-labelledby="settinsPanelLabel">
                <div class="absolute left-0 p-2 transform -translate-x-full">
                    <!-- Close button -->
                    <button @click="isSettingsPanelOpen = false"
                        class="p-2 text-white rounded-md focus:outline-none focus:ring">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Panel content -->
                <div class="flex flex-col h-screen">
                    <!-- Panel header -->
                    <div
                        class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b dark:border-primary-dark">
                        <span aria-hidden="true" class="text-gray-500 dark:text-primary">
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>
                        <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">Settings
                        </h2>
                    </div>
                    <!-- Content -->
                    <div class="flex-1 overflow-hidden hover:overflow-y-auto">
                        <!-- Theme -->


                        <!-- Colors -->
                        <div class="p-4 space-y-4 md:p-8">
                            <h6 class="text-lg font-medium text-gray-400 dark:text-light">Colors</h6>
                            <div>
                                <button @click="setColors('cyan')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-cyan)"></button>
                                <button @click="setColors('teal')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-teal)"></button>
                                <button @click="setColors('green')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-green)"></button>
                                <button @click="setColors('fuchsia')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-fuchsia)"></button>
                                <button @click="setColors('blue')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-blue)"></button>
                                <button @click="setColors('violet')" class="w-10 h-10 rounded-full"
                                    style="background-color: var(--color-violet)"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Notification panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                x-show="isNotificationsPanelOpen" @click="isNotificationsPanelOpen = false"
                class="fixed inset-0 z-10 bg-primary-darker" style="opacity: 0.5" aria-hidden="true"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-ref="notificationsPanel" x-show="isNotificationsPanelOpen"
                @keydown.escape="isNotificationsPanelOpen = false" tabindex="-1"
                aria-labelledby="notificationPanelLabel"
                class="fixed inset-y-0 z-20 w-full max-w-xs bg-white dark:bg-darker dark:text-light sm:max-w-md focus:outline-none">
                <div class="absolute right-0 p-2 transform translate-x-full">
                    <!-- Close button -->
                    <button @click="isNotificationsPanelOpen = false"
                        class="p-2 text-white rounded-md focus:outline-none focus:ring">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-col h-screen" x-data="{ activeTabe: 'action' }">
                    <!-- Panel header -->
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-between px-4 pt-4 border-b dark:border-primary-darker">
                            <h2 id="notificationPanelLabel" class="pb-4 font-semibold">Notifications</h2>
                            <div class="space-x-2">
                                <button @click.prevent="activeTabe = 'action'"
                                    class="px-px pb-4 transition-all duration-200 transform translate-y-px border-b focus:outline-none"
                                    :class="{
                                        'border-primary-dark dark:border-primary': activeTabe ==
                                            'action',
                                        'border-transparent': activeTabe != 'action'
                                    }">
                                    Action
                                </button>
                                <button @click.prevent="activeTabe = 'user'"
                                    class="px-px pb-4 transition-all duration-200 transform translate-y-px border-b focus:outline-none"
                                    :class="{
                                        'border-primary-dark dark:border-primary': activeTabe ==
                                            'user',
                                        'border-transparent': activeTabe != 'user'
                                    }">
                                    User
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Panel content (tabs) -->
                    <div class="flex-1 pt-4 overflow-y-hidden hover:overflow-y-auto">
                        <!-- Action tab -->
                        {{-- <div class="space-y-4" x-show.transition.in="activeTabe == 'action'">
                            <a href="#" class="block">
                                <div class="flex px-4 space-x-4">
                                    <div class="relative flex-shrink-0">
                                        <span
                                            class="z-10 inline-block p-2 overflow-visible rounded-full bg-primary-50 text-primary-light dark:bg-primary-darker">
                                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                            </svg>
                                        </span>
                                        <div
                                            class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker">
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h5 class="text-sm font-semibold text-gray-600 dark:text-light">
                                            New project "KWD Dashboard" created
                                        </h5>
                                        <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                                            Looks like there might be a new theme soon
                                        </p>
                                        <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> 9h
                                            ago </span>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block">
                                <div class="flex px-4 space-x-4">
                                    <div class="relative flex-shrink-0">
                                        <span
                                            class="inline-block p-2 overflow-visible rounded-full bg-primary-50 text-primary-light dark:bg-primary-darker">
                                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                            </svg>
                                        </span>
                                        <div
                                            class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker">
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h5 class="text-sm font-semibold text-gray-600 dark:text-light">
                                            KWD Dashboard v0.0.2 was released
                                        </h5>
                                        <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                                            Successful new version was released
                                        </p>
                                        <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> 2d
                                            ago </span>
                                    </div>
                                </div>
                            </a>
                            <template x-for="i in 20" x-key="i">
                                <a href="#" class="block">
                                    <div class="flex px-4 space-x-4">
                                        <div class="relative flex-shrink-0">
                                            <span
                                                class="inline-block p-2 overflow-visible rounded-full bg-primary-50 text-primary-light dark:bg-primary-darker">
                                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                            </span>
                                            <div
                                                class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker">
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="text-sm font-semibold text-gray-600 dark:text-light">
                                                New project "KWD Dashboard" created
                                            </h5>
                                            <p
                                                class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                                                Looks like there might be a new theme soon
                                            </p>
                                            <span class="text-sm font-normal text-gray-400 dark:text-primary-light">
                                                9h ago </span>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div> --}}

                        <!-- User tab -->
                        {{-- <div class="space-y-4" x-show.transition.in="activeTabe == 'user'">
                            <a href="#" class="block">
                                <div class="flex px-4 space-x-4">
                                    <div class="relative flex-shrink-0">
                                        <span class="relative z-10 inline-block overflow-visible rounded-ful">
                                            <img class="object-cover rounded-full w-9 h-9" src="build/images/avatar.jpg"
                                                alt="Ahmed kamel" />
                                        </span>
                                        <div
                                            class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker">
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h5 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed Kamel
                                        </h5>
                                        <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                                            Shared new project "K-WD Dashboard"
                                        </p>
                                        <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> 1d
                                            ago </span>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block">
                                <div class="flex px-4 space-x-4">
                                    <div class="relative flex-shrink-0">
                                        <span class="relative z-10 inline-block overflow-visible rounded-ful">
                                            <img class="object-cover rounded-full w-9 h-9" src="build/images/avatar-1.jpg"
                                                alt="Ahmed kamel" />
                                        </span>
                                        <div
                                            class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker">
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h5 class="text-sm font-semibold text-gray-600 dark:text-light">John</h5>
                                        <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                                            Commit new changes to K-WD Dashboard project.
                                        </p>
                                        <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> 10h
                                            ago </span>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block">
                                <div class="flex px-4 space-x-4">
                                    <div class="relative flex-shrink-0">
                                        <span class="relative z-10 inline-block overflow-visible rounded-ful">
                                            <img class="object-cover rounded-full w-9 h-9" src="build/images/avatar.jpg"
                                                alt="Ahmed kamel" />
                                        </span>
                                        <div
                                            class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker">
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h5 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed Kamel
                                        </h5>
                                        <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                                            Release new version "K-WD Dashboard"
                                        </p>
                                        <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> 20d
                                            ago </span>
                                    </div>
                                </div>
                            </a>
                            <template x-for="i in 10" x-key="i">
                                <a href="#" class="block">
                                    <div class="flex px-4 space-x-4">
                                        <div class="relative flex-shrink-0">
                                            <span class="relative z-10 inline-block overflow-visible rounded-ful">
                                                <img class="object-cover rounded-full w-9 h-9"
                                                    src="build/images/avatar.jpg" alt="Ahmed kamel" />
                                            </span>
                                            <div
                                                class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker">
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed
                                                Kamel</h5>
                                            <p
                                                class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                                                Release new version "K-WD Dashboard"
                                            </p>
                                            <span class="text-sm font-normal text-gray-400 dark:text-primary-light">
                                                20d ago </span>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div> --}}
                    </div>
                </div>
            </section>


        </div>
    </div>
@endsection
