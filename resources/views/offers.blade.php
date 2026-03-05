<x-header>

    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]">
        <div class="mt-3 col-12">
            <div class="col-span-12 sm:col-span-6 lg:col-span-8">

                <div style="margin-top: 10px;"
                    class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
                    x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: 'auto', spaceBetween: 14, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
                    <div class="flex items-center justify-between">
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            <i class="fa-solid fa-sack-dollar"></i>
                            Featured Offers
                        </p>
                    </div>
                </div>

                <div class="api-offers api_of_grid">

                    <div class="off_card"
                        style="background-image:
          url(https://main-p.agmcdn.com/KsYbEVp6Yi3s3B8YfQ4RdeeZ0TScIHqFe36x9TsT.gif);">
                        <div class="of_s_b backfade">
                            <span class="offer-tag offer_text" style="font-weight: bold;">Disney Emoji Blitz Game</span>
                            <div class="off_span">
                                <span class="offer_text">Play Disney Emoji Blitz</span>
                                <div class="off_sp_btn">$10.0</div>
                            </div>
                        </div>
                    </div>

                    <div class="off_card"
                        style="background-image:
         url(https://play-lh.googleusercontent.com/LmZuGeTmqAA3BTvSHvS7HSFOUfpajbknRhELZmoCHllZ27QZlhyPjD9urOrZwZAFM-A=s120-rw);">
                        <div class="of_s_b backfade">
                            <span class="offer-tag offer_text" style="font-weight: bold;">Disney Emoji Blitz Game</span>
                            <div class="off_span">
                                <span class="offer_text">Play Disney Emoji Blitz</span>
                                <div class="off_sp_btn">$10.0</div>
                            </div>
                        </div>
                    </div>

                    <div class="off_card"
                        style="background-image:
         url(https://cdn.adgem.com/campaigns/13766/campaign-offerwall-creatives/icons/202110281512.jpg);">
                        <div class="of_s_b backfade">
                            <span class="offer-tag offer_text" style="font-weight: bold;">Disney Emoji Blitz Game</span>
                            <div class="off_span">
                                <span class="offer_text">Play Disney Emoji Blitz</span>
                                <div class="off_sp_btn">$10.0</div>
                            </div>
                        </div>
                    </div>

                    <div class="off_card"
                        style="background-image:
         url(https://freecash.com/public/img/survey-background-yellow.png);">
                        <div class="of_s_b backfade">
                            <span class="offer-tag offer_text" style="font-weight: bold;">Disney Emoji Blitz Game</span>
                            <div class="off_span">
                                <span class="offer_text">Play Disney Emoji Blitz</span>
                                <div class="off_sp_btn">$10.0</div>
                            </div>
                        </div>
                    </div>

                    <div class="off_card"
                        style="background-image:
         url(https://main-p.agmcdn.com/AzEn1T1T4KBx2WbL7wkKG1lLOb8Q3FiOVzSxondj.gif);">
                        <div class="of_s_b backfade">
                            <span class="offer-tag offer_text" style="font-weight: bold;">Disney Emoji Blitz Game</span>
                            <div class="off_span">
                                <span class="offer_text">Play Disney Emoji Blitz</span>
                                <div class="off_sp_btn">$10.0</div>
                            </div>
                        </div>
                    </div>

                    <div class="off_card"
                        style="background-image:
         url(https://play-lh.googleusercontent.com/0Rqh-hgkf10RQ_EjDy8U0oEFZxDO3ouKoIrgVRAWHZlbX_bHWkhxcazeuYI8wJxHBg=s120-rw);">
                        <div class="of_s_b backfade">
                            <span class="offer-tag offer_text" style="font-weight: bold;">Disney Emoji Blitz Game</span>
                            <div class="off_span">
                                <span class="offer_text">Play Disney Emoji Blitz</span>
                                <div class="off_sp_btn">$10.0</div>
                            </div>
                        </div>
                    </div>

                </div>


                <div style="margin-top: 18px;"
                    class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden"
                    x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: 'auto', spaceBetween: 14, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
                    <div class="flex items-center justify-between">
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            <i class="fa-solid fa-magnifying-glass-dollar"></i>
                            Offer Walls & Surveys
                        </p>
                    </div>
                </div>

                <div class="mt-4 of_grid" style="gap:7px;">
                    @foreach ($offers as $offer)
                        <a onclick="document.getElementById('of-modal{{ $offer->id }}').style.display='block'"
                            class="card p-2 offer_card_boder modalButton">
                            <div class="offer_card">
                                <div>
                                    <img class="offer_img" src="{{ $offer->image }}"
                                        style="background-color:{{ $offer->color }};">
                                </div>
                                <div>
                                    <span class="offer-span">Offerwall</span>
                                    <h1 class="offer-h1">{{ $offer->title }}</h1>
                                </div>
                            </div>
                            <div class="offer_sec">2X Extra Bonus</div>
                        </a>
                        <div id="of-modal{{ $offer->id }}" class="of-modal">
                            <div
                                class="of-modal-content bg-slate-50 dark:bg-navy-900 border dark:border-navy-700 border-slate-200">
                                <div
                                    class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                                        {{ $offer->title }}
                                    </h3>
                                    <div class="of-navi">
                                        <a href="{{ route('tab_offer', $offer->id_name) }}"
                                            class="closeBtn btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                            target="_blank">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        <button
                                            class="closeBtn btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25
                                            dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                            onclick="document.getElementById('of-modal{{ $offer->id }}').style.display='none'">
                                            <i id="i-xmr" class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="loaderoffer{{ $offer->id }}" class="loader-line" style="display:block;">
                                </div>
                                <div class="box_modal">
                                    <iframe class="offeriframe" id="offeriframe{{ $offer->id }}" loading="lazy"
                                        src="{{ $offer->slug }}"></iframe>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#offeriframe{{ $offer->id }}').on('load', function() {
                                    document.getElementById("loaderoffer{{ $offer->id }}").style.display = "none";
                                });
                            });
                        </script>
                    @endforeach
                </div>

                <style>
                    .of-navi {
                        display: flex;
                        gap: 9px;
                        font-size: 18px;
                    }

                    .of-modal {
                        display: none;
                        position: fixed;
                        z-index: 1000;
                        padding-top: 20px;
                        left: 0;
                        top: 0;
                        width: 100%;
                        height: 100%;
                        overflow: auto;
                        background-color: rgba(0, 0, 0, 0.637);
                    }

                    .of-modal-content {
                        border-top-left-radius: 0.5rem;
                        border-top-right-radius: 0.5rem;
                        border-bottom-left-radius: 0.5rem;
                        border-bottom-right-radius: 0.5rem;
                        margin: auto;
                        border: 1px solid #888;
                        width: 90%;
                        max-width: 600px;
                        text-align: center;
                        position: relative;
                    }

                    .of-close {
                        color: #aaa;
                        float: right;
                        font-size: 28px;
                        font-weight: bold;
                        position: absolute;
                        top: 5px;
                        right: 10px;
                    }

                    .of-close:hover,
                    .of-close:focus {
                        color: black;
                        text-decoration: none;
                        cursor: pointer;
                    }

                    #i-xmr {
                        font-size: 22px;
                    }
                </style>

            </div>

        </div>
    </main>

</x-header>
<script type="text/javascript">
    document.body.innerHTML = document.body.innerHTML
        .replaceAll("USERID", "{{ $user_id }}");
</script>
