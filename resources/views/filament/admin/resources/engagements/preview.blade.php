@php
    $imageUrls = $record->imageUrls();
@endphp

<div
    x-data="{ images: @js($imageUrls), slide: 0 }"
    class="space-y-6"
>
    <div class="space-y-2">
        <p class="text-xs font-bold uppercase tracking-[0.24em] text-primary-600">
            {{ $record->sectionLabel() }}
            @if (filled($record->label))
                | {{ $record->label }}
            @endif
        </p>
        <h3 class="text-2xl font-bold text-gray-950 dark:text-white">{{ $record->title }}</h3>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
        <template x-if="images.length">
            <div class="space-y-4 p-4">
                <div class="relative overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800">
                    <img x-bind:src="images[slide]" alt="{{ $record->title }}" class="h-[360px] w-full object-cover">

                    <div
                        x-show="images.length > 1"
                        class="absolute inset-x-0 bottom-4 flex items-center justify-between px-4"
                    >
                        <button
                            type="button"
                            x-on:click="slide = (slide - 1 + images.length) % images.length"
                            class="rounded-full bg-black/60 p-2 text-white"
                        >
                            <x-filament::icon icon="heroicon-o-chevron-left" class="h-5 w-5" />
                        </button>

                        <span class="rounded-full bg-black/60 px-3 py-1 text-xs font-semibold text-white" x-text="`${slide + 1} / ${images.length}`"></span>

                        <button
                            type="button"
                            x-on:click="slide = (slide + 1) % images.length"
                            class="rounded-full bg-black/60 p-2 text-white"
                        >
                            <x-filament::icon icon="heroicon-o-chevron-right" class="h-5 w-5" />
                        </button>
                    </div>
                </div>

                <div x-show="images.length > 1" class="flex flex-wrap gap-2">
                    <template x-for="(image, index) in images" :key="`${image}-${index}`">
                        <button
                            type="button"
                            x-on:click="slide = index"
                            class="h-14 w-14 overflow-hidden rounded-lg border-2 transition"
                            x-bind:class="slide === index ? 'border-primary-500' : 'border-transparent'"
                        >
                            <img x-bind:src="image" alt="" class="h-full w-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        </template>

        <template x-if="! images.length">
            <div class="flex h-[280px] items-center justify-center p-6 text-sm text-gray-500 dark:text-gray-400">
                No images uploaded for this engagement yet.
            </div>
        </template>
    </div>

    <div class="rounded-2xl bg-gray-50 p-6 dark:bg-gray-900/70">
        <p class="whitespace-pre-line text-sm leading-7 text-gray-700 dark:text-gray-300">{{ $record->description }}</p>
    </div>
</div>
