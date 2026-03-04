<x-admin-layout>

    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
      <div
        class="mt-8 grid grid-cols-1 gap-3 sm:mt-3 sm:gap-5 lg:mt-3 lg:gap-3"
      >
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
        
          <div class="flex items-center justify-between">
              <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
              User Tracker
              </h2>
                     <div class="flex">
                <div class="flex items-center" x-data="{isInputActive:false}">
                   <form action="" method="GET">
                    <div class="relative flex -space-x-px">
                        <input class="form-input peer w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        placeholder="User ID, Name, Email ..." type="text"
                        name="user"
                        @if(isset($_GET['user']))
                        value="{{$_GET['user']}}"
                        @else
                        value=""
                        @endif
                        required="">
                        <button class="btn rounded-l-none bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        type="submit"> Search </button>
                        @if(isset($_GET['user']))
                        <a href="{{route('admin.tracker')}}" style="margin-left:4px;"
                        class="btn h-9 w-14 p-0 font-medium text-error
                        hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                        </a>

                        @else

                        @endif
                      </div>
                    </form>
                </div>

              </div>
            </div>
        

        <div class="card">
          <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
            <table class="is-hoverable w-full text-left">
              <thead>
                <tr>
                  <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    #
                  </th>
                  <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Transaction Type
                     </th>
                  <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                   USER
                  </th>
                   <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                   Coin
                  </th>
                  <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Time
                   </th>
                  <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    Date
                   </th>
                   <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                    IP
                   </th>
                
                  
                </tr>
              </thead>
              <tbody>
                @php $count = 0; @endphp
                @foreach ($userdata as $user)
                @php $count++; @endphp
                @php
                $tmp = App\Models\User::find($user->user_id);
                @endphp
                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                  <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$count}}</td>

                     <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                      {{$user->transation}}
                     </td>
                      <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                      <a class="text-info font-bold" href="{{url('/admin/edit/user', $user->user_id)}}">{{$tmp->name}}</a>
                     </td>
                  <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    @if($user->type==0)
                    <p class="font-semibold text-error">-{{$user->points}}</p>
                    @else
                    <p class="font-semibold text-success">+{{$user->points}}</p>
                    @endif
                  </td>
                  <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                     {{timeago('@'.$user->time)}}
                   </td>
                  <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    {{date('F j, Y',$user->time)}}
                   </td>
                   <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                    {{$user->ip}}
                   </td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>


          <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
              {{$userdata->links()}}
          </div>
        </div>

      </div>
    </main>
</x-admin-layout>
