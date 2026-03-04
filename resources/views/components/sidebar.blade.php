<div class="hidden sm:col-span-6 sm:block lg:col-span-4">

      <div class="card col-span-2 px-4 pb-3 sm:px-5" style="border-radius:20px;">
        <div class="flex items-center justify-between py-3">
          <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
            Trending Games
          </h2>
          <div class="inline-flex">
          <i class="fa-solid fa-share"></i>
          </div>
        </div>
         @php $count = 0; @endphp
          @foreach ($topGames as $topGame)
          @php $count++; @endphp
           <a href="{{url('/g',$topGame->slug)}}" class="flex items-center justify-between games mb-1">
            <div class="flex items-center gap-1">
              <div class="avatar h-16 w-16">
                <img
                  class="mask is-squircle"
                  src="{{$topGame->image}}"
                  alt="{{$topGame->title}}"
                />
              </div>
              <div>
                <h1 class="font-medium">{{$topGame->title}}</h1>
                <span class="mt-0.5 text-xs"><i class="fa-solid fa-eye text-primary"></i> {{$topGame->views}} Plays</span>
              </div>
              </div>
              <div>
               <span class="text-primary font-medium text-slate-700">#{{ $count}}</span>
              <i class="fa-solid fa-chevron-right mt10"></i>
            </div>
            </a>
          @endforeach

      </div>

  </div>


