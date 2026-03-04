<x-header>
    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]">
        <div class="mt-3 col-12 container">
            <div class="col-span-12 sm:col-span-6 lg:col-span-8">
                <div class="mt-3 space-y-3.5">
                    <!-- leaderboard -->

                    <div class="lead_">
                        @if (!empty($second))
                            <div class="flex flex-col items-center space-y-3 text-center">
                                <div class="avatar mt-1.5 h-20 w-20">
                                    <div class="h-20 w-20 rounded-lg bg-gradient-to-r from-sky-400 to-blue-600 p-0.5">
                                        @if (!empty($second->picture))
                                            <img class="h-full w-full rounded-lg border-2 border-white object-cover object-center dark:border-navy-700"
                                                src="{{ $second->picture }}" alt="image">
                                        @else
                                            <div class="d-pro bg-red rounded-lg h-full w-full rounded-lg border-2 border-white object-cover object-center text-white">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div
                                        class="absolute le_tag text-white top-0 right-0 flex items-center justify-center rounded-lg">
                                        #2
                                    </div>
                                </div>

                                <div>
                                    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                                        {{ $second->name }}
                                    </p>
                                    <p
                                        class="flex items-center justify-center gap-1 text-xs+ text-slate-400 dark:text-navy-300">
                                        <img class="h-4" src="{{ url('/images/app/app-coin.png') }}" alt="">
                                        {{ num($second->points) }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if (!empty($first))
                            <div class="flex fst flex-col items-center space-y-3 text-center">
                                <div class="avatar mt-1.5 h-20 w-20">
                                    <div
                                        class="h-20 w-20 rounded-lg bg-gradient-to-r from-sky-400 to-blue-600 p-0.5 back_re">
                                        @if (!empty($first->picture))
                                            <img class="h-full w-full rounded-lg border-2 border-white object-cover object-center dark:border-navy-700"
                                                src="{{ $first->picture }}" alt="image">
                                        @else
                                            <div class="d-pro bg-red rounded-lg h-full w-full rounded-lg border-2 border-white object-cover object-center text-white">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div
                                        class="absolute le_tag text-white top-0 right-0 flex items-center justify-center rounded-lg">
                                        #1
                                    </div>
                                </div>
                                <div>
                                    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                                        {{ $first->name }}
                                    </p>
                                    <p
                                        class="flex items-center justify-center gap-1 text-xs+ text-slate-400 dark:text-navy-300">
                                        <img class="h-4" src="{{ url('/images/app/app-coin.png') }}" alt="">
                                        {{ num($first->points) }}
                                    </p>
                                </div>
                            </div>
                        @endif
                        @if (!empty($third))
                            <div class="flex flex-col items-center space-y-3 text-center">
                                <div class="avatar mt-1.5 h-20 w-20">
                                    <div class="h-20 w-20 rounded-lg bg-gradient-to-r from-sky-400 to-blue-600 p-0.5">
                                        @if (!empty($third->picture))
                                            <img class="h-full w-full rounded-lg border-2 border-white object-cover object-center dark:border-navy-700"
                                                src="{{ $third->picture }}" alt="image">
                                        @else
                                            <div class="d-pro bg-red rounded-lg h-full w-full rounded-lg border-2 border-white object-cover object-center text-white">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div
                                        class="absolute le_tag text-white top-0 right-0 flex items-center justify-center rounded-lg">
                                        #3
                                    </div>
                                </div>
                                <div>
                                    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                                        {{ $third->name }}
                                    </p>
                                    <p
                                        class="flex items-center justify-center gap-1 text-xs+ text-slate-400 dark:text-navy-300">
                                        <img class="h-4" src="{{ url('/images/app/app-coin.png') }}" alt="">
                                        {{ num($third->points) }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="card mt-3">
                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr>
                                        <th
                                            class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-white">
                                            Rank
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-white lg:px-5">
                                            Name
                                        </th>
                                        <th
                                            class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-white lg:px-5">
                                            Coins
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 3; @endphp
                                    @foreach ($users as $user)
                                        @php $count++; @endphp
                                        <tr
                                            class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                            <td class="whitespace-nowrap px-4 py-3">
                                                <p
                                                    class="text-center text-base font-medium text-slate-700 dark:text-navy-100">
                                                    @if ($count <= 9)
                                                        0{{ $count }}.
                                                    @else
                                                        {{ $count }}.
                                                    @endif

                                                </p>
                                            </td>
                                            <td class="min-w-[8rem] px-4 py-3 sm:px-5">
                                                <div class="flex items-center space-x-4">
                                                    @if (!empty($user->picture))
                                                        <div class="avatar h-12 w-12">
                                                            <img class="rounded-lg object-cover object-center"
                                                                src="{{ $user->picture }}">
                                                        </div>
                                                    @else
                                                        <div class="d-pro bg-red rounded-lg h-12 w-12">
                                                            <i class="fa-solid fa-user"></i>
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="font-medium text-slate-700 line-clamp-2 dark:text-navy-100">{{ $user->name }}</span>
                                                </div>
                                            </td>

                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                {{ num($user->points) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

</x-header>
