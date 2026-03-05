<x-header>

    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]">
        <div class="mt-3 col-12 container">
            <div class="col-span-12 sm:col-span-6 lg:col-span-8">
                <form method="POST" action="" id="up-pro" enctype="multipart/form-data">
                @csrf
                <div class="profile-header">
                    <div class="avatar h-24 w-24">
                        @if (Auth::user()->picture == null)
                        <img id="img-preview" class="mask is-squircle" src="https://cdn-icons-png.flaticon.com/512/2858/2858384.png"
                        alt="avatar"/>
                        @else
                        <img id="img-preview" class="mask is-squircle" src="{{ Auth::user()->picture }}" alt="avatar" />
                        @endif
                        <div class="absolute bottom-0 right-0 flex items-center justify-center rounded-full bg-white dark:bg-navy-700">
                            <label
                                class="btn h-6 w-6 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:border-navy-500 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <input tabindex="-1" type="file" name="csm_avatar" id="choose-file"
                                 class="pointer-events-none absolute inset-0 h-full w-full opacity-0">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                            </label>
                        </div>
                     </div>
                    <h1 class="text-xl font-medium text-white dark:text-navy-50 lg:text-2xl mt-2">
                        {{ Auth::user()->name }}</h1>
                    <h2 class="text-xs+ mt-1 text-slate-400">{{ Auth::user()->email }}</h2>
                 </div>
                </form>
                <div class="card car_pro mt-4 p-3">
                    <span class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100 mt-1 pb-5">Your
                        Balance</span>

                    <div class="pro_csm_grid">
                        <div class="flex items-center space-x-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red">
                                <i class="fa-solid fa-check-double"></i>
                            </div>
                            <div>
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    {{ $t_offer }}
                                </p>
                                <p class="mt-0.5 text-xs text-white line-clamp-1">
                                    Completed Offers
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div>
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                   {{ $t_earn+Auth::user()->points }}
                                </p>
                                <p class="mt-0.5 text-xs text-white line-clamp-1">
                                    Total Earnings
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                            <div>
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    {{ Auth::user()->total_referral }}
                                </p>
                                <p class="mt-0.5 text-xs text-white line-clamp-1">
                                    Users Referred
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                            <div>
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                   {{$t_redeem}}
                                </p>
                                <p class="mt-0.5 text-xs text-white line-clamp-1">
                                    Total Redeem
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red">
                                <i class="fa-solid fa-coins"></i>
                            </div>
                            <div>
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    {{ $tod_earn }}
                                </p>
                                <p class="mt-0.5 text-xs text-white line-clamp-1">
                                    Today Earn
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red">
                                <i class="fa-solid fa-coins"></i>
                            </div>
                            <div>
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    {{ Auth::user()->points }}
                                </p>
                                <p class="mt-0.5 text-xs text-white line-clamp-1">
                                    Balance
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-invite mt-4 font-medium">
                        <span class="font-medium text-slate-700 col-g line-clamp-1 dark:text-navy-100 mt-1 pb-1">Your
                            Referrals</span>

                        <div>
                            <span class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100 mt-1">For every new
                                member</span>
                            <span class="p-sp text-lg font-semibold tracking-wide mt-2">+ {{ env('REFER_BY') }} <img class="c_ic"
                                    src="{{ asset('images/app/app-coin.png') }}" alt="">
                                <span class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100 font-p">Refer
                                    coins</span></span>
                            <span class="p-sp text-lg font-semibold tracking-wide pb-3 mt-1"><i
                                    class="fa-solid fa-user-plus"></i> {{ Auth::user()->total_referral }}
                                <span class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100 font-p">Total
                                    Referrals</span>
                            </span>
                        </div>
                        <div class="p-share">
                            <a href="{{ route('refer_missons') }}" class="btn font-medium text-white bg-g-green">
                                <i class="fa-solid fa-user-plus mr-1"></i>
                                INVITE
                            </a>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="pro_log_btn mt-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
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
    </main>
    <script>
        const chooseFile = document.getElementById("choose-file");
        const imgPreview = document.getElementById("img-preview");
        function getImgData() {
          const files = chooseFile.files[0];
          if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function () {
              imgPreview.style.display = "block";
              imgPreview.src = this.result;
            });
          }
        }
        chooseFile.addEventListener("change", function () {
          getImgData();
          document.getElementById("up-pro").submit();
        });
    </script>
</x-header>
