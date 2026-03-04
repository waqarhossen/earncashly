

@if ($site_details->email_login == 1)
<meta http-equiv="refresh" content="0; url=/">
@endif
<x-header>
    <!--<main class="grid w-full grow grid-cols-1 place-items-center">-->
     <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s] flex justify-center">
    <div class="w-full pt-4 sm:px-5" style="max-width: 25rem; margin:auto 0;">

        <div class="card mt-2 rounded-lg">

            <div class="text-center mt-4">
              <img class="mx-auto h-16 w-16 pop_img" src="{{ $site_details->app_icon }}" style="height:10rem !important;">
              <div class="mt-4">
                <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100 c_w">
                    Forgot your password?
                </h2>
                <p class="text-sm text-slate-400 mt-2 m-3">
                    Enter your registered email below to receive your password reset link.
                </p>
              </div>
            </div>

            <div class="pop_bot bg-dark-light pa">

            <!-- Session Status -->
             <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            @if ($site_details->email_login == 0)
            @error('throttle')
            <span class="text-tiny+ text-error">{{ $message }}</span>
            @enderror
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <label class="relative mt-2 flex">
                    <input
                      class="form-input ca_r peer w-full rounded-lg px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 focus:ring"
                      placeholder="Email"
                      id="email" type="email" name="email" required
                    />
                    <span
                      class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transition-colors duration-200"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.5"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                      </svg>
                    </span>
                  </label>

                <button class="btn_1 mt-5 h-10 w-full font-medium text-white">
                    {{ __('Email Password Reset Link') }}
                  </button>
                  <div class="mt-4 text-center text-xs+">
                    <p class="line-clamp-1">
                      <span>Back to</span>

                      <a class="text-slate-400 text-error" href="{{ route('login') }}"> Sign In Page</a>
                    </p>
                  </div>
            </form>

            @endif



            </div>
        </div>

      </div>
    </main>
  </x-header>
