
<x-header>

    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]" >
      <div class="mt-3 col-12 container" style="max-width: 500px;">
        <div class="col-span-12 sm:col-span-6 lg:col-span-8">

          <div class="mt-5">
          <div class="flex items-center justify-between">
            <p class="text-base font-medium text-slate-700 dark:text-navy-100" >
            <i class="fa-solid fa-trophy"></i>
            CashOut
            </p>
          </div>
        </div>

        @if(session('status-alert'))
        <div class="alert flex rounded-lg bg-error px-4 py-4 text-white sm:px-5 sess_msg mt-3">
        {{ session('status-alert') }}
        </div>
        @elseif (session('status-success'))
        <div class="alert flex rounded-lg bg-success px-4 py-4 text-white sm:px-5 mb-3 sess_msg mt-3">
          {{ session('status-success') }}
        </div>
        @else

        @endif

        <div class="card w-full p-4 mt-4">

          <div class="flex items-center justify-center py-4">
            <p class="text-xl font-semibold text-white">{{$redeem_data->title}} Cashout</p>
            </div>
            <form action="" class="mt-1" method="POST">
            @csrf
            <div class="space-y-4">
              <label class="block">
                <span>Points</span>
                <input
                  class="ca_r mt-1.5 w-full rounded-lg px-3 py-2"
                  type="text"
                  name="name"
                  value="{{ $redeem_data->points }}"
                  disabled
                />
              </label>

                <label class="block">
                <span>Enter Reward details:<span
                x-tooltip.on.mouseenter="'Make sure you put you working details'">
                <i class="fa-solid fa-circle-info ml-1 text-red"></i>
                </span>
                </span>
                <input
                  class="ca_r mt-1.5 w-full rounded-lg px-3 py-2"
                  placeholder="Enter your {{$redeem_data->title}} address"
                  type="text"
                  name="reward_details"
                  required
                />
              </label>

               <div class="">
                <button class="btn w-full mt-3 bg-red btn_1 font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                >Send Request</button>
              </div>
            </div>
        </form>
       </div>


        </div>

      </div>
    </main>

  </x-header>
