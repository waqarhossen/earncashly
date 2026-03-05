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
                <a class="text-white transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="{{ route('admin.dashboard');}}">
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


            <div class="card mt-2 p-4 sm:p-5">
                <div class="flex flex-col"
                style="display:flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;">
                <a href="{{route('admin.with_reqs')}}" style="rotate:-133deg;" class="btn h-8 w-8 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </a>
                <h3 class=" text-lg font-medium text-slate-700 dark:text-navy-100">
                 Withdrawal Detail
                </h3>
                </div>
                <div class="my-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                <div class="space-y-2 font-inter">
                  <div class="flex justify-between text-slate-800 dark:text-navy-100">
                    <p>Name:</p>
                    <p class="font-medium tracking-wide">{{$withdrawal_data->name}}</p>
                  </div>
                  <div class="flex justify-between text-slate-800 dark:text-navy-100">
                    <p>Withdrawal Ammount:</p>
                    <p class="font-medium tracking-wide">{{$withdrawal_data->request_amount}}</p>
                  </div>

                  <div class="flex justify-between text-slate-800 dark:text-navy-100">
                    <p>Date:</p>
                    <p class="font-medium tracking-wide">{{$withdrawal_data->date}}</p>
                  </div>

                  <div class="flex justify-between text-slate-800 dark:text-navy-100">
                    <p>Point Used:</p>
                    <p class="font-medium tracking-wide">{{$withdrawal_data->points_used}}</p>
                  </div>

                  <div class="my-4 h-px bg-slate-200 dark:bg-navy-500"></div>

                  <div class="flex justify-between text-slate-800 dark:text-navy-100">
                   <p>Current Status:</p>
                    @if($withdrawal_data->txn_status==0)
                    <div class="badge bg-warning/10 text-warning dark:bg-warning/15">
                    Pending
                    </div>
                    @elseif ($withdrawal_data->txn_status==1)
                    <div class="badge bg-primary/10 text-primary dark:bg-accent-light/15 dark:text-accent-light">
                    Approved
                    </div>
                    @elseif ($withdrawal_data->txn_status==2)
                    <div class="badge bg-error/10 text-error dark:bg-error/15">
                    Cancelled
                    </div>
                    @elseif ($withdrawal_data->txn_status==3)
                    <div class="badge bg-info/10 text-info dark:bg-info/15">
                    Returned
                    </div>
                    @elseif ($withdrawal_data->txn_status==4)
                    <div class="badge bg-success/10 text-success dark:bg-success/15">
                    Completed
                    </div>
                    @else
                    @endif
                  </div>

                  <div class="flex justify-between text-slate-800 dark:text-navy-100">
                    <p>Withdrawal Mehod:</p>

                    <div class="font-medium tracking-wide" style="display: flex; flex-direction: column; align-items: flex-end; margin-top:5px;">
                    <span class="font-medium">{{$withdrawal_data->title}}</span>
                    <span class="mt-0.5 text-xs">{{$withdrawal_data->payment_address}}</span>
                    <div>
                    <div x-data="{text:'{{$withdrawal_data->payment_address}}'}">
                    <div class="flex -space-x-px mt-1">
                    <button
                    @click="$clipboard({
                    content:text,
                    success:()=>$notification({text:'Address Copied',variant:'success'}),
                    error:()=>$notification({text:'Error',variant:'error'})
                    })" class="btn h-6 rounded bg-primary px-3 text-xs font-medium text-white
                    hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90
                    dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus
                    dark:active:bg-accent/90">Copy Address</button>
                    <input size="15"
                    x-model="text"
                    type="hidden"
                    disabled />
                    </div>
                    </div>
                    </div>

                    </div>
                  </div>

                </div>
                <div class="my-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                <form method="POST" action="">
                @csrf
                @METHOD('PUT')
                <div class="inline-space mt-5 flex flex-wrap" style="justify-content: center;">
                    <button name="status" value="1" class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                     Approve
                    </button>
                    <button name="status" value="4" class="btn bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
                     Complete
                    </button>
                    <button name="status" value="3" class="btn bg-warning font-medium text-white hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90">
                     Return
                    </button>
                  <a href="{{url('/admin/tracker',$withdrawal_data->user_id)}}"
                    class="btn bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus
                    active:bg-info-focus/90">
                   Track Activity
                  </a>
                  </div>

                <label class="block">
                <textarea
                 name="reason"
                  rows="4"
                  placeholder=" Enter Reason if you cancel this request"
                  class="form-textarea w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                >{{$withdrawal_data->reason}}</textarea>
              </label>

                  <button name="status" value="2"
                  class="btn border border-error font-medium text-error hover:bg-error hover:text-white
                  focus:bg-error focus:text-white active:bg-error/90" style="width:100%;">
                    Cancel Request
                  </button>
                </form>
              </div>

          </div>
    </main>
</x-admin-layout>
