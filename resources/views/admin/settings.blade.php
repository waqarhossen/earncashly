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
                    <a class="text-white transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('admin.dashboard') }}">
                        Home</a>
                    <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Settings</li>
            </ul>
        </div>

        @if (session('status'))
            <div class="alert flex rounded-lg bg-success px-4 py-4 text-white sm:px-5">
                {{ session('status') }}
            </div>
            <br>
        @endif

        @if ($errors->any())
            <div class="space-y-4 mt-5">
                <div x-data="{ isShow: true }" :class="!isShow && 'opacity-0 transition-opacity duration-300'"
                    class="alert flex items-center justify-between overflow-hidden rounded-lg border border-error bg-error text-info">
                    <div class="flex">
                        <div class="bg-error p-3 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewbox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="px-4 pl-0 py-3 sm:px-5 text-white">{{ $errors->first() }}</div>
                    </div>
                    <div class="px-2">
                        <button @click="isShow = false; setTimeout(()=>$root.remove(),300)"
                            class="btn h-7 w-7 rounded-full p-0 font-medium text-white hover:bg-white/20 focus:bg-white/20 active:bg-white/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewbox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="mt-5"></div>
        @endif

        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 lg:col-span-4">
                <div class="card p-4 sm:p-5">
                    <div class="flex items-center space-x-4">
                        <div class="avatar size-14">
                            <img class="rounded-full" src="{{ $admin_data->profile ?? '/images/icons/200x200.svg' }}"
                                alt="avatar" />
                        </div>
                        <div>
                            <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                                {{ $admin_data->name }}
                            </h3>
                            <p class="text-xs+ text-slate-400">{{ $admin_data->email }}</p>
                        </div>
                    </div>
                    <ul class="mt-6 space-y-1.5 font-inter font-medium">
                        <li>
                            <a id="tab-general"
                                class="tab-link flex items-center space-x-2 rounded-lg bg-red px-4 py-2.5 tracking-wide text-white outline-none transition-all hover:bg-slate-100 hover:text-slate-800"
                                href="#">
                                <i class="fa-solid fa-gear"></i>
                                <span>General</span>
                            </a>
                        </li>
                        <li>
                            <a id="tab-configuration"
                                class="tab-link flex items-center space-x-2 rounded-lg px-4 py-2.5 tracking-wide text-white outline-none transition-all hover:bg-slate-100 hover:text-slate-800"
                                href="#">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                <span>Configuration</span>
                            </a>
                        </li>
                        <li>
                            <a id="tab-financial"
                                class="tab-link flex items-center space-x-2 rounded-lg px-4 py-2.5 tracking-wide text-white outline-none transition-all hover:bg-slate-100 hover:text-slate-800"
                                href="#">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <span>Financial</span>
                            </a>
                        </li>
                        <li>
                            <a id="tab-smtp"
                                class="tab-link flex items-center space-x-2 rounded-lg px-4 py-2.5 tracking-wide text-white outline-none transition-all hover:bg-slate-100 hover:text-slate-800"
                                href="#">
                                <i class="fa-solid fa-envelope"></i>
                                <span>SMTP</span>
                            </a>
                        </li>
                        <li>
                            <a id="tab-socials"
                                class="tab-link flex items-center space-x-2 rounded-lg px-4 py-2.5 tracking-wide text-white outline-none transition-all hover:bg-slate-100 hover:text-slate-800"
                                href="#">
                                <i class="fa-solid fa-user-group"></i>
                                <span>Socials</span>
                            </a>
                        </li>
                        <li>
                            <a id="tab-account"
                                class="tab-link flex items-center space-x-2 rounded-lg px-4 py-2.5 tracking-wide text-white outline-none transition-all hover:bg-slate-100 hover:text-slate-800"
                                href="#">
                                <i class="fa-regular fa-circle-user"></i>
                                <span>Account</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <!-- General Settings Layout -->
                <div class="tab-content" id="content-general" style="display: block;">
                    <div class="card">
                        <div
                            class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                            <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">General
                                Settings</h2>
                        </div>
                        <div class="p-4 sm:p-5">
                            <form method="POST" action="{{ route('admin.update_settings') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="space-y-5">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <label class="block">
                                            <span class="text-slate-200">Site Name <span
                                                    class="text-error">*</span></span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="text" name="seo_title" value="{{ $settings->site_name }}">
                                        </label>

                                        <label class="block">
                                            <span class="text-slate-200">Site Tagline <span
                                                    class="text-error">*</span></span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="text" name="short_title"
                                                value="{{ $settings->short_title }}">
                                        </label>

                                        <label class="block">
                                            <span>Contact Email <span class="text-error">*</span></span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="email" name="c_email" value="{{ $settings->contact_email }}">
                                        </label>

                                        <label class="block">
                                            <span class="text-slate-200">Site URL <span
                                                    class="text-error">*</span></span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="text" name="site_url" value="{{ $settings->site_url }}">
                                        </label>
                                    </div>

                                    <label class="block">
                                        <span>Tags</span>
                                        <input class="mt-1.5 w-full" x-init="$el._tom = new Tom($el, {
                                            plugins: ['remove_button'],
                                            create: true,
                                            onItemRemove: function(val) {
                                                $notification({ text: `${val} removed` })
                                            }
                                        })"
                                            placeholder="Site Keywords" type="text" name="seo_keywords"
                                            value="{{ $settings->site_keywords }}" />
                                    </label>

                                    <label class="block">
                                        <span>Site Description</span>
                                        <textarea rows="4" placeholder=" site description" name="seo_desc"
                                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            style="height:65px;">{{ $settings->site_desc }}</textarea>
                                    </label>

                                    <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                        <div class="w-full px-3 sm:w-1/2">
                                            <div class="py-2">
                                                <label class="block">
                                                    <span>Site Logo</span>
                                                    <div class="csm-new-upload-box" data-upload-box="1">
                                                        <input type="file" class="csm-new-file-input"
                                                            data-input="1" accept="image/jpeg, image/jpg, image/png"
                                                            name="logo">
                                                        <div class="csm-new-box-content" data-box="1"
                                                            onclick="triggerFileInput(1);">
                                                            <div class="csm-new-image-preview" data-preview="1"
                                                                style="background-image:url('{{ $settings->site_logo }}')">
                                                            </div>
                                                            <button type="button"
                                                                class="btn h-6 rounded bg-red px-3 text-xs font-medium text-white">Upload</button>
                                                            <p class="csm-new-supported-text">Supported (JPEG, JPG,
                                                                PNG)
                                                                Recommended Size:
                                                                200x50px.</p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="w-full px-3 sm:w-1/2">
                                            <div class="py-2">
                                                <label class="block">
                                                    <span>Site Favicon</span>
                                                    <div class="csm-new-upload-box" data-upload-box="2">
                                                        <input type="file" class="csm-new-file-input"
                                                            data-input="2" accept="image/jpeg, image/jpg, image/png"
                                                            name="favicon">
                                                        <div class="csm-new-box-content" data-box="2"
                                                            onclick="triggerFileInput(2);">
                                                            <div class="csm-new-image-preview" data-preview="2"
                                                                style="background-image:url('{{ $settings->fav_icon }}')">
                                                            </div>
                                                            <button type="button"
                                                                class="btn h-6 rounded bg-red px-3 text-xs font-medium text-white">Upload</button>
                                                            <p class="csm-new-supported-text">Supported (JPEG, JPG,
                                                                PNG)
                                                                Recommended Size:
                                                                96x96px.</p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="w-full px-3 sm:w-1/2">
                                            <div class="py-2">
                                                <label class="block">
                                                    <span>Site Icon</span>
                                                    <div class="csm-new-upload-box" data-upload-box="2">
                                                        <input type="file" class="csm-new-file-input"
                                                            data-input="3" accept="image/jpeg, image/jpg, image/png"
                                                            name="app_icon">
                                                        <div class="csm-new-box-content" data-box="3"
                                                            onclick="triggerFileInput(3);">
                                                            <div class="csm-new-image-preview" data-preview="3"
                                                                style="background-image:url('{{ $settings->app_icon }}')">
                                                            </div>
                                                            <button type="button"
                                                                class="btn h-6 rounded bg-red px-3 text-xs font-medium text-white">Upload</button>
                                                            <p class="csm-new-supported-text">Supported (JPEG, JPG,
                                                                PNG)
                                                                Recommended Size:
                                                                200x200px.</p>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                                    <label class="block">
                                        <span>Sidebar Download App Url:</span>
                                        <textarea rows="4" placeholder="app url" name="app_url"
                                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            style="height:65px;">{{ $settings->app_url }}</textarea>
                                    </label>

                                    <label class="block">
                                        <span>Footer Copyright</span>
                                        <textarea rows="4" placeholder="Copyright" name="copyright"
                                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            style="height:65px;">{{ $settings->copyright }}</textarea>
                                    </label>


                                </div>

                                <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                                <div class="p-4 pt-0">
                                    <button type="submit"
                                        class="btn space-x-2 bg-red font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                        <span>Save</span>
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Configuration Layout -->
                <div class="tab-content" id="content-configuration" style="display: none;">
                    <div class="card">
                        <div
                            class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                            <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">Web
                                Configuration</h2>
                        </div>
                        <div class="p-4 sm:p-5">

                            <form method="POST" action="{{ route('admin.config_settings_update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                        <label class="block">
                                            <span>Web Mode</span>
                                            <select name="app_mode"
                                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                <option value="local"
                                                    @if (env('APP_ENV') == 'local') selected @endif>Development
                                                </option>
                                                <option value="production"
                                                    @if (env('APP_ENV') == 'production') selected @endif>Production
                                                </option>
                                            </select>
                                        </label>

                                        <label class="block">
                                            <span>Debug Mode</span>
                                            <select name="debug_mode"
                                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                <option value="true"
                                                    @if (env('APP_DEBUG') == true) selected @endif>Debug</option>
                                                <option value="false"
                                                    @if (env('APP_DEBUG') == false) selected @endif>Production
                                                </option>
                                            </select>
                                        </label>

                                    </div>

                                    <div class="my-5 h-px bg-slate-200 dark:bg-navy-500"></div>

                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                        <label class="block">
                                            <span>Featured Offers
                                                <a href="/admin/edit-offers/4"
                                                    class="btn h-6 rounded bg-primary px-3 text-xs font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                    <i class="fa-solid fa-gear mr-1"></i> Manage
                                                </a>
                                            </span>
                                            <span class="relative mt-1.5 flex">
                                                <select
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    name="offers_feed">
                                                    @if (env('DISABLE_HOMEPAGE_ADGET_FEATURED_OFFERS') == true)
                                                        <option value="true" selected>On</option>
                                                        <option value="false">Off</option>
                                                    @elseif (env('DISABLE_HOMEPAGE_ADGET_FEATURED_OFFERS') == false)
                                                        <option value="false" selected>Off</option>
                                                        <option value="true">On</option>
                                                    @endif
                                                </select>
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary">
                                                    <i class="fa-solid fa-angles-down"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <label class="block">
                                            <span>Email Verification</span>
                                            <span class="relative mt-1.5 flex">
                                                <select
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    name="email_verify">
                                                    @if (env('EMAILVERIFY') == true)
                                                        <option value="true" selected>On</option>
                                                        <option value="false">Off</option>
                                                    @elseif (env('EMAILVERIFY') == false)
                                                        <option value="false" selected>Off</option>
                                                        <option value="true">On</option>
                                                    @endif
                                                </select>
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary">
                                                    <i class="fa-solid fa-angles-down"></i>
                                                </span>
                                            </span>
                                        </label>

                                    </div>

                                    <div class="my-5 h-px bg-slate-200 dark:bg-navy-500"></div>

                                    <h3 class="text-base font-medium text-white dark:text-navy-100">
                                        Google
                                    </h3>
                                    <p class="text-xs+ text-slate-400 dark:text-navy-300">
                                        Manage and set up Google credentials.
                                    </p>
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mt-3">

                                        <label class="block">
                                            <span>Login</span>
                                            <span class="relative mt-1.5 flex">
                                                <select
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    name="google_login">
                                                    @if (env('GOOGLE_LOGIN') == true)
                                                        <option value="true" selected>On</option>
                                                        <option value="false">Off</option>
                                                    @elseif (env('GOOGLE_LOGIN') == false)
                                                        <option value="false" selected>Off</option>
                                                        <option value="true">On</option>
                                                    @endif
                                                </select>
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary">
                                                    <i class="fa-solid fa-angles-down"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <label class="block">
                                            <span class="text-slate-200">Client ID</span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="text" name="google_client_id"
                                                value="{{ env('GOOGLE_CLIENT') }}">
                                        </label>

                                        <label class="block">
                                            <span class="text-slate-200">Client secret</span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="text" name="google_client_secret"
                                                value="{{ env('GOOGLE_SECRET') }}">
                                        </label>

                                        <label class="block">
                                            <span class="text-slate-200">Callback URL</span>
                                            <input
                                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                type="text" name="google_callback"
                                                value="{{ env('GOOGLE_CALLBACK') }}">
                                        </label>

                                    </div>

                                    <div class="my-5 h-px bg-slate-200 dark:bg-navy-500"></div>
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="btn space-x-2 bg-red font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Save</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Financial Layout -->
                <div class="tab-content" id="content-financial" style="display: none;">
                    <div class="card">
                        <div
                            class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                            <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">Financial
                                Settings</h2>
                        </div>
                        <form method="POST" action="{{ route('admin.financial_settings_update') }}">
                            @csrf
                            <div class="p-4 sm:p-5">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                    <label class="block">
                                        <span class="text-slate-200">Refer Join Points</span>
                                        <input
                                            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            type="text" name="refer_join" value="{{ env('REFER_JOIN') }}">
                                    </label>

                                    <label class="block">
                                        <span class="text-slate-200">Refer By Points</span>
                                        <input
                                            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            type="text" name="refer_by" value="{{ env('REFER_BY') }}">
                                    </label>

                                    <label class="block">
                                        <span>$1 in Points</span>
                                        <input
                                            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                            placeholder="e.g: 1000" type="number" name="dollar_value"
                                            value="{{ $settings->dollar_value }}">
                                    </label>
                                </div>

                                <div class="my-5 h-px bg-slate-200 dark:bg-navy-500"></div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="btn space-x-2 bg-red font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Save</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <!-- SMTP Settings Layout -->
                <div class="tab-content" id="content-smtp" style="display: none;">
                    <div class="card">
                        <div
                            class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                            <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">SMTP
                                Settings</h2>
                        </div>
                        <div class="p-4 sm:p-5">

                            <form method="POST" action="{{ route('admin.smtp_settings_update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <!-- Mailer Driver -->
                                        <label class="block">
                                            <span>Mailer Driver</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter mail driver" type="text" name="driver"
                                                    value="{{ env('MAIL_MAILER', 'smtp') }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <!-- Mail Host -->
                                        <label class="block">
                                            <span>Mail Host</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter mail host" type="text" name="mail_host"
                                                    value="{{ env('MAIL_HOST', 'smtp.gmail.com') }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-solid fa-server"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <!-- Mail Port -->
                                        <label class="block">
                                            <span>Mail Port</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter mail port" type="number" name="mail_port"
                                                    value="{{ env('MAIL_PORT', '587') }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-solid fa-plug"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <!-- Mail Username -->
                                        <label class="block">
                                            <span>Mail Username</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter mail username" type="text"
                                                    name="mail_username"
                                                    value="{{ env('MAIL_USERNAME', 'your-email@gmail.com') }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-solid fa-user"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <!-- Mail Password -->
                                        <label class="block">
                                            <span>Mail Password</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter mail password" type="password"
                                                    name="mail_password" value="{{ env('MAIL_PASSWORD', '') }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <!-- Mail Encryption -->
                                        <label class="block">
                                            <span>Mail Encryption</span>
                                            <span class="relative mt-1.5 flex">
                                                <select
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-layot-dark_csm px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    name="encryption">
                                                    @if (env('MAIL_ENCRYPTION') == 'tls')
                                                        <option value="tls" selected>TLS</option>
                                                        <option value="ssl">SSL</option>
                                                    @elseif (env('MAIL_ENCRYPTION') == 'ssl')
                                                        <option value="ssl" selected>SSL</option>
                                                        <option value="tls">TLS</option>
                                                    @else
                                                        <option value="tls" selected>TLS</option>
                                                        <option value="ssl">SSL</option>
                                                    @endif
                                                </select>
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <!-- From Email -->
                                        <label class="block">
                                            <span>From Email</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter from email" type="email" name="from_email"
                                                    value="{{ env('MAIL_FROM_ADDRESS', 'noreply@example.com') }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </span>
                                            </span>
                                        </label>

                                        <!-- From Name -->
                                        <label class="block">
                                            <span>From Name</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter from name" type="text" name="from_name"
                                                    value="{{ env('MAIL_FROM_NAME', 'CSM Tool') }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-solid fa-signature"></i>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="my-5 h-px bg-slate-200 dark:bg-navy-500"></div>
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="btn space-x-2 bg-red font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">Save</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- socials Settings Layout -->
                <div class="tab-content" id="content-socials" style="display: none;">
                    <div class="card">
                        <div
                            class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                            <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">Social
                                Settings</h2>
                        </div>
                        <div class="p-4 sm:p-5">
                            <form method="POST" action="{{ route('admin.social_up') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="flex flex-col gap-6">

                                    @foreach ($social_media as $media)
                                        <label class="block">
                                            <span>{{ $media->title }} @if ($media->status == 0)
                                                    <div class="badge ml-1 bg-warning/10 text-warning">Inactive</div>
                                                @else
                                                    <div class="badge ml-1 bg-success/10 text-success">Active</div>
                                                @endif
                                            </span>
                                            <div class="flex items-center gap-3">
                                                <input
                                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400
                                 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    type="url" name="{{ $media->title }}_url"
                                                    value="{{ $media->url }}">
                                                <input
                                                    class="form-switch h-5 w-10 rounded-lg bg-slate-300 before:rounded-md before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white"
                                                    type="checkbox" name="{{ $media->title }}_st"
                                                    @if ($media->status == 1) checked @endif>
                                                <input type="hidden" name="{{ $media->title }}_id"
                                                    value="{{ $media->id }}">
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                                <div class="flex justify-end space-x-2">
                                    <button type="submit"
                                        class="btn space-x-2 bg-red font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                        <span>Save</span>
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Account Settings Layout -->
                <div class="tab-content" id="content-account" style="display: none;">
                    <div class="card">
                        <div
                            class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                            <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">Account
                                Settings</h2>
                        </div>
                        <div class="p-4 sm:p-5">
                            <form method="POST" action="{{ route('admin.ad_update_settings') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="">
                                    <div class="flex flex-col">
                                        <div class="avatar h-20 w-20">
                                            <img id="profile-img-preview" class="mask is-squircle"
                                                src="{{ $admin_data->profile ?? '/images/icons/200x200.svg' }}"
                                                alt="avatar">
                                            <div
                                                class="absolute bottom-0 right-0 flex items-center justify-center rounded-full dark:bg-navy-700">
                                                <label
                                                    class="btn h-6 w-6 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:border-navy-500 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                                    style="background: #1b1e21;">
                                                    <input tabindex="-1" type="file" name="admin_avatar"
                                                        id="profile-choose-file"
                                                        class="pointer-events-none absolute inset-0 h-full w-full opacity-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                                        <label class="block">
                                            <span>Full Name </span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter full name" type="text" name="name"
                                                    value="{{ $admin_data->name }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-regular fa-user text-base"></i>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="block">
                                            <span>Email Address </span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="Enter email address" type="email" name="email"
                                                    value="{{ $admin_data->email }}">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-regular fa-envelope text-base"></i>
                                                </span>
                                            </span>
                                        </label>
                                    </div>

                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mt-3">

                                        <label class="block">
                                            <span>Password</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="" type="password" name="new_password"
                                                    value="">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="block">
                                            <span>Confirm Password</span>
                                            <span class="relative mt-1.5 flex">
                                                <input
                                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                    placeholder="" type="password" name="new_confirm_password"
                                                    value="">
                                                <span
                                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                            </span>
                                        </label>
                                    </div>

                                    <div>

                                    </div>
                                </div>
                                <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                                <div class="flex justify-end space-x-2">
                                    <button type="submit"
                                        class="btn space-x-2 bg-red font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                        <span>Save</span>
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to switch tab content
                function switchTabContent(tabId) {
                    // Hide all tab content
                    document.querySelectorAll('.tab-content').forEach(function(content) {
                        content.style.display = 'none';
                    });

                    // Show the clicked tab's content
                    document.getElementById(`content-${tabId}`).style.display = 'block';

                    // Remove active class from all tabs
                    document.querySelectorAll('.tab-link').forEach(function(tab) {
                        tab.classList.remove('bg-red');
                    });

                    // Add active class to the clicked tab
                    document.getElementById(`tab-${tabId}`).classList.add('bg-red');

                    // Save the active tab to localStorage
                    localStorage.setItem('activeTab', tabId);
                }

                // Add click event listeners to all tab links
                document.querySelectorAll('.tab-link').forEach(function(tab) {
                    tab.addEventListener('click', function(e) {
                        e.preventDefault();
                        const tabId = this.id.split('-')[
                        1]; // Get the last part of the id (e.g., 'general', 'smtp', etc.)
                        switchTabContent(tabId);
                    });
                });

                // On page load, check if there's an active tab stored in localStorage
                const savedTab = localStorage.getItem('activeTab') ||
                'general'; // Default to 'general' tab if nothing is stored
                switchTabContent(savedTab); // Activate the stored or default tab
            });
        </script>

        <script>
            const chooseFile = document.getElementById("profile-choose-file");
            const imgPreview = document.getElementById("profile-img-preview");

            function getImgData() {
                const files = chooseFile.files[0];
                if (files) {
                    const fileReader = new FileReader();
                    fileReader.readAsDataURL(files);
                    fileReader.addEventListener("load", function() {
                        imgPreview.style.display = "block";
                        imgPreview.src = this.result;
                    });
                }
            }
            chooseFile.addEventListener("change", function() {
                getImgData();
            });
        </script>

        <script>
            function triggerFileInput(boxId) {
                document.querySelector(`.csm-new-file-input[data-input="${boxId}"]`).click();
            }

            document.querySelectorAll('.csm-new-file-input').forEach(input => {
                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const boxId = event.target.getAttribute('data-input');
                    const imagePreview = document.querySelector(
                        `.csm-new-image-preview[data-preview="${boxId}"]`);

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.style.display = "block";
                            imagePreview.style.backgroundImage = `url(${e.target.result})`;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    </main>
</x-admin-layout>
