<x-header>

    <main class="main-content pos-app w-full px-[var(--margin-x)] pb-6 transition-all duration-[.25s]">

        <div class="flex items-center justify-center space-x-4 py-5 lg:py-6 mt-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Most Frequently Asked Questions
            </h2>


          </div>

        <div class="mt-3 col-12 container">
            <div class="col-span-12 sm:col-span-6 lg:col-span-8">

                <div class="flex flex-col space-y-4 rounded-lg sm:space-y-5 lg:space-y-6">
                    <div x-data="{ expanded: false }" class="card rounded-lg border border-slate-150 dark:border-navy-500">
                        <div @click="expanded = !expanded"
                            class="flex cursor-pointer items-center justify-between px-4 py-4 text-base font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                            <p>1. What is {{ $site_details->site_name }}?</p>
                            <div :class="expanded && '-rotate-180'"
                                class="text-sm font-normal leading-none text-slate-400 transition-transform duration-300 dark:text-navy-300">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div x-collapse x-show="expanded">
                            <div class="px-4 pb-4 sm:px-5">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi
                                    earum magni officiis possimus repellendus. Accusantium adipisci
                                    aliquid praesentium quaerat voluptate.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ expanded: false }" class="card rounded-lg border border-slate-150 dark:border-navy-500">
                        <div @click="expanded = !expanded"
                            class="flex cursor-pointer items-center justify-between px-4 py-4 text-base font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                            <p>2. How long do cashout take to process?</p>
                            <div :class="expanded && '-rotate-180'"
                                class="text-sm font-normal leading-none text-slate-400 transition-transform duration-300 dark:text-navy-300">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div x-collapse x-show="expanded">
                            <div class="px-4 pb-4 sm:px-5">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi
                                    earum magni officiis possimus repellendus. Accusantium adipisci
                                    aliquid praesentium quaerat voluptate.
                                </p>

                            </div>
                        </div>
                    </div>

                    <div x-data="{ expanded: false }" class="card rounded-lg border border-slate-150 dark:border-navy-500">
                        <div @click="expanded = !expanded"
                            class="flex cursor-pointer items-center justify-between px-4 py-4 text-base font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                            <p>3. My offer points not aaded to my account?</p>
                            <div :class="expanded && '-rotate-180'"
                                class="text-sm font-normal leading-none text-slate-400 transition-transform duration-300 dark:text-navy-300">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div x-collapse x-show="expanded">
                            <div class="px-4 pb-4 sm:px-5">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi
                                    earum magni officiis possimus repellendus. Accusantium adipisci
                                    aliquid praesentium quaerat voluptate.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</x-header>
