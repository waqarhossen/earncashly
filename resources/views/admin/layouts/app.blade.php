<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

    <title>Admin</title>
    <link rel="icon" type="image/png" href="{{ $site_details->fav_icon }}" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Javascript Assets -->
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/additional.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        tbody {
            color: azure;
        }
    </style>
</head>

<body x-data class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->
    <div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900">

        <div
            class="spinner h-16 w-16 animate-spin rounded-full border-4 border-error border-r-transparent dark:border-accent dark:border-r-transparent">
        </div>

    </div>

    <!-- Page Wrapper -->
    <div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak>

        <!-- Sidebar -->
        <div class="sidebar print:hidden">
            <!-- Main Sidebar -->

            <!-- Sidebar Panel -->
            <div class="sidebar-panel">
                <div class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750">
                    <!-- Sidebar Panel Header -->
                    <div class="nav-cut">
                        <div></div>
                        <button @click="$store.global.isSidebarExpanded = false"
                            class="btn h-7 w-7 rounded-full p-0 text-white hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                    </div>
                    <style>
                        .pl-\[var\(--main-sidebar-width\)\] {
                            padding-left: 0rem !important;
                        }

                        :root {
                            --main-sidebar-width: 0rem !important;
                            --sidebar-panel-width: 290px;
                        }
                    </style>
                    <!-- Sidebar Panel Body -->
                    <div class="flex h-full w-full transform-gpu flex-col bg-slate-150 transition-transform duration-200 dark:bg-navy-700"
                        x-transition:enter="ease-out" x-transition:enter-start="-translate-x-full"
                        x-transition:enter-end="translate-x-0" x-transition:leave="ease-in"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        style="">
                        <div class="h-10">

                        </div>
                        <div class="flex space-x-5 px-5">
                            <div class="avatar -mt-5 h-20 w-20">
                                <img class="rounded-full border-2 border-white dark:border-navy-700"
                                    src="{{ $admin_data->profile }}" alt="avatar">

                            </div>
                            <div class="mt-2 w-full" style="margin-left:10px;">
                                <div class="flex justify-between space-x-3">
                                    <h4 class="text-base font-medium text-slate-700 dark:text-navy-50">
                                        {{ mb_strimwidth($admin_data->name, 0, 20, '..') }}
                                    </h4>
                                    {{-- add --}}
                                </div>

                                <a class="cursor-pointer text-xs+ text-white">
                                    {{ mb_strimwidth($admin_data->email, 0, 23, '..') }}</a>

                                <a
                                    class="tag mt-1 bg-error/10 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                    Administration</a>
                            </div>
                        </div>
                        <div style="margin-top: 8px;" class="my-4 mx-5 h-px bg-slate-200 dark:bg-navy-500"></div>

                        <ul class="flex flex-1 flex-col px-4 font-medium">
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-2 group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                    <i class="fa-solid fa-gauge"></i> Statistics
                                </a>
                            </li>

                            <li x-data="accordionItem('menu-item-1')">
                                <a :class="expanded & amp; & amp;
                                'text-slate-800 font-semibold dark:text-navy-50'"
                                    @click="expanded = !expanded"
                                    class="flex items-center justify-between group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    href="javascript:void(0);">
                                    <div>
                                        <i class="fa-solid fa-users" style="margin-right:3px;"></i>
                                        <span>Users</span>
                                    </div>
                                    <svg :class="expanded && 'rotate-90'" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-slate-400 transition-transform ease-in-out" fill="none"
                                        viewbox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <ul x-collapse x-show="expanded">
                                    <li>
                                        <a href="{{ route('admin.users') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>List</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.tracker_glob') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>Tracker</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('admin.offerwalls') }}"
                                    class="flex items-center gap-2 group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                    <i class="fa-solid fa-sack-dollar"></i> OfferWalls
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.missions') }}"
                                    class="flex items-center gap-2 group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                    <i class="fa-solid fa-boxes-stacked"></i> Missions
                                </a>
                            </li>

                            <li x-data="accordionItem('menu-item-4')">
                                <a :class="expanded & amp; & amp;
                                'text-slate-800 font-semibold dark:text-navy-50'"
                                    @click="expanded = !expanded"
                                    class="flex items-center justify-between group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    href="javascript:void(0);">
                                    <div>
                                        <i class="fa-solid fa-dollar-sign" style="margin-right:3px;"></i>
                                        <span>Withdrawals</span>
                                    </div>
                                    <svg :class="expanded && 'rotate-90'" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-slate-400 transition-transform ease-in-out" fill="none"
                                        viewbox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <ul x-collapse x-show="expanded">
                                    <li>
                                        <a href="{{ route('admin.with_reqs') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>Withdrawal Requests</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.withdrawals') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>Add Withdrawal</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            @if (isAddonActive('offer_report'))
                            <li x-data="accordionItem('menu-item-8')">
                                <a :class="expanded & amp; & amp;
                                'text-slate-800 font-semibold dark:text-navy-50'"
                                    @click="expanded = !expanded"
                                    class="flex items-center justify-between group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    href="javascript:void(0);">
                                    <div>
                                        <i class="fa-solid fa-receipt" style="margin-right:3px;"></i>
                                        <span>Statistics Report</span>
                                    </div>
                                    <svg :class="expanded && 'rotate-90'" xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-slate-400 transition-transform ease-in-out" fill="none"
                                        viewbox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <ul x-collapse x-show="expanded">
                                    <li>
                                        <a href="{{ route('admin.csm.all_offers') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>All</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.csm.completed_offers') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>Completed</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            <li x-data="accordionItem('menu-item-3')">
                                <a :class="expanded & amp; & amp;
                                'text-slate-800 font-semibold dark:text-navy-50'"
                                    @click="expanded = !expanded"
                                    class="flex items-center justify-between group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 py-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                    href="javascript:void(0);">
                                    <div>
                                        <i class="fa-solid fa-gear" style="margin-right:3px;"></i>
                                        <span>Settings</span>
                                    </div>
                                    <svg :class="expanded & amp; & amp;
                                    'rotate-90'"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 text-slate-400 transition-transform ease-in-out" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <ul x-collapse="" x-show="expanded"
                                    style="display: none; height: 0px; overflow: hidden;" hidden="">
                                    <li>
                                        <a href="{{ route('admin.settings') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>Admin Settings</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.pages') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>Pages</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.addons.index') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>Addons</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.postbacks') }}"
                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide text-slate-500 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                            <div class="flex items-center space-x-2">
                                                <div class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                </div>
                                                <span>Postbacks</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>

                        <div class="p-5">

                            <a href="{{ route('admin.cache.clear') }}"
                                    class="btn w-full space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90"
                                    onclick="return confirmAction(event);" >
                                    <i class="fa-solid fa-broom"></i>
                                    <span>Clear Cache</span>
                        </a>

                            <form method="POST" action="{{ route('admin.logout') }}" x-data>
                                @csrf
                                <button type="submit"
                                    class="btn mt-2 w-full space-x-2 bg-error/10 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="" @click="$store.global.isSidebarExpanded = false"
                :class="$store.global.isSidebarExpanded && 's-off'">
            </div>
        </div>

        <!-- App Header Wrapper-->
        <nav class="header print:hidden">
            <!-- App Header  -->
            <div class="header-container relative flex w-full bg-white dark:bg-navy-750 print:hidden">
                <!-- Header Items -->
                <div class="flex w-full items-center justify-between">
                    <!-- Left: Sidebar Toggle Button -->
                    <div class="navp">
                        <div class="h-7 w-7" id="menu_bar">
                            <button
                                class="menu-toggle ml-0.5 flex h-7 w-7 flex-col justify-center space-y-1.5 text-white outline-none focus:outline-none dark:text-accent-light/80"
                                :class="$store.global.isSidebarExpanded && 'active'"
                                @click="$store.global.isSidebarExpanded = !$store.global.isSidebarExpanded">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                        <a class="logo" href="{{ url('/') }}">
                            <img class="h-9" src="{{ $site_details->site_logo }}" alt="">
                        </a>
                    </div>

                </div>
            </div>
        </nav>

        {{ $slot }}
    </div>

    <div id="x-teleport-target"></div>
    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
    <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script>
        function confirmAction(event) {
            const confirmation = confirm("Are you sure you want to clear the cache?");
            if (!confirmation) {
                event.preventDefault();
            }
            return confirmation;
        }
    </script>
</body>

</html>
