<x-admin-layout>

          <main class="main-content w-full px-[var(--margin-x)] pb-8">

            <div class="flex items-center space-x-4 py-8 lg:py-8">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                    Admin
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-white transition-colors">
                            Home</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li>Dashboard</li>
                </ul>
            </div>

            @if (session('status-alert'))
            <div class="alert flex rounded-lg bg-error px-4 py-4 text-white sm:px-5 sess_msg">
                {{ session('status-alert') }}
            </div>
            <br>
            @elseif (session('status-success'))
                <div class="alert flex rounded-lg bg-success px-4 py-4 text-white sm:px-5 sess_msg mb-3">
                    {{ session('status-success') }}
                </div>
                <br>
            @else
            @endif

            <div
              class="grid grid-cols-12 gap-4"
            >
              <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-8 lg:space-y-6">


                <div
                class="grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-5 lg:gap-6"
              >
                <div class="card px-5 pb-5">
                  <div>
                    <div class="ax-transparent-gridline mt-5 w-1/2">
                      <div
                        x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el,pages.charts.earningWhite); $el._x_chart.render() });"
                      ></div>
                    </div>
                    <p class="mt-3 text-base font-medium tracking-wide text-indigo-100">
                     User Earnings
                    </p>
                    <div class="flex gap-1 mt-4 font-inter text-2xl font-semibold">
                      <span class="text-indigo-100">$</span>
                      <span class="text-white">
                      {{round($user_points/$site_details->dollar_value,2)}}
                    </span>
                    <p class="text-xs+ line-clamp-1 mt-2.5"><i class="fa-solid fa-coins ml-1"></i> {{ number_format($user_points) }}</p>
                    </div>
                    <div class="badge mt-2 rounded-full bg-black/20 text-indigo-50">
                     {{$total_user}} Members
                    </div>
                  </div>
                  <div
                    class="absolute bottom-0 right-0 overflow-hidden rounded-lg"
                  >
                    <img
                      class="w-24 translate-x-1/4 translate-y-1/4 opacity-50"
                      src="{{ asset('images/illustrations/the-dollar.svg') }}"
                      alt="image"
                    />
                  </div>
                </div>
                <div
                  class="grid grid-cols-1 gap-4 sm:col-span-2 sm:grid-cols-2 sm:gap-5 lg:gap-6"
                >
                  <div class="card justify-center p-4.5">
                    <div class="flex items-center justify-between">
                      <div>
                        <p
                          class="text-base font-semibold text-slate-700 dark:text-navy-100"
                        >
                          {{$users_join_today}}
                        </p>
                        <p class="text-xs+ line-clamp-1">Today Join Users</p>
                      </div>
                      <div
                        class="mask is-star flex h-10 w-10 shrink-0 items-center justify-center bg-success"
                      >
                      <i class="fa-solid fa-user"></i>
                      </div>
                    </div>
                    <div>
                      <div
                        class="badge mt-2 space-x-1 bg-success/10 py-1 px-1.5 text-success dark:bg-success/15"
                      >
                        <span>0%</span>
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-3.5 w-3.5"
                          viewbox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </div>
                    </div>
                  </div>
                  <div class="card justify-center p-4.5">
                    <div class="flex items-center justify-between">
                      <div>
                        <p
                          class="text-base font-semibold text-slate-700 dark:text-navy-100"
                        >
                          {{$total_user}}
                        </p>
                        <p class="text-xs+ line-clamp-1">Total Users</p>
                      </div>
                      <div
                        class="mask is-star flex h-10 w-10 shrink-0 items-center justify-center bg-info"
                      >
                      <i class="fa-solid fa-users"></i>
                      </div>
                    </div>

                  </div>
                  <div class="card justify-center p-4.5">
                    <div class="flex items-center justify-between">
                      <div>
                        <p
                          class="text-base font-semibold text-slate-700 dark:text-navy-100"
                        >
                          {{$total_refferal}}
                        </p>
                        <p class="text-xs+ line-clamp-1">Referrals</p>
                      </div>
                      <div
                        class="mask is-star flex h-10 w-10 shrink-0 items-center justify-center bg-secondary"
                      >
                      <i class="fa-solid fa-user-plus"></i>
                      </div>
                    </div>

                  </div>
                  <div class="card justify-center p-4.5">
                    <div class="flex items-center justify-between">
                      <div>
                        <p
                          class="text-base font-semibold text-slate-700 dark:text-navy-100"
                        >
                          {{$total_withd}}
                        </p>
                        <p class="text-xs+ line-clamp-1">Withdrawals</p>
                      </div>
                      <div
                        class="mask is-star flex h-10 w-10 shrink-0 items-center justify-center bg-warning"
                      >
                      <i class="fa-solid fa-sack-dollar"></i>
                      </div>
                    </div>
                    <div>
                    <div class="badge mt-2 space-x-1 bg-warning/10 py-1 px-1.5 text-warning dark:bg-warning/15">
                     <span>{{$pending_withd}} Pending</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



              <div class="mt-4 sm:mt-5 lg:mt-6">
                <div class="flex items-center justify-between">
                  <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                    Top 10 Referrals Users
                  </h2>

                </div>
                <div class="card mt-3">
                  <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                    <table class="w-full text-left">
                      <thead>
                        <tr>
                          <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            User
                          </th>
                          <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Referrals
                          </th>
                          <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Withdrawals
                          </th>
                          <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Points
                          </th>

                          <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($top_ref_users as $ruser)
                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <div class="flex items-center space-x-4">
                              <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-primary/10 text-primary dark:bg-accent dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                              </div>
                              <div>
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    {{$ruser->name}}
                                </p>
                                <p class="mt-0.5 text-xs text-slate-400 dark:text-navy-300">
                                    {{$ruser->email}}
                                </p>
                              </div>
                            </div>
                          </td>

                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="font-medium text-slate-700 dark:text-navy-100">
                                <p class="font-semibold text-success">+{{$ruser->total_referral}}</p>
                            </p>
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        <div style="    display: flex;
                        align-items: center;
                        gap: 10px; ">
                        <div>
                        @php
                        $with_count = DB::select( DB::raw("SELECT user_id FROM redeem_requests WHERE txn_status = 0 AND user_id = '$ruser->id'") );
                        @endphp
                        <p class="font-semibold text-warning">{{count($with_count)}}</p>
                       </div>
                        @if (count($with_count) > 0)
                        <ol class="steps line-space [--size:.75rem] [--line:1px]">
                        <li class="step before:bg-slate-200 dark:before:bg-navy-500">
                        <div class="step-header rounded-full bg-success dark:bg-success-light" style="margin: 0;">
                        <span class="inline-flex h-full w-full animate-ping rounded-full bg-success opacity-80 dark:bg-secondary-light"></span>
                        </div>
                        </li>
                        </ol>
                        @else
                        <span style="background:#b3b3b3;height: 10px;width: 10px;border-radius: 99px;"></span>
                        @endif

                        </div>
                          </td>
                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="font-semibold text-success">{{$ruser->points}}</p>
                          </td>

                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <a href="{{url('/admin/referrals', $ruser->id)}}"
                                class="btn h-6 rounded bg-primary px-3 text-xs font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                >Check
                                </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              </div>
              <div class="col-span-12 lg:col-span-4">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-1 lg:gap-6">

                    <div class="card col-span-2 px-4 pb-5 sm:px-5">
                        <div class="my-3 flex h-8 items-center justify-between">
                            <h2
                                class="text-sm+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                                Statistic
                            </h2>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="mask is-squircle flex h-10 w-10 items-center justify-center bg-warning/10">
                                    <i class="fa-solid fa-history text-xl text-warning"></i>
                                </div>
                                <div class="grow space-y-1">
                                    <div class="flex justify-between">
                                        <p class="font-medium">Pending</p>
                                        <p class="text-warning">{{ $t_re }}%</p>
                                    </div>
                                    <div class="progress h-1.5 bg-slate-150 dark:bg-navy-500">
                                        <div class="rounded-full bg-warning" style="width:{{ $t_re }}%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div
                                    class="mask is-squircle flex h-10 w-10 items-center justify-center bg-primary/10 dark:bg-accent-light/10">
                                    <i class="fa-solid fa-spinner text-xl text-primary dark:text-accent-light"></i>
                                </div>
                                <div class="grow space-y-1">
                                    <div class="flex justify-between">
                                        <p class="font-medium">In Progress</p>
                                        <p class="text-primary dark:text-accent-light">{{ $t_apre }}%</p>
                                    </div>
                                    <div class="progress h-1.5 bg-slate-150 dark:bg-navy-500">
                                        <div class="rounded-full bg-primary dark:bg-accent" style="width:{{ $t_apre }}%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="mask is-squircle flex h-10 w-10 items-center justify-center bg-success/10">
                                    <i class="fa-regular fa-circle-check text-xl text-success"></i>
                                </div>
                                <div class="grow space-y-1">
                                    <div class="flex justify-between">
                                        <p class="font-medium">Completed</p>
                                        <p class="text-success">{{ $t_com }}%</p>
                                    </div>
                                    <div class="progress h-1.5 bg-slate-150 dark:bg-navy-500">
                                        <div class="rounded-full bg-success" style="width:{{ $t_com }}%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="mask is-squircle flex h-10 w-10 items-center justify-center bg-error/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-error" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="grow space-y-1">
                                    <div class="flex justify-between">
                                        <p class="font-medium">Cancelled</p>
                                        <p class="text-error">{{ $t_rej }}%</p>
                                    </div>
                                    <div class="progress h-1.5 bg-slate-150 dark:bg-navy-500">
                                        <div class="rounded-full bg-error" style="width:{{ $t_rej }}%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
              </div>

            </div>
          </main>
</x-admin-layout>
