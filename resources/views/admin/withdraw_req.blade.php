<x-admin-layout>

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
              Admin
            </h2>
            <div class="hidden h-full py-1 sm:flex">
              <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
              <li class="flex items-center space-x-2">
                <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="{{ route('admin.dashboard');}}">
                Home</a>
                <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </li>
              <li>Withdrawals</li>
            </ul>
          </div>

          @if(session('status-alert'))
          <div class="alert flex rounded-lg bg-error px-4 py-4 text-white sm:px-5 sess_msg">
          {{ session('status-alert') }}
          </div>
          @elseif (session('status-success'))
          <div class="alert flex rounded-lg bg-success px-4 py-4 text-white sm:px-5 mb-3 sess_msg">
            {{ session('status-success') }}
          </div>
          @else

          @endif

          <div>


            <div class="col-span-12">

              <div>

                <div x-data="{isFilterExpanded:false}">
                  <div class="flex items-center justify-between">
                    <h2
                      class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                    >
                    Withdrawal Requests
                    </h2>
                    <div class="flex">
                      <div class="flex items-center" x-data="{isInputActive:false}">
                        <label class="block">
                          <form action="" method="GET">
                          <input
                            x-effect="isInputActive === true && $nextTick(() => { $el.focus()});"
                            :class="isInputActive ? 'w-32 lg:w-48' : 'w-0'"
                            class="form-input bg-transparent px-1 text-right transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
                            placeholder="Search Requests..."
                            type="text"
                            name="user"
                            @if(isset($_GET['user']))
                            value="{{$_GET['user']}}"
                            @else
                            value=""
                            @endif
                          />
                        </form>
                        </label>
                        <button
                          @click="isInputActive = !isInputActive"
                          class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4.5 w-4.5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.5"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                          </svg>
                        </button>
                      </div>

                      <button
                        @click="isFilterExpanded = !isFilterExpanded"
                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-4.5 w-4.5"
                          fill="none"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M18 11.5H6M21 4H3m6 15h6"
                          />
                        </svg>
                      </button>
                    </div>
                  </div>
                  <div x-show="isFilterExpanded" x-collapse>
                    <div class="max-w-2xl py-3">
                      <form action="" method="GET">
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">

                        <label class="block">

                          <select name="status"
                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                          >
                            @if(isset($_GET['status']))
                            <option value="{{$_GET['status']}}">
                            @if ($_GET['status'] == "0")
                            Pending
                            @elseif ($_GET['status'] == "1")
                            Approved
                            @elseif ($_GET['status'] == "2")
                            Cancelled
                            @elseif ($_GET['status'] == "3")
                            Returned
                            @elseif ($_GET['status'] == "4")
                            Completed
                            @else
                            @endif
                            </option>
                            @else
                            @endif
                            <option>--------</option>
                            <option value="0">Pending</option>
                            <option value="1">Approved</option>
                            <option value="2">Cancelled</option>
                            <option value="3">Returned</option>
                            <option value="4">Completed</option>
                          </select>
                        </label>

                      <div class=" flex mt-2 space-x-1 text-right">
                        <button type="button"
                          @click="isFilterExpanded = ! isFilterExpanded"
                          class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                        >
                          Cancel
                        </button>

                        <button type="submit"
                          class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        >
                          Apply
                        </button>
                        <a href="{{route('admin.with_reqs')}}"
                          class="btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90"
                        >
                          Reset
                      </a>
                      </div>
                     </div>
                    </form>

                    </div>
                  </div>

                <div class="card mt-3">
                  <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                    <table class="is-hoverable w-full text-left">
                      <thead>
                        <tr>
                          <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            #
                          </th>
                          <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            User
                          </th>
                          <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Date
                          </th>
                          <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Method
                          </th>

                          <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Status
                          </th>

                          <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Ammount
                          </th>

                          <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $count = 0; @endphp
                        @foreach ($withdrawals as $data)
                        @php $count++; @endphp
                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="font-medium text-primary dark:text-accent-light">
                             {{$count}}
                            </p>
                          </td>


                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="w-30 overflow-hidden text-ellipsis text-xs+">
                                {{$data->name}}
                            </p>
                          </td>

                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="font-medium">{{date('jS F Y', strtotime($data->date))}} </p>
                            <p class="mt-0.5 text-xs">{{date('h:i A', strtotime($data->date))}}</p>
                          </td>

                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <div class="flex items-center space-x-4">
                              <div class="avatar h-9 w-9">
                                <img class="mask is-squircle" src="{{ $data->image }}" alt="avatar">
                              </div>

                              <span class="font-medium text-slate-700 dark:text-navy-100">{{$data->title}}
                              </span>
                            </div>
                          </td>

                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            @if($data->txn_status==0)
                            <div class="badge bg-warning/10 text-warning dark:bg-warning/15">
                            Pending
                            </div>
                            @elseif ($data->txn_status==1)
                            <div class="badge bg-primary/10 text-primary dark:bg-accent-light/15 dark:text-accent-light">
                            Approved
                            </div>
                            @elseif ($data->txn_status==2)
                            <div class="badge bg-error/10 text-error dark:bg-error/15">
                            Cancelled
                            </div>
                            @elseif ($data->txn_status==3)
                            <div class="badge bg-info/10 text-info dark:bg-info/15">
                            Returned
                            </div>
                            @elseif ($data->txn_status==4)
                            <div class="badge bg-success/10 text-success dark:bg-success/15">
                            Completed
                            </div>
                            @else
                            @endif
                            </td>

                           <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <p class="text-sm+ font-medium text-slate-700 dark:text-navy-100">
                            {{$data->request_amount}}
                            </p>
                          </td>
                          <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                          <a href="{{url('/admin/withdrawal/request-view', $data->id)}}"
                          class="btn h-8 rounded-md bg-primary px-4 text-xs+
                          font-medium text-white hover:bg-primary-focus focus:bg-primary-focus
                          active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus
                          dark:focus:bg-accent-focus dark:active:bg-accent/90">
                          View
                          </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">

                    {{$withdrawals->links()}}

                  </div>
                </div>
                </div>


              </div>

          </div>
    </main>
</x-admin-layout>
