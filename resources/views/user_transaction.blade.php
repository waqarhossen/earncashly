<x-header>
    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]" >
        <div class="mt-3 col-12 container">
          <div class="col-span-12 sm:col-span-6 lg:col-span-8">

            <div style="margin-top: 15px;margin-bottom: 15px;" class="swiper" x-init="$nextTick(()=>$el._x_swiper= new Swiper($el,{  slidesPerView: 'auto', spaceBetween: 14,navigation:{nextEl:'.next-btn',prevEl:'.prev-btn'}}))" >
            <div class="flex items-center justify-between">
              <p class="text-base font-medium text-slate-700 dark:text-navy-100" >
                <i class="fa-solid fa-money-bills mr-1"></i>
               Transactions
              </p>
            </div>
          </div>

          <div x-data="{ activeTab: 'tabrew' }" class="tabs flex flex-col mt-5">
            <div class="is-scrollbar-hidden overflow-x-auto">
                <div class="border-b-2 border-slate-150 dark:border-navy-500">
                    <div class="tabs-list -mb-0.5 flex">

                        <button @click="activeTab = 'tabrew'"
                            :class="activeTab === 'tabrew' ?
                                'border-error text-red' :
                                'border-transparent focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                            class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium">
                            <i class="fa-solid fa-notes-medical"></i>
                            <span>Rewards</span>
                        </button>

                        <button @click="activeTab = 'tabtra'"
                            :class="activeTab === 'tabtra' ?
                                'border-error text-red' :
                                'border-transparent focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                            class="btn shrink-0 space-x-2 rounded-none border-b-2 px-3 py-2 font-medium">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            <span>Requests</span>
                        </button>

                    </div>
                </div>
            </div>
            <div class="tab-content pt-4">
                <div x-show="activeTab === 'tabrew'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                    <div>

                        <div class="card mt-3">
                            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                              <table class="w-full text-left">

                                <tbody>

                                @forelse ($user_transactions as $ut)
                                <tr class="border-y border-transparent border-b-slate-200">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5.5 w-5.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.5">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p
                                                    class="font-medium text-slate-700 dark:text-navy-100">
                                                    Transaction
                                                </p>
                                                <p class="mt-0.5 text-xs text-slate-400 dark:text-navy-300">
                                                    @if(!empty($ut->extra))
                                                    @php
                                                    $tmp = App\Models\User::find($ut->extra);
                                                    @endphp
                                                    @if(!empty($tmp->name))
                                                    From {{$tmp->name}}
                                                    @else
                                                    @if ($ut->type == 1)
                                                    Successfully Added
                                                    @else
                                                    Deducted Successfully
                                                    @endif
                                                    @endif
                                                    @else
                                                    @if ($ut->type == 1)
                                                    Successfully Added
                                                    @else
                                                    Deducted Successfully
                                                    @endif
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <p class="font-medium text-slate-700 dark:text-navy-100">
                                            {{ $ut->transation }}
                                        </p>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <p class="font-medium">
                                            {{ date('jS F Y', $ut->time) }}</p>

                                        <p class="mt-0.5 text-xs">
                                            {{timeago('@'.$ut->time)}}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        @if ($ut->type == 1)
                                            <p class="font-semibold text-success">
                                                +{{ $ut->points }}</p>
                                        @else
                                            <p class="font-semibold text-error">
                                                -{{ $ut->points }}</p>
                                        @endif
                                    </td>

                                  </tr>

                                  @empty
                                  <p class="px-4 py-3 sm:px-5 text-center">No transaction yet.</p>
                                @endforelse




                                </tbody>
                              </table>
                            </div>

                          </div>
                         <div class="mt-5">{{$user_transactions->links()}}</div>

                    </div>
                </div>
                <div x-show="activeTab === 'tabtra'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                    <div>

                        <div class="card mt-3">
                            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                <table class="w-full text-left">

                                    <tbody>
                                        @php $count = 0; @endphp
                                        @forelse ($requests_data as $data)
                                            @php $count++; @endphp
                                            <tr
                                                class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                                    </svg>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    <p class="font-medium">
                                                        {{ date('jS F Y', strtotime($data->date)) }}</p>

                                                    <p class="mt-0.5 text-xs">
                                                        {{ date('h:i A', strtotime($data->date)) }}</p>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="avatar h-9 w-9">
                                                            <img class="mask is-squircle"
                                                                src="{{ url('images/app/' . $data->image . '') }}"
                                                                alt="avatar">
                                                        </div>

                                                        <span
                                                            class="font-medium text-slate-700 dark:text-navy-100">{{ $data->title }}</span>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    <p class="w-20 overflow-hidden text-ellipsis text-xs+">
                                                        {{ $data->payment_address }}
                                                    </p>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    <p class="font-medium text-red dark:text-accent-light">
                                                        {{ $data->request_amount }}
                                                    </p>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    @if ($data->txn_status == 0)
                                                        <div
                                                            class="badge bg-warning/10 text-warning dark:bg-warning/15">
                                                            Pending
                                                        </div>
                                                    @elseif ($data->txn_status == 1)
                                                        <div
                                                            class="badge bg-primary/10 text-primary dark:bg-accent-light/15 dark:text-accent-light">
                                                            Approved
                                                        </div>
                                                    @elseif ($data->txn_status == 2)
                                                        <div class="badge bg-error/10 text-error dark:bg-error/15"
                                                            @if (!$data->reason == null) x-tooltip.on.mouseenter="'{{ $data->reason }}'" @endif>
                                                            Cancelled&nbsp;@if (!$data->reason == null)
                                                                <i class="fa-solid fa-circle-info"></i>
                                                            @endif
                                                        </div>
                                                    @elseif ($data->txn_status == 3)
                                                        <div
                                                            class="badge bg-info/10 text-info dark:bg-info/15">
                                                            Returned
                                                        </div>
                                                    @elseif ($data->txn_status == 4)
                                                        <div
                                                            class="badge bg-success/10 text-success dark:bg-success/15">
                                                            Completed
                                                        </div>
                                                    @else
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr
                                                class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    No Requests Yet.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        </div>
    </div>
    </main>
</x-header>
