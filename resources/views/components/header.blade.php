<!DOCTYPE html>
@if (Auth::user())
    @inject('BasicController', 'App\Http\Controllers\BasicController')
    {{ $BasicController::missionglob() }}
@endif
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <title>@yield('title', $site_details->site_name)</title>
    <meta name="description" content="@yield('description', $site_details->site_desc)">
    <meta name="keywords" content="@yield('keywords', $site_details->site_keywords)">
    <link rel="icon" type="image/png" href="{{ $site_details->fav_icon }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <input type="hidden" id="xt" value="{{ $site_details->dollar_value }}" />
    @if (Auth::user())
        <input type="hidden" id="ui" value="{{ Auth::user()->id }}" />
    @endif
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/additional.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet" />
    @stack('post-seo')
    <style>
    @media (min-width: 1024px) {
    :root {
        --main-sidebar-width: 3rem;
        --sidebar-panel-width: 240px;
    }
    }
    
    :root {
        --margin-x: 1rem;
        --main-sidebar-width: 3.5rem;
        --sidebar-panel-width: 230px;
        --sidebar-panel-min-width: 64px;
    }
    .toast {
    box-shadow: none !important;
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


        <!-- App Header Wrapper-->
        <nav class="header print:hidden">
            <!-- App Header  -->
            <div class="header-container relative flex w-full bg-white dark:bg-navy-750 print:hidden">
                <!-- Header Items -->
                <div class="flex w-full items-center justify-between">

                    <div class="navp">
                        <div class="h-7 w-7">
                            <button
                                class="menu-toggle ml-0.5 flex h-7 w-7 flex-col justify-center space-y-1.5 text-white outline-none focus:outline-none dark:text-accent-light/80"
                                :class="$store.global.isSidebarExpanded && 'active'"
                                @click="$store.global.isSidebarExpanded = !$store.global.isSidebarExpanded">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                        <a class="mv-logo" href="{{ url('/') }}">
                        <img class="h-11 ml-1" src="{{ $site_details->app_icon }}" alt="">
                        </a>
                        <a class="dc-logo" href="{{ url('/') }}">
                        <img class="h-9" src="{{ $site_details->site_logo }}" alt="">
                        </a>
                    </div>

                    <!-- Right: Header buttons -->
                    <div class="-mr-1.5 flex items-center space-x-1">

                        @if (Auth::guest())
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('login') }}" class="csm_btn_log_ log_in_csm" data-id="login">
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="csm_btn_log_2">
                                    Sign up
                                </a>
                            </div>
                        @else
                            <div x-data="usePopper({ placement: 'bottom-start', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
                                class="inline-flex">
                                <button class="barbase app_po" x-ref="popperRef" @click="isShowPopper = !isShowPopper">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 transition-transform duration-200"
                                        :class="isShowPopper && 'rotate-180'" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>

                                    <span
                                        class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100">{{ num(Auth::user()->points) }}</span>
                                    <img style="height: 18px;" src="{{ asset('images/app/app-coin.png') }}"
                                        alt="rp">
                                    <div class="walle"><i class="fa-solid fa-wallet"></i></div>
                                </button>
                                <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                                    <div class="popper-box w-60 p_box rounded-md border border-lt app-bg-lt text-white">
                                        <div class="pro_con">
                                            @if (Auth::user()->picture == '')
                                                <img class="h-18 mask is-squircle"
                                                    src="https://cdn-icons-png.flaticon.com/512/2858/2858384.png"
                                                    alt="profile">
                                            @else
                                                <img class="h-18 mask is-squircle" src="{{ Auth::user()->picture }}"
                                                    alt="profile image">
                                            @endif
                                            <h3>
                                                {{ Auth::user()->name ?? '' }}
                                            </h3>
                                        </div>

                                        <div class="border-t b-mn"></div>

                                        <ul class="space-y-1.5 px-2 pt-1 font-inter text-xs+ font-medium">
                                            <li>
                                                <a class="group mn-l flex justify-between space-x-2 rounded-lg p-2 tracking-wide text-white"
                                                    href="{{ route('profile') }}">
                                                    <div class="flex items-center space-x-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4.5 w-4.5 text-white" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        <span class="text-white">Profile</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="group flex mn-l justify-between space-x-2 rounded-lg p-2 tracking-wide text-white"
                                                    href="{{ url('/missions') }}">
                                                    <div class="flex items-center space-x-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4.5 w-4.5 text-white" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                            </path>
                                                        </svg>
                                                        <span class="text-white">Daily
                                                            Missions</span>
                                                    </div>
                                                    <span class="tag-b">{{ $miss }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="group flex mn-l justify-between space-x-2 rounded-lg p-2 tracking-wide text-white"
                                                    href="{{ url('/invite') }}">
                                                    <div class="flex items-center space-x-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4.5 w-4.5 text-white" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                            </path>
                                                        </svg>
                                                        <span class="text-white">Affiliates</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="group mn-l flex mn-l justify-between space-x-2 rounded-lg p-2 tracking-wide text-white"
                                                    href="{{ route('transaction') }}">
                                                    <div class="flex items-center space-x-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4.5 w-4.5 text-white" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                            </path>
                                                        </svg>
                                                        <span class="text-white">Transaction</span>
                                                    </div>
                                                    <span class="text-white"></span>
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a class="group flex mn-l justify-between space-x-2 rounded-lg p-2 tracking-wide text-white mb-2"
                                                        href="{{ route('logout') }}" style="margin-bottom:10px;"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <div class="flex items-center space-x-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-4.5 w-4.5 text-white" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5"
                                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                                </path>
                                                            </svg>
                                                            <span class="text-white">Log
                                                                Out</span>
                                                        </div>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>



                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="nrm"></div>

                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="sidebar print:hidden">
            <!-- Main Sidebar -->
            <div class="main-sidebar">
                <div
                    class="flex h-full flex-col border-r border-slate-100 dark:border-navy-700 bg-fg dark:bg-navy-800">

                    <!-- Main Sections Links -->
                    <div class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-4">
                        @php
                            $acgeturl = request()->path();
                        @endphp

                        <!-- Home -->
                        @if ($acgeturl == '/')
                            <a href="{{ url('/') }}"
                                class="sl-active-home flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                x-tooltip.placement.right="'Home'">
                                <i class="fa-solid fa-house-crack k-1 k-active"></i>
                            </a>
                        @else
                            <a href="{{ url('/') }}"
                                class="flex sl sl-top h-11 w-11 items-center justify-center outline-none transition-colors duration-200 mon-h"
                                x-tooltip.placement.right="'Home'">
                                <i class="fa-solid fa-house-crack k-1"></i>
                            </a>
                        @endif


                        <!-- Missions -->
                        @if ($acgeturl == 'missions')
                            <a href="{{ url('/missions') }}"
                                class="flex sl-active-all h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200"
                                x-tooltip.placement.right="'Missions'">
                                <i class="fa-solid fa-circle-question k-1 k-active"></i>
                            </a>
                        @else
                            <a href="{{ url('/missions') }}"
                                class="flex sl h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 mon-h"
                                x-tooltip.placement.right="'Missions'">
                                <i class="fa-solid fa-circle-question k-1"></i>
                            </a>
                        @endif

                    </div>

                    <!-- Bottom Links -->
                    <div class="flex flex-col items-center space-y-3">
                        @auth('admin')
                            <a title="admin" href="{{ route('admin.dashboard') }}"
                                class="btn sl sl-top h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <i class="fa-solid fa-hammer"></i>
                            </a>
                        @else
                        @endauth

                        @if (!Auth::guest())
                            <button
                                class="btn sl sl-top h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                         this.closest('form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    </x-dropdown-link>
                                </form>
                            </button>
                        @else
                        @endif

                    </div>
                </div>
            </div>

            <!-- Sidebar Panel -->
            <div class="sidebar-panel" id="sh">
                <div id="sidebarp"
                    class="flex h-full grow flex-col bg-fg pl-[var(--main-sidebar-width)] dark:bg-navy-750">

                    <!-- Sidebar Panel Body -->
                    <div class="flex h-[calc(100%-4.5rem)] grow flex-col">
                        <div class="is-scrollbar-hidden grow overflow-y-auto">

                            <button @click="$store.global.isSidebarExpanded = false"
                                :class="$store.global.isSidebarExpanded && 'is_opn'"
                                class="btn clos_csm_ rounded-full p-0 text-white xl:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <a href="{{ $site_details->app_url }}" target="_blank" class="card flex w-full pd"
                                style="margin:7px 10px 15px 7px;width:215px; padding: 6px; gap: 9px;">
                                <div class="flex items-center justify-center rounded-lg text-white">

                                    <svg width="20" height="20" class="h-7 w-7" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_523_141010)">
                                            <path
                                                d="M11.5075 10.0018L1.46393 19.673C0.993605 19.3516 0.714365 18.8169 0.719303 18.2473V1.75623C0.714365 1.1866 0.993605 0.651956 1.46393 0.330532L11.5075 10.0018Z"
                                                fill="#2196F3"></path>
                                            <path
                                                d="M15.0217 6.62364L11.5074 10.0018L1.46387 0.330532C1.50171 0.301203 1.54113 0.273918 1.58191 0.248803C2.11272 -0.0729183 2.77574 -0.0833047 3.31639 0.221561L15.0217 6.62364Z"
                                                fill="#4CAF50"></path>
                                            <path
                                                d="M19.2809 10.0018C19.2874 10.6448 18.938 11.2388 18.3728 11.5455L15.0219 13.3799L11.5076 10.0018L15.0219 6.62365L18.3728 8.45799C18.938 8.76473 19.2874 9.35871 19.2809 10.0018Z"
                                                fill="#FFC107"></path>
                                            <path
                                                d="M15.0217 13.3799L3.31639 19.782C2.77455 20.0821 2.11404 20.0717 1.58191 19.7547C1.54113 19.7296 1.50171 19.7023 1.46387 19.673L11.5074 10.0018L15.0217 13.3799Z"
                                                fill="#F44336"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_523_141010">
                                                <rect width="20" height="20" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">
                                        Download our app
                                    </p>
                                    <div class="flex w-full items-center gap-2">
                                        <span class="mt-0.5 text-xs text-slate-400 dark:text-navy-300">Get 100
                                            Coins!</span>
                                    </div>
                                </div>
                                <i class="fa-solid fa-up-right-from-square ml-1 text-slate-400"></i>
                            </a>

                            <div x-data="{ expanded: true }">

                                <div x-show="expanded" x-collapse>
                                    <ul class="mt-1 space-y-1.5 px-2 font-inter text-xs+ font-medium">

                                        <div class="line"
                                            style="background: linear-gradient(90deg,rgba(67,83,109,0) -3%,#43536d 48.66%,rgba(67,83,109,0) 103.12%);
                                         height: 1px;width: calc(100% - 18px);margin-bottom: 16px;">
                                        </div>

                                        <a href="{{ url('/') }}"
                                            class="nav-li-n-o  @if ($acgeturl == '/') men_ac @endif group flex space-x-2 rounded-lg bg-primary/10 p-2 tracking-wide text-primary outline-none transition-all dark:bg-accent-light/10 dark:text-accent-light"
                                            href="#">
                                            <i class="fa-solid fa-sack-dollar mr-1"></i>
                                            <span class="">Earn</span>
                                        </a>
                                        <a href="{{ route('cashout') }}"
                                            class="nav-li-n-o @if ($acgeturl == 'cashout') men_ac @endif group flex space-x-2 rounded-lg bg-primary/10 p-2 tracking-wide text-primary outline-none transition-all dark:bg-accent-light/10 dark:text-accent-light"
                                            href="#">
                                            <i class="fa-solid fa-filter-circle-dollar mr-1"></i>
                                            <span class="">Cashout</span>
                                        </a>
                                        <a href="{{ route('leaderboard') }}"
                                            class="nav-li-n-o @if ($acgeturl == 'leaderboard') men_ac @endif group flex space-x-2 rounded-lg bg-primary/10 p-2 tracking-wide text-primary outline-none transition-all dark:bg-accent-light/10 dark:text-accent-light"
                                            href="#">
                                            <i class="fa-solid fa-trophy mr-1"></i>
                                            <span class="">Leaderboard</span>
                                        </a>
                                        <a href="{{ route('missions') }}"
                                            class="nav-li-n-o @if ($acgeturl == 'missions') men_ac @endif group flex space-x-2 rounded-lg bg-primary/10 p-2 tracking-wide text-primary outline-none transition-all dark:bg-accent-light/10 dark:text-accent-light"
                                            href="#">
                                            <i class="fa-solid fa-chess-rook mr-1"></i>
                                            <span class="">Missions</span>
                                        </a>

                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="" @click="$store.global.isSidebarExpanded = false"
                :class="$store.global.isSidebarExpanded && 's-off'">
            </div>
        </div>

        {{ $slot }}

    </div>


    <div id="cookieNotice" class="card display-right border border-slate-300"
        style="display:none;padding-bottom: 0px;padding-top: 10px;">
        <div x-data="{ expanded: false }">
            <div @click="expanded = !expanded"
                class="flex cursor-pointer items-center justify-between py-4 text-base font-medium text-slate-700 dark:text-navy-100">
                <div id="closeIcon" style="display: none;">
                </div>
                <div class="title-wrap" style="margin-right: 10px;">
                    <h5>Cookie Consent</h5>
                </div>
                <div :class="expanded & amp; & amp;
                '-rotate-180'"
                    class="text-sm font-normal leading-none text-slate-400 transition-transform duration-300 dark:text-navy-300"
                    style="margin-top:-10px;">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            <div x-collapse="" x-show="expanded" style="height: 0px; overflow: hidden; display: none;"
                hidden="">
                <div class="content-wrap">
                    <div class="msg-wrap" style="margin-bottom:12px;">
                        <p>This website uses cookies or similar technologies, to enhance your browsing experience and
                            provide personalized recommendations. By continuing to use our website, you agree to our <a
                            href="{{ url('/page/privacy-policy') }}" class="text-primary">Privacy Policy.</a></p>
                        <div class="btn-wrap">
                            <button class="btnac bg-error" onclick="acceptCookieConsent();">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="x-teleport-target"></div>
    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
    <script>
        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }


        function deleteCookie(cname) {
            const d = new Date();
            d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=;" + expires + ";path=/";
        }


        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function acceptCookieConsent() {
            deleteCookie('user_cookie_consent');
            setCookie('user_cookie_consent', 1, 30);
            document.getElementById("cookieNotice").style.display = "none";
        }
        let cookie_consent = getCookie("user_cookie_consent");
        if (cookie_consent != "") {
            document.getElementById("cookieNotice").style.display = "none";
        } else {
            document.getElementById("cookieNotice").style.display = "block";
        }
    </script>
    <script>
        function myFunction(x) {
            if (x.matches) {} else {
                $("body").addClass("is-header-blur is-sidebar-open");
                $("#sidebarp").addClass("border-r border-slate-100 dark:border-navy-700");
                $("#sh").addClass("sh");
            }
        }
        var x = window.matchMedia("(max-width: 700px)")
        myFunction(x)
        x.addListener(myFunction)
    </script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    
        $(document).ready(function () {
            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
    
</body>

</html>
