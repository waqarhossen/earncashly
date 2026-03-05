<x-admin-layout>
    <style>
        .file-upload-wrapper {
            display: inline-flex;
            align-items: center;
            border: 1px solid #2e314b;
            border-radius: 4px;
            overflow: hidden;
            width: 100%;
            font-size: 14px;
        }

        .custom-file-input input[type=file] {
            width: 100%;
        }

        .custom-file-input input[type=file]::file-selector-button {
            border-radius: 0;
            background-color: #2e314b;
            border: none;
            color: rgba(255, 255, 255, 0.74);
            padding: 8px;
            margin-right: 10px;
            font-size: 13px;
            cursor: pointer;
        }
    </style>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="container">
            <div class="flex items-center space-x-4 py-5 lg:py-6">
                <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                    Admin
                </h2>
                <div class="hidden h-full py-1 sm:flex">
                    <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                </div>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-white" href="{{ route('admin.dashboard') }}">
                            Home</a>
                        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </li>
                    <li>Addons</li>
                </ul>
            </div>
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
            <div>

                <div class="card mt-3">
                    <div
                        class="flex flex-col items-center space-y-4 p-4 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                        <div class="flex items-center space-x-2">
                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-error/10 p-1 text-error">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                                Upload an addon
                            </h4>
                        </div>
                        <div x-data="{ showModal: false }">
                            <button @click="showModal = true"
                                class="btn space-x-2 bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <span>Upload</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                    </path>
                                </svg>
                            </button>
                            <template x-teleport="#x-teleport-target">
                                <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                    x-show="showModal" role="dialog" @keydown.window.escape="showModal = false">
                                    <div class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                                        @click="showModal = false" x-show="showModal" x-transition:enter="ease-out"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"></div>
                                    <div class="relative w-full max-w-lg origin-top rounded-lg bg-slate-200 transition-all duration-300 dark:bg-navy-700"
                                        x-show="showModal" x-transition:enter="easy-out"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="easy-in"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95">
                                        <div
                                            class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                                            <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                                                Upload an addon
                                            </h3>
                                            <button @click="showModal = !showModal"
                                                class="btn -mr-1.5 size-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="px-4 py-4 sm:px-5">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mt-4 space-y-4">
                                                    <div
                                                        class="alert flex rounded-lg border border-warning px-4 py-4 text-warning sm:px-5">
                                                        <div class="">
                                                            <h5 class="mb-2 underline"><strong>Important!</strong></h5>
                                                            <ul class="mb-0 mt-1">
                                                                <li class="mb-1">
                                                                    Make sure you are uploading the correct files.
                                                                </li>
                                                                <li class="mb-0">
                                                                    Before uploading a new addon make sure to take a
                                                                    backup
                                                                    of your website files and database.
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <label class="block pt-1">
                                                        <span>Purchase Code:</span>
                                                        <input
                                                            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                            placeholder="Purchase code" type="text"
                                                            name="purchase_code" />
                                                    </label>

                                                    <label class="flex flex-col">
                                                        <span>Addon Files (Zip):</span>
                                                        <div class="file-upload-wrapper custom-file-input mt-1.5">
                                                            <input type="file" id="fileUpload" id="addon_files"
                                                                name="addon_files" accept=".zip">
                                                        </div>
                                                    </label>

                                                    <div class="space-x-2 text-right pt-4">
                                                        <button @click="showModal = false" type="button"
                                                            class="btn min-w-[7rem] rounded-lg border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                                            Cancel
                                                        </button>
                                                        <button @click="showModal = false"
                                                            class="btn min-w-[7rem] rounded-lg bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 ">
                                                            Upload
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>

                <div class="{{ $addons->count() ? 'card' : '' }} mt-5">
                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto" x-data="pages.tables.initExample1">
                        <table class="is-hoverable w-full text-left">
                            <tbody>
                                @forelse ($addons as $addon)
                                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">

                                            <div class="flex items-center space-x-4">
                                                <div class="avatar h-18 w-18">
                                                    <img class="rounded-lg" src="{{ $addon->thumbnail ?? '' }}"
                                                        alt="avatar" />
                                                </div>
                                                <div>
                                                    <p class="font-medium text-slate-700">
                                                        {{ $addon->name }}
                                                    </p>
                                                    <p class="mt-1.5 text-xs text-slate-400 dark:text-navy-300">
                                                        Version: {{ $addon->version }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            {{ date('jS F, Y', strtotime($addon->created_at)) }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            @if ($addon->status == '0')
                                                <div
                                                    class="badge space-x-2.5 rounded-full bg-error/10 text-error dark:bg-error/15">
                                                    <div class="h-2 w-2 rounded-full bg-current"></div>
                                                    <span>InActive</span>
                                                </div>
                                            @else
                                                <div
                                                    class="badge space-x-2.5 rounded-full bg-success/10 text-success dark:bg-success/15">
                                                    <div class="h-2 w-2 rounded-full bg-current"></div>
                                                    <span>Active</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            @if($addon->action == 'no')
                                            <div>
                                                <input
                                                    id="status-toggle-{{ $addon->id }}"
                                                    class="form-switch h-5 w-10 rounded-lg bg-slate-300 before:rounded-md before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white"
                                                    type="checkbox"
                                                    data-id="{{ $addon->id }}"
                                                    @if ($addon->status == 1) checked @endif
                                                >
                                                <input type="hidden" name="{{ $addon->title }}_id" value="{{ $addon->id }}">
                                            </div>
                                            @else
                                            <a href="{{ $addon->action }}"
                                            class="btn h-8 rounded-md bg-primary px-4 text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                          >
                                          <i class="fa-regular fa-eye mr-1.5"></i> View
                                        </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <div class="text-center mt-3">
                                        <div class="py-5">
                                            <i class="fa-solid fa-layer-group text-xl text-slate-600"></i>
                                            <p class="mb-0 mt-3 text-slate-600">You don't have any addons yet.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('.form-switch').on('change', function () {
                let addonId = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
    
                $.ajax({
                    url: "{{ route('admin.addons.status.update') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: addonId,
                        status: status
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        alert('Something went wrong. Please try again!');
                    }
                });
            });
        });
    </script>
</x-admin-layout>
