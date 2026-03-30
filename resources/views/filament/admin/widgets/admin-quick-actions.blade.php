<x-filament-widgets::widget>
  <x-filament::section>
    <div class="flex flex-col gap-6">
      <div>
        <h2 class="text-base font-semibold text-gray-950 dark:text-white">Quick Actions</h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          Jump into the workflows that most directly affect the public website and daily operations.
        </p>
      </div>

      <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($actions as $action)
          <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="flex items-start justify-between gap-4">
              <div class="space-y-3">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">
                  <x-filament::icon :icon="$action['icon']" class="h-5 w-5" />
                </span>

                <div>
                  <h3 class="text-sm font-semibold text-gray-950 dark:text-white">{{ $action['label'] }}</h3>
                  <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $action['description'] }}</p>
                </div>
              </div>

              <div class="text-right">
                <p class="text-2xl font-bold text-gray-950 dark:text-white">{{ number_format($action['count']) }}</p>
                <p class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ $action['count_label'] }}</p>
              </div>
            </div>

            <div class="mt-4 flex flex-wrap gap-3">
              <x-filament::link :href="$action['manage_url']" color="primary">
                Manage
              </x-filament::link>

              <x-filament::link :href="$action['create_url']" color="gray">
                Create
              </x-filament::link>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </x-filament::section>
</x-filament-widgets::widget>
