<x-header>

    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]">
        <div class="mt-3 col-12 container">
            <div class="col-span-12 sm:col-span-6 lg:col-span-8">

                <div class="mt-4">

                    <div class="flex items-center justify-between">
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            <i class="fa-solid fa-fire-flame-curved mr-0.5"></i> {{ ucfirst($cat) }} Offers
                        </p>

                        <div class="flex" style="gap:6px;">

                            <button style="color: #93989f;border-color: transparent;border-radius: 10px;font-size: 12px;padding: 6px 9px; margin-top: 0px; height: 32px; width: 34px;" class="btn prev-btn h-7 w-7 bg-primary/10 dark:bg-accent-light/10 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 swiper-button-disabled swiper-button-lock" disabled="" tabindex="-1" aria-label="Previous slide" aria-controls="swiper-wrapper-824036646109ce3c6" aria-disabled="true">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>

                            <button style="color: #93989f;border-color: transparent;border-radius: 10px;font-size: 12px;padding: 6px 9px; margin-top: 0px; height: 32px; width: 34px;" class="btn next-btn h-7 w-7 bg-primary/10 dark:bg-accent-light/10 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 swiper-button-disabled swiper-button-lock" tabindex="-1" aria-label="Next slide" aria-controls="swiper-wrapper-824036646109ce3c6" aria-disabled="true" disabled="">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>

                        </div>

                    </div>

                    <div class="app_csm_wrapper">
                        <div class="csm_app_grid">

                            @foreach ($filteredData as $offer)
                                <a href="javascript:void(0)" id="show-api" data-id="{{$offer->offer_id}}"
                                    class="offerList swiper-slide swiper-slide-active" role="group" aria-label="1 / 14"
                                    style="margin-right: 10px; width: 6.8rem !important;"><img src="{{$offer->image_url}}">
                                    <div class="mt-2 mb-1"><span class="offer_text font-medium text-slate-700 dark:text-navy-100">{{$offer->offer_name}}</span>
                                    <span class="offer_text text-xs text-slate-400 dark:text-navy-300">{{$offer->offer_desc}}</span>
                                    </div>
                                    <div class="flex justify-between gap-1">
                                        @if (str_contains($offer->offer_desc, 'game'))
                                        <div class="off_sp_btn">
                                        GAME
                                        </div>
                                        @else
                                        <div class="off_sp_btn bg-red">
                                        APP
                                        </div>
                                        @endif
                                        <div class="font-medium text-slate-700 dark:text-navy-100">${{ round($offer->amount/$site_details->dollar_value,2) }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

        </div>


        <div id="of-api-modal"
        class="of-modal absolute inset-0 bg-slate-900/60 backdrop-blur transition-opacity duration-300"
        data-toggle="modal" data-backdrop="static" data-keyboard="false">
        <div
            class="of-modal-content bg-slate-50 dark:bg-navy-900 border dark:border-navy-700 p-m border-slate-200">
            <div style="height: 100%;">
                <div class="flex justify-between items-center redu1 rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 bg-da-app sm:px-5">
                    <div class="api-csm-title loader-skl-title mr-4">
                        <div id="of_api_title" class="text-base font-medium text-slate-700 dark:text-navy-100">
                        </div>
                    </div>
                    <div class="of-navi">
                        <button
                            class="closeBtn btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25
                            dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
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
