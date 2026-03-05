<x-header>
    @inject('BasicController', 'App\Http\Controllers\BasicController')
    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]">
        <div class="mt-3 col-12 container">
            <div class="col-span-12 sm:col-span-6 lg:col-span-8">

                <div style="margin-top: 15px;margin-bottom: 15px;" class="swiper" x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: 'auto', spaceBetween: 14, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
                    <div class="flex items-center justify-between">
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            <i class="fa-solid fa-user-plus"></i>
                            Refer & Earn
                        </p>
                    </div>
                </div>

                <div class="card pbo in-r">

                    <div class="ref_1">
                        <span class="ref_span">SHARE YOUR REFERRAL LINK</span>
                        <span class="font-medium mt-3">Spread The Word By Sharing Your Referral Link To Get 100 Coins Each Join.</span>
                    </div>

                    <div class="alert bg-layot-dark_csm text-white border mt-6 dark:bg-navy-750 bg:white dark:border-navy-500 flex items-center justify-between
                        rounded-lg bg-white px-4 py-3 text-white dark:bg-accent sm:px-5" style="padding:10px;">
                        <p id="clipboardContent1" class="font-medium text-white text-slate-700 line-clamp-1 dark:text-navy-100"
                        style="margin-right:3px;">{{ url('/r/' . $user->refer_id . '') }}</p>
                        <button
                            class="btn h-6 shrink-0 rounded bg-red px-2 text-xs text-white active:bg-white/25"
                            @click="$clipboard({
                            content:document.querySelector('#clipboardContent1').innerText,
                            success:()=>$notification({text:'Link Copied',variant:'success'}),
                            error:()=>$notification({text:'Error',variant:'error'})
                            })">
                            <i class="fa-solid fa-copy"></i>&nbsp;Copy
                        </button>
                    </div>

                    <div class="ref_1 mt-5">
                        <span class="ref_span">HOW IT WORKS</span>
                    </div>

                    <div class="mt-5">
                        <ol class="steps is-vertical line-space">
                          <li
                            class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500"
                          >
                            <div class="step-header rounded-lg bg-red text-white fs-20">
                            <i class="fa-solid fa-user-group"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                  <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Step 1
                                  </p>
                                </div>
                                <div class="mt-1 flex text-xs text-slate-400 dark:text-navy-300 line-clamp-1">
                                    <div class="games_rw">
                                        <div class="games_rw_img">
                                           <span>Create an account</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </li>
                          <li
                            class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500"
                          >
                          <div class="step-header rounded-lg bg-red text-white fs-20">
                            <i class="fa-solid fa-share-nodes"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                  <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Step 2
                                  </p>
                                </div>
                                <div class="mt-1 flex text-xs text-slate-400 dark:text-navy-300 line-clamp-1">
                                    <div class="games_rw">
                                        <div class="games_rw_img">
                                           <span> Share referral to get </span>
                                            <img src="images/app/app-coin.png" alt="">
                                            <span>{{ env('REFER_BY') }} Points</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </li>
                          <li
                            class="step space-x-4 pb-3 before:bg-slate-200 dark:before:bg-navy-500"
                          >
                          <div class="step-header rounded-lg bg-red text-white fs-20">
                            <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                  <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Step 3
                                  </p>
                                </div>
                                <div class="mt-1 flex text-xs text-slate-400 dark:text-navy-300 line-clamp-1">
                                    <div class="games_rw">
                                        <div class="games_rw_img">
                                           <span> Your each join also get </span>
                                            <img src="images/app/app-coin.png" alt="">
                                            <span>{{ env('REFER_JOIN') }} Points</span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </li>
                        </ol>
                      </div>

                    <div class="ref_1">
                        <span class="ref_span">REFERRAL MISSIONS</span>
                        <span class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100 ref_title">Complate Referral Mission To Earn Coins.</span>
                    </div>

                    <div class="q-l">
                        {{$r_check = ''}}
                        @foreach ($refer_missions as $refer_mission)
                            @php $r_check = $BasicController::refermission_check($refer_mission->m_id,$refer_mission->max_play); @endphp

                            <div class="card p-3 mi_card mt-2">
                                <div class="mission-1">
                                <div class="flex items-center space-x-3">
                                  <img class="h-10 w-10 rounded-lg object-cover object-center" src="{{ url('/images/icons/in-add.png') }}" alt="image">
                                  <div class="flex-1">
                                    <div class="flex justify-between">
                                      <p class="font-medium text-slate-700 dark:text-navy-100">
                                        {{ $refer_mission->m_title }}
                                      </p>
                                    </div>
                                    <div class="mt-0.5 flex text-xs text-slate-400 dark:text-navy-300 line-clamp-1">
                                        <div class="games_rw">
                                            <div class="games_rw_img">
                                                <img src="{{ url('/images/app/app-coin.png') }}" alt="">
                                                <span>{{ $refer_mission->points }} Points</span>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                 <div class="-mt-3 text-right text-xs font-medium text-white">
                                    @if ($r_check == 0)
                                    <span
                                        style="font-size: 12px;">{{ Auth::user()->total_referral }}/{{ $refer_mission->max_play }}</span>
                                @elseif ($r_check == 1)
                                    <form method="POST" action="">
                                        @csrf
                                        <input type="hidden" name="ref_token_read"
                                            value="{{ Crypt::encryptString($refer_mission->m_id) }}" />
                                        <input class="btn_2" type="submit" value="Collect" />
                                    </form>
                                @elseif ($r_check == 2)
                                <button
                                x-tooltip.placement.top.error="'{{ $refer_mission->max_play }} Refer Reached'"
                                class="btn_2">
                                <i class="fa-solid fa-check-double"></i>
                                </button>
                                @endif
                                   </div>
                                  </div>
                                  <p class="text-xs font-medium text-warning"></p>
                                  <div class="progress mt-2 h-1.5 bg-warning/15 dark:bg-warning/25">
                                  <progress value="{{ Auth::user()->total_referral }}" max="{{ $refer_mission->max_play }}" class="w-7/12 rounded-full bg-warning"></progress>
                                  </div>
                            </div>
                        @endforeach
                    </div>



                </div>

            </div>

        </div>
    </main>

</x-header>
