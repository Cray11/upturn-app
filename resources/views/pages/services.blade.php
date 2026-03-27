@extends('layouts.app')
@section('title', 'Our Services - Upturn Business Solutions')
@section('content')
  @php
    $heroContent = $contentBlocks->get('hero', [
        'label' => 'Our Expertise',
        'title' => 'Comprehensive Business Solutions',
        'description' => 'This page is driven by the service and space records managed inside the admin panel.',
        'image_url' => null,
    ]);
    $introContent = $contentBlocks->get('intro', [
        'label' => 'Service Portfolio',
        'title' => 'Solutions tailored to each stage of business growth',
        'description' => 'Use this section to introduce your offer mix before visitors browse the live service records below.',
    ]);
    $ctaContent = $contentBlocks->get('cta', [
        'label' => 'Workspace Inventory',
        'title' => 'Available Spaces from Booking Management',
        'description' => 'As spaces are added or marked available in the admin panel, they appear here for public visitors to explore.',
        'primary_button_label' => 'Book a Space',
        'primary_button_url' => route('co-working'),
    ]);
  @endphp

  <div class="flex flex-1 justify-center px-4 py-6 md:px-20 md:py-10">
    <div class="flex w-full max-w-[1100px] flex-1 flex-col">
      <div class="mb-10">
        <div class="relative flex min-h-[320px] flex-col justify-end overflow-hidden rounded-xl border-l-8 border-[#D4AF37] bg-cover bg-center" style="background-image: linear-gradient(to right, rgba(17,82,212,0.9) 0%, rgba(17,82,212,0.4) 100%), url('{{ $heroContent['image_url'] ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDMppvco9_HytRB9Xmu60UXNR6gDDU5HHSTfNrG9j1H1bPamFnIKo7M5Q_ezVFLB_SZsqzBGcKUasiU2V7Fn2ioJkKmn1WxyVGnhmHHdHvc4mCTQ7k0sTW-HyZq2E8Im6HYjqLVtywM_s15mbzBAymdn1w2TA91LMHctdyDWH-lGPzGtK2Q5YzUb8NXMlTgVwjw0D4UlMmc3fE_hC0TYysI4V65MEg3DUYlRnl7joKdelIFNjXRI1i8VgzkY_uGeK6GaZBMMXf_1Lvp' }}');">
          <div class="flex max-w-2xl flex-col p-10">
            <span class="mb-2 text-sm font-bold uppercase tracking-widest text-[#D4AF37]">{{ $heroContent['label'] ?: 'Our Expertise' }}</span>
            <h1 class="mb-4 text-4xl font-black leading-tight tracking-tight text-white md:text-5xl">{{ $heroContent['title'] ?: 'Comprehensive Business Solutions' }}</h1>
            <p class="text-lg font-medium text-slate-100 opacity-90">{{ $heroContent['description'] ?: 'This page is driven by the service and space records managed inside the admin panel.' }}</p>
          </div>
        </div>
      </div>

      <div class="mb-10 rounded-3xl border border-slate-200 bg-slate-50 px-6 py-8 md:px-8">
        <span class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $introContent['label'] ?: 'Service Portfolio' }}</span>
        <h2 class="mt-3 text-3xl font-black text-slate-900 md:text-4xl">{{ $introContent['title'] ?: 'Solutions tailored to each stage of business growth' }}</h2>
        <p class="mt-4 max-w-3xl text-base leading-relaxed text-slate-600">{{ $introContent['description'] ?: 'Use this section to introduce your offer mix before visitors browse the live service records below.' }}</p>
      </div>

      <div class="grid grid-cols-1 gap-6 p-0 md:grid-cols-2 md:p-4">
        @forelse ($services as $service)
          <div class="group flex flex-col items-stretch gap-6 rounded-xl border border-slate-100 bg-white p-6 shadow-sm transition-shadow hover:shadow-md md:flex-row">
            <div class="flex flex-1 flex-col justify-between gap-4">
              <div class="flex flex-col gap-2">
                <div class="mb-2 flex h-12 w-12 items-center justify-center rounded-lg bg-[#1152d4]/10 text-[#1152d4]">
                  <span class="material-symbols-outlined text-3xl">{{ $service['icon'] }}</span>
                </div>
                <h3 class="text-xl font-bold leading-tight text-slate-900">{{ $service['title'] }}</h3>
                <p class="text-sm leading-relaxed text-slate-600">{{ $service['description'] }}</p>
                @if ($service['price_label'])
                  <p class="text-sm font-semibold text-[#1152d4]">{{ $service['price_label'] }}</p>
                @endif
              </div>
              <a href="{{ route('contact') }}" class="flex h-10 w-fit items-center justify-center rounded-lg bg-slate-100 px-6 text-sm font-bold text-[#1152d4] transition-all hover:bg-[#1152d4] hover:text-white group-hover:bg-[#1152d4] group-hover:text-white">
                Request a Quote
              </a>
            </div>
            <div class="hidden h-40 w-full flex-none rounded-lg bg-cover bg-center bg-no-repeat sm:block md:h-auto md:w-40" style="background-image: url('{{ $service['image_url'] ?: 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=900&q=80' }}');"></div>
          </div>
        @empty
          <div class="md:col-span-2 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h3 class="text-2xl font-bold text-slate-900">No active services are published yet.</h3>
            <p class="mt-3 text-slate-600">Create and activate services in the admin panel to populate this page.</p>
          </div>
        @endforelse
      </div>

      <section class="mt-12 rounded-3xl bg-[#0c1424] px-6 py-10 text-white md:px-10 md:py-14">
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
          <div class="max-w-2xl space-y-3">
            <span class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $ctaContent['label'] ?: 'Workspace Inventory' }}</span>
            <h2 class="text-3xl font-black md:text-4xl">{{ $ctaContent['title'] ?: 'Available Spaces from Booking Management' }}</h2>
            <p class="text-slate-300">{{ $ctaContent['description'] ?: 'As spaces are added or marked available in the admin panel, they appear here for public visitors to explore.' }}</p>
          </div>
          <a href="{{ $ctaContent['primary_button_url'] ?: route('co-working') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#d4af37] px-6 py-3 font-bold text-slate-900 transition-all hover:brightness-105">
            {{ $ctaContent['primary_button_label'] ?: 'Book a Space' }} <span class="material-symbols-outlined text-sm">arrow_forward</span>
          </a>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
          @forelse ($spaces as $space)
            <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/5">
              <div class="h-56 bg-cover bg-center" style="background-image: url('{{ $space['thumbnail_url'] ?: 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1200&q=80' }}');"></div>
              <div class="space-y-4 p-6">
                <div class="flex items-start justify-between gap-4">
                  <div>
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-[#d4af37]">{{ $space['type_label'] }}</p>
                    <h3 class="mt-2 text-2xl font-bold">{{ $space['name'] }}</h3>
                  </div>
                  <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-slate-200">{{ $space['rate_label'] }}</span>
                </div>
                <p class="text-sm leading-relaxed text-slate-300">{{ $space['description'] }}</p>
                <div class="flex items-center gap-2 text-sm text-slate-200">
                  <span class="material-symbols-outlined text-base text-[#d4af37]">groups</span>
                  Capacity: {{ $space['capacity'] }} {{ $space['capacity'] === 1 ? 'person' : 'people' }}
                </div>
              </div>
            </div>
          @empty
            <div class="lg:col-span-3 rounded-3xl border border-dashed border-white/15 bg-white/5 px-8 py-12 text-center">
              <h3 class="text-2xl font-bold text-white">No spaces are currently available.</h3>
              <p class="mt-3 text-slate-300">Mark spaces as available in booking management to show them here.</p>
            </div>
          @endforelse
        </div>
      </section>
    </div>
  </div>

@endsection
