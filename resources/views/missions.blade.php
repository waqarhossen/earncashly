
<x-header>
  @inject('BasicController', 'App\Http\Controllers\BasicController')
    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]" >
      <div class="mt-3 col-12 container">
        <div class="col-span-12 sm:col-span-6 lg:col-span-8">
        <div class="mt-3 space-y-3.5">
           <!-- Missions Lists -->

         @if ($missionsoffer->count() > 0)
            <div class="flex items-center space-x-2" style="margin-top:20px; margin-bottom:-6px;">
            <img class="h-6 w-6" src="{{url('images/icons/web-mis.png')}}">
            <div style="margin-left: 3px;">
            <span>Complate</span>
            <span class="text-xs uppercase text-slate-400 dark:text-navy-300">
            Offer Missions
            </span>
            </div>
            </div>
         @endif

         <div class="mi-grid">
           {{$qcheck = "";}}
           @foreach ($missionsoffer as $moffer)
           @php $qcheck = $BasicController::offerwall_check($moffer->m_id,$moffer->max_play); @endphp
            <div class="card p-3 mi_card">
              <div class="mission-1">
              <div class="flex items-center space-x-3">
                <img
                  class="h-10 w-10 rounded-lg object-cover object-center"
                  src="{{url('images/icons/web-mis.png')}}"
                  alt="image"
                />
                <div class="flex-1">
                  <div class="flex justify-between">
                    <p class="font-medium text-slate-700 dark:text-navy-100">
                    {{ $moffer->m_title }}
                    </p>
                  </div>
                  <div class="mt-0.5 flex text-xs text-slate-400 dark:text-navy-300 line-clamp-1">
                     <p>{{ $moffer->m_title }}
                    <b class="text-xs text-red"> {{ $moffer->points }} Coins</b></p>
                  </div>
                </div>
              </div>
               <div class="-mt-3 text-right text-xs font-medium text-white">
                @if($qcheck==0)
                {{ Auth::user()->offer_play }}/{{ $moffer->max_play }}
                @elseif ($qcheck==1)
                <form method="POST" action="">
                @csrf
                <input type="hidden" name="token_read" value="{{Crypt::encryptString($moffer->m_id)}}"/>
                <input class="btn_2" type="submit" value="Collect"/>
                </form>
                @elseif ($qcheck==2)
                <button
                x-tooltip.placement.top.error="'Mission completed'"
                class="btn_2">
                <i class="fa-solid fa-check-double"></i>
                </button>
                @endif
                </div>
                </div>
                <p class="text-xs font-medium text-warning"></p>
               <div class="progress mt-2 h-1.5 bg-warning/15 dark:bg-warning/25">
              <progress value="{{ Auth::user()->offer_play }}" max="{{ $moffer->max_play }}" class="w-7/12 rounded-full bg-warning"></progress>
              </div>
            </div>
            @endforeach
          </div>

          </div>

        </div>

      </div>
    </main>

  </x-header>
