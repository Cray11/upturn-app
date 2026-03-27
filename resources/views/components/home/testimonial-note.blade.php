@props([
    'testimonial',
    'surfaceClass' => 'flex h-full flex-col rounded-3xl bg-white p-8 shadow-sm transition-shadow hover:shadow-xl hover:shadow-blue-900/5',
])

@php
    $rating = max((int) ($testimonial['rating'] ?? 0), 1);
@endphp

<article {{ $attributes->class(['testimonial-note']) }}>
  <div class="{{ $surfaceClass }}">
    <div class="mb-8 flex items-center justify-between">
      <div class="flex rounded-full bg-slate-50 px-3 py-1 text-[#d4af37]">
        @for ($i = 0; $i < $rating; $i++)
          <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">star</span>
        @endfor
      </div>
    </div>

    <p class="text-lg leading-relaxed text-slate-600">
      "{{ $testimonial['content'] }}"
    </p>

    <div class="mt-auto flex items-center gap-4 pt-10">
      <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#1152d4] text-sm font-bold text-white shadow-lg">
        {{ $testimonial['initials'] ?: 'UB' }}
      </div>
      <div class="overflow-hidden">
        <p class="truncate text-sm font-black text-slate-900">{{ $testimonial['client_name'] }}</p>
        <p class="truncate text-xs font-medium text-slate-400">{{ $testimonial['company'] ?: 'Client Partner' }}</p>
      </div>
    </div>
  </div>
</article>
