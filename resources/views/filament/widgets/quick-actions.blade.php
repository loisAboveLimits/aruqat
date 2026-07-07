<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-y-4">
            <h3 class="text-base font-bold leading-6 text-gray-950 dark:text-white">
                Quick Actions
            </h3>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($this->getActions() as $action)
                    <a
                        href="{{ $action['url'] }}"
                        @if($action['new_tab'] ?? false) target="_blank" @endif
                        class="group flex items-center gap-x-4 rounded-2xl border border-gray-200 bg-white p-4 transition-all duration-200 hover:border-primary-500 hover:shadow-md dark:border-white/10 dark:bg-white/5 dark:hover:border-primary-400"
                    >
                        <div class="flex h-12 w-12 flex-none items-center justify-center rounded-xl bg-primary-50 group-hover:bg-primary-100 dark:bg-primary-500/10 dark:group-hover:bg-primary-500/20">
                            @svg($action['icon'], 'h-6 w-6 text-primary-600 dark:text-primary-400')
                        </div>

                        <div class="flex-1">
                            <span class="text-sm font-semibold text-gray-950 dark:text-white">
                                {{ $action['label'] }}
                            </span>
                        </div>

                        <div class="text-gray-400 transition-transform group-hover:translate-x-1">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
