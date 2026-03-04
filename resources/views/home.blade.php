<x-header>

    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]">
        <div class="mt-3 col-12">
            <div class="col-span-12 sm:col-span-6 lg:col-span-8">

                
                <div class="swiper mt-3 swiper-initialized swiper-horizontal swiper-backface-hidden"
                    x-init="$nextTick(() => new Swiper($el, { slidesPerView: 'auto', spaceBetween: 8 }))">
                    <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);"
                        id="swiper-wrapper-598c411fdede8c28" aria-live="polite">
                        @foreach ($red_req as $req)
                            <div class="card swiper-slide relative flex w-40 flex-col overflow-hidden flex space-x-2 pd new_csm_rr"
                                data-id="id-{{ $req->id }}">
                                <div
                                    class="flex bg-red h-9 w-9 shrink-0 items-center justify-center rounded-lg text-white">
                                    @if (0 == 1)
                                        <img class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg"
                                            src="https://lh3.googleusercontent.com/a/AAcHTtceA4RJCKPFF3og0GmKloFzSFmzhhqUfi51vCBjeQ=s96-c"
                                            alt="">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">
                                        {{ substr($req->name, 0, 10) }}
                                    </p>
                                    <div class="flex w-full items-center gap-2">
                                        <span
                                            class="mt-0.5 text-xs text-slate-400 dark:text-navy-300">{{ $req->request_amount }}</span>
                                        <span
                                            class="flex w-full items-center gap-1 mt-0.5 text-xs text-slate-400 dark:text-navy-300">
                                            <img style="height: 14px;" src="images/app/app-coin.png">
                                            <span>{{ $req->points_used }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                
                @if(env('DISABLE_HOMEPAGE_ADGET_FEATURED_OFFERS')=="true")

                <div class="is-scrollbar-hidden overflow-x-auto mt-8 offer-cat">
                    <div class="flex w-max space-x-1.5">
                        <a href="#"
                            class="tag h-7 rounded-full bg-red text-xs+ text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            All
                        </a>
                        <a href="{{ route('csm_of_cat', 'game') }}" class="tag h-7 offer-cat-idol">
                            Games
                        </a>
                        <a href="{{ route('csm_of_cat', 'app') }}" class="tag h-7 offer-cat-idol">
                            Apps
                        </a>
                        <a href="{{ route('csm_of_cat', 'register') }}" class="tag h-7 offer-cat-idol">
                            Sign Up
                        </a>
                        <a href="{{ route('csm_of_cat', 'survey') }}" class="tag h-7 offer-cat-idol">
                            Survey
                        </a>
                    </div>
                </div>

                
                <div class="swiper mt-5" x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: 'auto', spaceBetween: 10, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">

                    <div class="flex items-center justify-between">
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            <i class="fa-solid fa-fire-flame-curved mr-0.5"></i> FEATURED OFFERS
                        </p>

                        <div class="flex" style="gap:6px;">

                            <button
                                style="color: #93989f;border-color: transparent;border-radius: 10px;font-size: 12px;padding: 6px 9px; margin-top: 0px; height: 32px; width: 34px;"
                                class="btn prev-btn h-7 w-7 bg-primary/10 dark:bg-accent-light/10 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>

                            <button
                                style="color: #93989f;border-color: transparent;border-radius: 10px;font-size: 12px;padding: 6px 9px; margin-top: 0px; height: 32px; width: 34px;"
                                class="btn next-btn h-7 w-7 bg-primary/10 dark:bg-accent-light/10 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>

                        </div>

                    </div>

                    <div class="swiper-wrapper mt-2 mb-2 api-container" x-data="{ selected: 'slide-1' }">

                    </div>

                </div>
                @endif

                {{-- offes --}}
                <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden mt-10"
                    x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: 'auto', spaceBetween: 14, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
                    <div class="flex items-center justify-between">
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            <i class="fa-solid fa-sack-dollar mr-0.5"></i> OfferWalls
                        </p>
                    </div>
                </div>

                <div class="app-data of_grid gap-1 mt-3">
                    @foreach ($offers as $offer)
                        <div class="csm-offers loader-skl">
                            <a class="card offer-backcolor p-2 offer_card_boder csm-h" href="javascript:void(0)"
                                id="show-offer" data-id="{{ $offer->id }}" style="{{ $offer->back_col }};">
                                <div class="flex justify-between">
                                    <div class="offer_card">
                                        <div>
                                            <img class="offer_img" src="{{ $offer->image }}"
                                                style="background-color:{{ $offer->color }};">
                                        </div>
                                        <div>
                                            <span class="offer-span text-slate-400">Offerwall</span>
                                            <h1 class="offer-h1">{{ $offer->title }}</h1>
                                        </div>
                                    </div>
                                    <div class="offer-span text-slate-400">
                                        @if (!empty($offer->offer))
                                            {{ $offer->offer }}
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="mt-2.5">
                                        <span
                                            class="flex w-full of-badge items-center gap-1 mt-0.5 text-xs text-slate-400 dark:text-navy-300">
                                            <img style="height: 14px;" src="images/app/app-coin.png"><span
                                                class="font-medium">{{ rand(10, 200) }}K</span>
                                        </span>
                                    </span>
                                    <span class="flex mt-2 text-warning space-x-0.5 text-sm lg:space-x-1 lg:text-base">
                                        @if ($offer->rate == '1')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif($offer->rate == '2')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif($offer->rate == '3')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif($offer->rate == '4')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif($offer->rate == '5')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @else
                                        @endif
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden mt-5"
                    x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: 'auto', spaceBetween: 14, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
                    <div class="flex items-center justify-between">
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            <i class="fa-solid fa-magnifying-glass-dollar mr-0.5"></i> Survey Walls
                        </p>
                    </div>
                </div>

                {{-- surveys --}}
                <div class="mt-3 of_grid gap-1">
                    @foreach ($surveys as $offer)
                        <div class="csm-offers loader-skl">
                            <a class="card offer-backcolor p-2 offer_card_boder csm-h" href="javascript:void(0)"
                                id="show-offer" data-id="{{ $offer->id }}" style="{{ $offer->back_col }};">
                                <div class="flex justify-between">
                                    <div class="offer_card">
                                        <div>
                                            <img class="offer_img" src="{{ $offer->image }}"
                                                style="background-color:{{ $offer->color }};">
                                        </div>
                                        <div>
                                            <span class="offer-span text-slate-400">Survey</span>
                                            <h1 class="offer-h1">{{ $offer->title }}</h1>
                                        </div>
                                    </div>
                                    <div class="offer-span text-slate-400">
                                        @if (!empty($offer->offer))
                                            {{ $offer->offer }}
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="mt-2.5">
                                        <span
                                            class="flex w-full of-badge items-center gap-1 mt-0.5 text-xs text-slate-400 dark:text-navy-300">
                                            <img style="height: 14px;" src="images/app/app-coin.png"><span
                                                class="font-medium">{{ rand(10, 200) }}K</span>
                                        </span>
                                    </span>
                                    <span class="flex mt-2 text-warning space-x-0.5 text-sm lg:space-x-1 lg:text-base">
                                        @if ($offer->rate == '1')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif($offer->rate == '2')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif($offer->rate == '3')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif($offer->rate == '4')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-regular fa-star text-warning"></i>
                                        @elseif($offer->rate == '5')
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @else
                                        @endif
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

        <div class="footer mt-10 border-t border-slate-100 bg-fg dark:border-navy-700 dark:bg-navy-800">

            <div>
                <a href="/">
                    <img class="h-10" src="{{ $site_details->site_logo }}" alt="">
                </a>
                <p class="font-medium mt-2 offer-12">{{ $site_details->copyright }}.</p>
            </div>

            <div>
                <h2 class="font-medium text-slate-700 dark:text-navy-100 lg:text-base text-left">About</h2>
                <div class="flex font-medium flex-col gap-2 mt-3">
                    @foreach ($pageslist as $page)
                        <div class="flex items-center">
                            <div class="h-2 w-2 rounded-full border-2 border-red dark:border-accent fm"></div>
                            <a class="ml-1" href="{{ url('/page', $page->slug) }}">{{ $page->title }}</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="font-medium text-slate-700 dark:text-navy-100 lg:text-base text-left">Support</h2>
                <div class="flex font-medium flex-col gap-2 mt-3">
                    <div class="flex items-center">
                        <div class="h-2 w-2 rounded-full border-2 border-red dark:border-accent fm"></div>
                        <a class="ml-1" href="{{ url('page/business-inquiry') }}">Business inquiry</a>
                    </div>
                    <div class="flex items-center">
                        <div class="h-2 w-2 rounded-full border-2 border-red dark:border-accent fm"></div>
                        <a class="ml-1" href="mailto:{{ $site_details->contact_email }}">Contact</a>
                    </div>
                    <div class="flex items-center">
                        <div class="h-2 w-2 rounded-full border-2 border-red dark:border-accent fm"></div>
                        <a class="ml-1" href="{{ route('faqs') }}">FAQ</a>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="font-medium text-slate-700 dark:text-navy-100 lg:text-base text-left">Social Media</h2>
                <div class="mt-3">
                    @foreach ($socialmedia as $media)
                        <a target="_blank" href="{{ $media->url }}" class="{{ $media->class }}">
                            {!! $media->icon !!}
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="font-medium text-slate-700 dark:text-navy-100 lg:text-base text-left">Language</h2>
                <a class="lang mt-2">
                    <img class="w-6" src="{{ url('images/icons/en.png') }}">
                    <div>English</div>
                </a>
            </div>

        </div>

        <div id="of-modal"
            class="of-modal absolute inset-0 bg-slate-900/60 backdrop-blur transition-opacity duration-300"
            data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div
                class="of-modal-content bg-slate-50 dark:bg-navy-900 border dark:border-navy-700 p-m border-slate-200">
                <div
                    class="flex justify-between bb-0 rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 bg-da-app sm:px-5 mob-nv">
                    <h3 id="of_title" class="text-base font-medium text-slate-700 dark:text-navy-100"></h3>
                    <div class="of-navi">
                        <a class="closeBtn tab-offer btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                            target="_blank" href="">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <button
                            class="closeBtn btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25
                        dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                            id="close-csm">
                            <i id="i-xmr" class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                <div id="csm_lo_of"></div>
                <div class="box_modal">
                    <iframe class="offeriframe" id="of_if" loading="lazy" src=""></iframe>
                </div>
            </div>
        </div>

        <div id="of-api-modal"
            class="of-modal absolute inset-0 bg-slate-900/60 backdrop-blur transition-opacity duration-300"
            data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div
                class="of-modal-content bg-slate-50 dark:bg-navy-900 border dark:border-navy-700 p-m border-slate-200">
                <div style="height: 100%;">
                    <div
                        class="flex justify-between items-center redu1 rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 bg-da-app sm:px-5">
                        <div class="api-csm-title loader-skl-title mr-4">
                            <div id="of_api_title" class="text-base font-medium text-slate-700 dark:text-navy-100">
                            </div>
                        </div>
                        <div class="of-navi">
                            <button
                                class="closeBtn btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                id="close-csm-api">
                                <i id="i-xmr" class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>

                    <div id="csm_lo_of"></div>
                    {{-- api content --}}
                    <div class="data-p">
                        <div class="offer-api p-4 box_modal">

                            <div class="flex gap-4">
                                <div class="api-csm-img loader-skl-api-img">
                                    <div class="h-28 w-28">
                                        <img id="csm_of_icon" class="rounded-lg" src="" />
                                    </div>
                                </div>

                                <div class="flex flex-col gap-2 mt-3 of-csm-con loader-skl-api-con">
                                    <div class="flex items-center gap-2 ti-1 csm-h">
                                        <div class="text-base font-medium text-slate-700 dark:text-navy-100"><i
                                                class="fa-solid fa-coins text-warning mr-1"></i>
                                            <span id="api_coin">0</span>
                                        </div>
                                        <div class="off_sp_btn off_sp_btn1 bg-red"></div>
                                    </div>

                                    <span class="text-xs+ line-clamp-3 text-left ti-2 csm-h">
                                        Provider: Adget
                                    </span>

                                    <div class="text-left ti-3 csm-h">
                                        <i class="fa-solid fa-ranking-star text-warning mr-1"></i>
                                        <span class="text-xs+" id="api_rank">0</span>
                                    </div>
                                </div>

                            </div>

                            <div class="card mt-4 p-3 text-left csm-ds">
                                <h5 class="text-warning">Description</h5>
                                <div class="csm_of_des loader-skl-title mt-2">
                                    <span id="of_api_desc" class="mt-2 text-xs+">
                                    </span>
                                </div>
                            </div>

                            <div class="mt-3 text-left">
                                <h5 class="text-white">Steps</h5>
                                <div class="mt-2">
                                    <div class="flex items-center gap-2 api-step">
                                        <div class="h-2 w-2 rounded-full bg-red"></div>
                                        <span id="api_stp" class="loader-skl-title"></span>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <div class="flex items-center gap-2 api-step">
                                        <div class="h-2 w-2 rounded-full bg-red"></div>
                                        <span id="cot" class="loader-skl-title"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <a class="app-button api_url" href="" target="_blank">START EARN</a>
                    </div>
                </div>
            </div>
        </div>

    </main>

</x-header>
