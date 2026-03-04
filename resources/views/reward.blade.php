<x-header>

    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]">
        <div class="mt-3 col-12 container">

            <div class="col-span-12 sm:col-span-6 lg:col-span-8">


                @if ($errors->any())
                    <div class="space-y-4 mt-5">
                        <div x-data="{ isShow: true }" :class="!isShow && 'opacity-0 transition-opacity duration-300'"
                            class="alert flex items-center justify-between overflow-hidden rounded-lg border border-warning text-info">
                            <div class="flex">
                                <div class="bg-warning p-3 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewbox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="px-4 py-3 sm:px-5 text-warning">{{ $errors->first() }}</div>
                            </div>
                            <div class="px-2">
                                <button @click="isShow = false; setTimeout(()=>$root.remove(),300)"
                                    class="btn h-7 w-7 rounded-full p-0 font-medium text-warning hover:bg-warning/20 focus:bg-warning/20 active:bg-warning/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewbox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif


                <div style="margin-top: 15px;margin-bottom: 15px;" class="swiper" x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: 'auto', spaceBetween: 14, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
                    <div class="flex items-center justify-between">
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            <i class="fa-brands fa-google-wallet mr-1"></i>
                            Cashout
                        </p>
                    </div>
                </div>

                <div class="api-offers api_of_grid rew_add">

                    @foreach ($redeemlist as $reward)
                        <a class="flex flex-col" style="position: relative;"
                            @if ($u_po >= $reward->points)
                            href="{{ route('cashout_', $reward->txn_id) }}"
                            @else
                            @if(empty(Auth::user()))
                            href="{{ route('login') }}"
                            @else
                            @click="$notification({text:'You do not have enough {{ num($reward->points) }} points',variant:'error',position:'center-bottom'})"
                            @endif
                            @endif>
                            <i class="rewtag">{{ $reward->price }}</i>
                            <img class="h-44 w-full rounded-2xl object-cover object-center rew_img"
                                src="{{ $reward->image }}">
                            <div class="card -mt-8 grow rounded-2xl p-4 rew_title">
                                <div class="rew_flex">
                                    <div class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                                        {{ $reward->title }}</div>

                                    <div class="off_sp_btn flex items-center gap-1"
                                        style="background:{{ $reward->color }};">
                                        <img style="height: 12px;" src="/images/app/app-coin.png">
                                        <span>{{ num($reward->points) }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>



            </div>

        </div>
    </main>

</x-header>
