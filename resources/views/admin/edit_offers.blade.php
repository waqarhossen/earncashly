<x-admin-layout>

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-1 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div class="col-span-12 lg:col-span-8">
                @if (session('status-alert'))
                    <div class="alert flex rounded-lg bg-error px-4 py-4 text-white sm:px-5 sess_msg">
                        {{ session('status-alert') }}
                    </div>
                @elseif (session('status-success'))
                    <div class="alert flex rounded-lg bg-success px-4 py-4 text-white sm:px-5 mb-3 sess_msg">
                        {{ session('status-success') }}
                    </div>
                @else
                @endif
                <div class="card">
                    <div
                        class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                            Edit Offers
                        </h2>
                        <div class="flex justify-center space-x-2">
                            <a href="{{ url('/admin/offers') }}"
                                class="btn min-w-[7rem] rounded-lg border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                Back
                            </a>
                            <button
                                class="btn min-w-[7rem] rounded-lg bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                form="myform" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5">
                        <div class="flex flex-col">
                            <div class="avatar h-24 w-24">
                                <img class="rounded-lg" src="{{ $offerwalls_data->image }}" alt="avatar"
                                    style="background: {{ $offerwalls_data->color }};" />
                            </div>
                        </div>
                        <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                        <form method="POST" action="" id="myform" enctype="multipart/form-data">
                            @csrf
                            @METHOD('PUT')
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <label class="block">
                                    <span>Title </span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="Title" type="text" name="title"
                                            value="{{ $offerwalls_data->title }}" required>
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-solid fa-pen"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span>Image Url</span>
                                    <span class="relative mt-1.5 flex">
                                        <input
                                            class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="" type="text" name="image"
                                            value="{{ $offerwalls_data->image }}" required>
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-solid fa-pen"></i>
                                        </span>
                                    </span>
                                </label>
                                <label class="block">
                                    <span>Color</span>
                                    <span class="relative mt-1.5 flex" style="gap:6px;align-items:center;">

                                        <input type="color" name="color" id="colorpicker"
                                            value="{{ $offerwalls_data->color }}" class="w-full"
                                            style="background:{{ $offerwalls_data->color }};padding: 6px;border-radius: 5px;"
                                            required>

                                    </span>
                                </label>

                                <label class="block">
                                    <span>Type</span>
                                    <select name="type"
                                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                        @if ($offerwalls_data->type == 1)
                                        <option value="1">Survey</option>
                                        <option value="0">Offerwall</option>
                                        @else
                                        <option value="0">Offerwall</option>
                                        <option value="1">Survey</option>
                                        @endif
                                    </select>
                                </label>

                                <label class="block">
                                    <span>Ratings</span>
                                    <select name="rate"
                                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                        @if ($offerwalls_data->rate == '1')
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                        @elseif($offerwalls_data->rate == '2')
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                        <option value="1">1 Star</option>
                                        @elseif($offerwalls_data->rate == '3')
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        @elseif($offerwalls_data->rate == '4')
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        @elseif($offerwalls_data->rate == '5')
                                        <option value="5">5 Star</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        @else
                                        @endif
                                    </select>
                                </label>

                                <label class="block">
                                    <span>Discount (%)</span>
                                    <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                                            hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="+0%" type="text" name="offer_dis"
                                            value="{{ $offerwalls_data->offer ?? '+0%' }}" required>
                                        <span
                                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                            <i class="fa-solid fa-percent"></i>
                                        </span>
                                    </span>
                                </label>

                            </div>

                        
                        <div>
                        </div>
                    </div>
                </div>
                
            @if($offerwalls_data->id_name == "adget")
             <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>Wall Code</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="wall_code" value="{{ env('ADGET_WALL_CODE'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
          @elseif($offerwalls_data->id_name == "adgem")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>App ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="app_id" value="{{ env('ADGEM_APPID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
          @elseif($offerwalls_data->id_name == "offertoro")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>App ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="app_id" value="{{ env('TOROX_APP_ID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Pub ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="pub_id" value="{{ env('TOROX_PUB_ID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Secret key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="sec_key" value="{{ env('TOROX_SECRET_KEY'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
           @elseif($offerwalls_data->id_name == "mmwall")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>Publisher ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="pub_id" value="{{ env('MM_PUBID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
         @elseif($offerwalls_data->id_name == "cpx-research")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>App ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="app_id" value="{{ env('CPX_APPID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>CPX Secure hash</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="s_hash" value="{{ env('CPX_SECURE_HASH'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
           @elseif($offerwalls_data->id_name == "bitlabs")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>Token</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="token" value="{{ env('BITLABS_TOKEN'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Secret key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="sec_key" value="{{ env('BITLABS_SECRET_KEY'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div> 
          @elseif($offerwalls_data->id_name == "inbrain")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>Callback Secret</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="callback_secret" value="{{ env('INBRAIN_CALLBACK_SECRET'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Params</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="params" value="{{ env('INBRAIN_PARAMS'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
          @elseif($offerwalls_data->id_name == "ayet")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>Ad Slot ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="ad_slot" value="{{ env('AYET_ADSLOTID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Api Key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="api_key" value="{{ env('AYET_API_KEY'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
           @elseif($offerwalls_data->id_name == "cpa-lead")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>Direct Link</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="link_id" value="{{ env('CPALEAD_ID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
          @elseif($offerwalls_data->id_name == "wannads")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             <label class="block">
                <span>Api Key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="api_key" value="{{ env('WANNADS_APIKEY'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Secret</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="secret" value="{{ env('WANNADS_SECRET'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
          @elseif($offerwalls_data->id_name == "monlix")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             <label class="block">
                <span>App ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="app_id" value="{{ env('MONLIX_APPID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Secret Key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="secret_key" value="{{ env('MONLIX_SECRET_KEY'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
         @elseif($offerwalls_data->id_name == "lootably")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             <label class="block">
                <span>Placement ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="placement" value="{{ env('LOOTABLY_PLACEMENTID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Secret</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="secret" value="{{ env('LOOTABLY_SECRET'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
        @elseif($offerwalls_data->id_name == "revlum")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             <label class="block">
                <span>Api Key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="api_key" value="{{ env('REVLUM_APIKEY'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>      
             <label class="block">
                <span>Secret Key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="secret_key" value="{{ env('REVLUM_SECRET_KEY'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
          @elseif($offerwalls_data->id_name == "notik")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
             <label class="block">
                <span>Secret Key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="secret_key" value="{{ env('NOTIK_SECRET'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Api Key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="api_key" value="{{ env('NOTIK_API_KEY'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>App ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="app_id" value="{{ env('NOTIK_APP_ID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
             <label class="block">
                <span>Pub ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="pub_id" value="{{ env('NOTIK_PUB_ID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
          @elseif($offerwalls_data->id_name == "admantum")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>App ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="app_id" value="{{ env('ADMANTUM_APP_ID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>      
             <label class="block">
                <span>Secret Key</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="secret_key" value="{{ env('ADMANTUM_SECRET'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
         @elseif($offerwalls_data->id_name == "adscend")
          <div class="card mt-5">
             <div class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
              <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                {{ $offerwalls_data->title }} configuration
              </h2>
            </div>
            <div class="p-4 sm:p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <label class="block">
                <span>Publisher ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="pub_id" value="{{ env('ADSCEND_PUB_ID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>      
             <label class="block">
                <span>OfferWall ID</span>
                <span class="relative mt-1.5 flex">
                <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70
                hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="text" name="wall_id" value="{{ env('ADSCEND_WAll_ID'); }}" required="">
                <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                  <i class="fa-solid fa-wrench"></i>
                </span>
                </span>
             </label>
            </div>
            </div>
          </div>
          @else
          
          @endif
          
          </form>
                
            </div>
        </div>

    </main>
</x-admin-layout>
