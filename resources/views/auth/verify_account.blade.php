@if ($site_details->email_login == 1)
<meta http-equiv="refresh" content="0; url=/">
@endif
<x-header>
     
     <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s] flex justify-center">
    <div class="w-full pt-10 sm:px-5" style="max-width: 26rem; margin: auto 0;">

        <div class="card mt-2 rounded-lg">

            <div class="text-center mt-4">
              <div class="mt-4">
                <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100 c_w">
                    Verify Account
                </h2>
                <p class="text-slate-400 dark:text-navy-300 c_w mt-3 p-2">
                    we have send a verification code, please verify your email address.
                </p>
              </div>
            </div>

            <div class="pop_bot bg-dark-light pa">

            <!-- Session Status -->
             <x-auth-session-status class="mb-4" :status="session('status')"/>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            
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

            @if ($site_details->email_login == 0)
            @error('throttle')
            <span class="text-tiny+ text-error">{{ $message }}</span>
            @enderror
            <form method="POST" action="{{ route('code_verify') }}">
                @csrf
                <label class="relative mt-2 flex">
                    <input
                      class="form-input ca_r peer w-full rounded-lg px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 focus:ring"
                      placeholder="Verification Code"
                      id="v_code" type="text" name="v_code" required
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
                    {{ __('verify') }}
                  </button>
                  <div class="mt-4 text-center text-xs+">
                    <p class="line-clamp-1">
                      <span>Didn't receive a code?</span>

                      <a class="text-slate-400 text-error" href="{{ route('verify_code_resend') }}"> Resend it</a>
                    </p>
                  </div>
            </form>

            @endif



            </div>
        </div>

      </div>
    </main>
  </x-header>
