       @if ($site_details->email_login == 1)
           <meta http-equiv="refresh" content="0; url=/">
       @endif

       <x-header>
           <!--<main class="grid w-full grow grid-cols-1 place-items-center">-->
           <main
               class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s] flex justify-center">
               <div class="w-full pt-4 mx-auto sm:px-5" style="max-width: 26rem; margin: auto 0;">

                   <div class="card mt-2 rounded-lg">

                       <div class="text-center mt-4">
                           <img class="mx-auto h-16 w-16 pop_img"
                               src="{{ $site_details->app_icon }}"
                               style="height:10rem !important;">
                           <div class="mt-4">
                               <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100 c_w">
                                   Welcome Back
                               </h2>
                               <p class="text-slate-400 dark:text-navy-300 c_w">
                                   Please sign in to continue
                               </p>
                           </div>
                       </div>

                       <div class="pop_bot bg-dark-light pa">

                           <x-auth-validation-errors class="mb-5" :errors="$errors" />

                           @if ($site_details->email_login == 0)
                               @error('throttle')
                                   <span class="text-tiny+ text-error">{{ $message }}</span>
                               @enderror
                               <form method="POST" action="{{ route('register') }}">
                                   @csrf
                                   <label class="relative flex">
                                       <input
                                           class="form-input ca_r peer w-full rounded-lg px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 focus:ring"
                                           placeholder="Name" type="text" id="name" name="name">
                                       <span
                                           class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400">
                                           <svg xmlns="http://www.w3.org/2000/svg"
                                               class="h-5 w-5 transition-colors duration-200" fill="none"
                                               viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                               <path stroke-linecap="round" stroke-linejoin="round"
                                                   d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                               </path>
                                           </svg>
                                       </span>
                                   </label>

                                   <label class="relative mt-4 flex">
                                       <input
                                           class="form-input ca_r peer w-full rounded-lg px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 focus:ring"
                                           placeholder="Email" type="email" id="email" name="email">
                                       <span
                                           class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400">
                                           <svg xmlns="http://www.w3.org/2000/svg"
                                               class="h-5 w-5 transition-colors duration-200" fill="none"
                                               viewBox="0 0 24 24" stroke="currentColor">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                   d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                               </path>
                                           </svg>
                                       </span>
                                   </label>

                                   <label class="relative mt-4 flex">
                                       <input
                                           class="form-input ca_r peer w-full rounded-lg px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 focus:ring"
                                           placeholder="Password" type="password" name="password" id="password"
                                           required autocomplete="new-password">
                                       <span
                                           class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400">
                                           <svg xmlns="http://www.w3.org/2000/svg"
                                               class="h-5 w-5 transition-colors duration-200" fill="none"
                                               viewBox="0 0 24 24" stroke="currentColor">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                   d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                               </path>
                                           </svg>
                                       </span>
                                   </label>

                                   <label class="relative mt-4 flex">
                                       <input
                                           class="form-input ca_r peer w-full rounded-lg px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 focus:ring"
                                           placeholder="Repeat Password" type="password" id="password_confirmation"
                                           name="password_confirmation" required>
                                       <span
                                           class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400">
                                           <svg xmlns="http://www.w3.org/2000/svg"
                                               class="h-5 w-5 transition-colors duration-200" fill="none"
                                               viewBox="0 0 24 24" stroke="currentColor">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                   d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                               </path>
                                           </svg>
                                       </span>
                                   </label>
                                   <div class="mt-4 flex items-center space-x-2">
                                       <input
                                           class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary
                            focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                           type="checkbox" required>
                                       <p class="line-clamp-1">
                                           I agree with
                                           <a href="{{ url('/page/privacy-policy') }}"
                                               class="text-slate-400 hover:underline dark:text-navy-300">
                                               privacy policy
                                           </a>
                                       </p>
                                   </div>

                                   <button class="btn_1 mt-10 h-10 w-full font-medium text-white">
                                       {{ __('Sign in') }}
                                   </button>
                                   <div class="mt-4 text-center text-xs+">
                                       <p class="line-clamp-1">
                                           <span>Already have an account?</span>

                                           <a class="text-slate-400 text-error" href="{{ route('login') }}">Sign in</a>
                                       </p>
                                   </div>
                               </form>

                               <div class="my-2 flex items-center space-x-3">
                                   <div class="h-px flex-1 li-tr"></div>
                                   <p class="text-tiny+ uppercase">or sign in with others</p>

                                   <div class="h-px flex-1 li-tr"></div>
                               </div>
                           @endif
                   
                           @if(env('GOOGLE_LOGIN')==true)
                           <div class="">
                           <a href="{{route('google.login')}}"
                           class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80"
                             >
                               <img class="h-5.5 w-5.5" src="{{ asset('images/app/google.svg') }}" alt="logo">
                               <span>Login with Google</span>
                           </a>
                           </div>
                           @endif

                       </div>
                   </div>

               </div>
           </main>
       </x-header>
