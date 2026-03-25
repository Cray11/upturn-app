<div class="space-y-6">
    @if ($record->imageUrl())
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
            <img src="{{ $record->imageUrl() }}" alt="{{ $record->title ?: $record->page }}" class="h-[320px] w-full object-cover">
        </div>
    @endif

    <div class="space-y-3">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-primary-600">
            {{ \App\Models\PageContent::pageOptions()[$record->page] ?? $record->page }}
            | {{ \App\Models\PageContent::sectionOptions()[$record->section] ?? $record->section }}
        </p>

        @if ($record->label)
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">{{ $record->label }}</p>
        @endif

        @if ($record->title)
            <h3 class="text-2xl font-bold text-gray-950 dark:text-white">{{ $record->title }}</h3>
        @endif

        @if ($record->description)
            <p class="whitespace-pre-line text-sm leading-7 text-gray-700 dark:text-gray-300">{{ $record->description }}</p>
        @endif
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl bg-gray-50 p-4 dark:bg-gray-900/70">
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Primary Button</p>
            <p class="mt-2 text-sm font-semibold text-gray-950 dark:text-white">{{ $record->primary_button_label ?: 'Not set' }}</p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $record->primary_button_url ?: 'No URL set' }}</p>
        </div>

        <div class="rounded-2xl bg-gray-50 p-4 dark:bg-gray-900/70">
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Secondary Button</p>
            <p class="mt-2 text-sm font-semibold text-gray-950 dark:text-white">{{ $record->secondary_button_label ?: 'Not set' }}</p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $record->secondary_button_url ?: 'No URL set' }}</p>
        </div>
    </div>
</div>
