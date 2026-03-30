@extends('layouts.app')
@section('title', 'Engagements - Upturn Business Solutions')

@section('content')
  @php
    $fallbackImage = 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=80';
    $heroContent = $pageSections['hero'] ?? [];
    $introContent = $pageSections['intro'] ?? [];
    $ctaContent = $pageSections['cta'] ?? [];
  @endphp

  <section class="relative overflow-hidden bg-[#0c2b5e]">
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, #d4af37 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative z-10 mx-auto max-w-5xl px-6 py-24 text-center md:py-28">
      <h1 class="text-5xl font-black tracking-tight text-white md:text-6xl">{{ $heroContent['title'] ?: 'Partnerships and Client Success' }}</h1>
      <p class="mx-auto mt-6 max-w-3xl text-lg leading-relaxed text-slate-200 md:text-xl">
        {{ $heroContent['description'] ?: 'Discover the businesses we partner with and the client success stories that reflect the impact of our work.' }}
      </p>
      <div class="mt-8 flex justify-center">
        <a href="{{ $heroContent['primary_button_url'] ?: route('careers') }}" class="rounded-xl bg-[#d4af37] px-8 py-4 text-lg font-bold text-[#002147] transition-transform hover:scale-105">
          {{ $heroContent['primary_button_label'] ?: 'Explore Careers' }}
        </a>
      </div>
    </div>
  </section>

  <section class="bg-white py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
      <div class="mb-12 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
          <h2 class="text-3xl font-bold text-[#002147]">Partner Businesses</h2>
          <div class="mt-2 h-1 w-20 rounded-full bg-[#d4af37]"></div>
        </div>
        <p class="max-w-2xl text-slate-600 md:text-right">Show the businesses and organizations Upturn has partnered with using their names, logos, and optional short notes managed directly from the Engagements admin panel.</p>
      </div>

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
        @forelse ($partnerBusinesses as $partner)
          <article class="flex h-full flex-col overflow-hidden rounded-[1.75rem] border border-slate-200 bg-[#f8fafc] shadow-sm transition-all hover:-translate-y-1 hover:shadow-xl">
            <div class="flex min-h-[13rem] items-center justify-center border-b border-slate-200 bg-white p-8">
              @if ($partner['primary_image_url'])
                <img src="{{ $partner['primary_image_url'] }}" alt="{{ $partner['title'] }} logo" class="max-h-24 w-full object-contain"/>
              @else
                <div class="flex h-24 w-24 items-center justify-center rounded-full bg-[#1152d4]/10 text-[#1152d4]">
                  <span class="material-symbols-outlined text-4xl">business</span>
                </div>
              @endif
            </div>
            <div class="flex flex-1 flex-col gap-3 p-6">
              @if ($partner['label'])
                <span class="inline-flex w-fit rounded-full bg-[#1152d4]/10 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-[#1152d4]">
                  {{ $partner['label'] }}
                </span>
              @endif
              <h3 class="text-xl font-bold text-slate-900">{{ $partner['title'] }}</h3>
              @if (filled($partner['description']))
                <p class="text-sm leading-relaxed text-slate-600">{{ $partner['excerpt'] }}</p>
              @endif
            </div>
          </article>
        @empty
          <div class="sm:col-span-2 xl:col-span-4 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h3 class="text-xl font-bold text-slate-900">No partner businesses published yet.</h3>
            <p class="mt-3 text-slate-600">Create Engagement entries under Partner Businesses so admin and staff can publish business names and logos here.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="bg-[#f6f8fc] py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
      <div class="mb-12 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
          <h2 class="text-3xl font-bold text-[#002147]">Client Success Stories</h2>
          <div class="mt-2 h-1 w-20 rounded-full bg-[#d4af37]"></div>
        </div>
        <p class="max-w-2xl text-slate-600 md:text-right">Publish stories that highlight how your services helped clients grow, stay compliant, or solve complex business challenges.</p>
      </div>

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        @forelse ($clientSuccessStories as $story)
          <button
            type="button"
            data-engagement-trigger
            data-engagement='@json($story)'
            class="group overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white text-left shadow-sm transition-all hover:-translate-y-1 hover:shadow-xl"
          >
            @if ($story['primary_image_url'])
              <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                <img src="{{ $story['primary_image_url'] }}" alt="{{ $story['title'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"/>
              </div>
            @else
              <div class="flex aspect-[4/3] flex-col justify-between bg-[linear-gradient(135deg,#0c2b5e_0%,#1152d4_45%,#0c1424_100%)] p-6 text-white">
                <div class="flex items-center justify-between">
                  <span class="material-symbols-outlined text-4xl text-[#d4af37]">workspace_premium</span>
                  <span class="rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-white/90">Client Win</span>
                </div>
                <div class="space-y-3">
                  @if ($story['label'])
                    <span class="inline-flex rounded-full bg-[#d4af37]/20 px-3 py-1 text-xs font-bold uppercase tracking-[0.22em] text-[#f4dc80]">
                      {{ $story['label'] }}
                    </span>
                  @endif
                  <p class="max-w-sm text-xl font-black leading-tight text-white/95">{{ $story['title'] }}</p>
                </div>
              </div>
            @endif
            <div class="space-y-4 p-6">
              @if ($story['label'])
                <span class="inline-flex rounded-full bg-[#d4af37]/15 px-3 py-1 text-xs font-bold uppercase tracking-[0.22em] text-[#8b6b12]">
                  {{ $story['label'] }}
                </span>
              @endif
              <h3 class="text-2xl font-bold text-slate-900">{{ $story['title'] }}</h3>
              <p class="text-sm leading-relaxed text-slate-600">{{ $story['excerpt'] }}</p>
              <div class="pt-2 text-sm font-semibold text-[#1152d4]">Read success story</div>
            </div>
          </button>
        @empty
          <div class="lg:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-white px-8 py-12 text-center">
            <h3 class="text-xl font-bold text-slate-900">No client success stories published yet.</h3>
            <p class="mt-3 text-slate-600">Add Engagement entries under Client Success Stories so admin and staff can manage testimonials, case summaries, and outcome-driven stories here.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="border-y border-slate-100 bg-white py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
      <div class="mb-16 text-center">
        <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">{{ $introContent['label'] ?: 'Milestones' }}</p>
        <h2 class="mt-4 text-4xl font-bold text-[#002147]">{{ $introContent['title'] ?: 'Milestones and Celebrations' }}</h2>
        <p class="mt-4 text-slate-500">{{ $introContent['description'] ?: 'A decade of growth, partnership, and steady professional excellence.' }}</p>
        <div class="mt-4 flex justify-center">
          <div class="h-1 w-24 rounded-full bg-[#d4af37]"></div>
        </div>
      </div>
      <div class="grid gap-8 lg:grid-cols-4">
        @foreach ([
          ['stars', 'Founding Year', '2014', 'Established our vision for business transformation and tax compliance excellence.'],
          ['public', 'Regional Expansion', '2018', 'Expanded our footprint and widened the support we offer to growing enterprises.'],
          ['workspace_premium', 'Client Leadership', '2022', 'Recognized for consistency, responsiveness, and trusted advisory relationships.'],
          ['celebration', '10 Year Milestone', '2024', 'Celebrated a decade of partnership, delivery, and team achievement.'],
        ] as $milestone)
          <div class="flex flex-col items-center rounded-2xl border border-slate-200 bg-[#f8fafc] px-6 py-8 text-center">
            <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-[#002147] text-[#d4af37] shadow-lg">
              <span class="material-symbols-outlined text-2xl">{{ $milestone[0] }}</span>
            </div>
            <h3 class="text-lg font-bold text-[#002147]">{{ $milestone[1] }}</h3>
            <p class="mt-1 text-sm font-medium text-slate-500">{{ $milestone[2] }}</p>
            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $milestone[3] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bg-[#f6f6f8] py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
      <div class="relative flex flex-col items-center justify-between gap-6 overflow-hidden rounded-2xl bg-[#1152d4] p-10 md:flex-row">
        <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10"></div>
        <div class="relative z-10 text-white">
          <h2 class="text-2xl font-bold">{{ $ctaContent['title'] ?: 'Want to partner with us?' }}</h2>
          <p class="mt-2 text-white/80">{{ $ctaContent['description'] ?: 'Tell us about your business and we will tailor a solution around your goals.' }}</p>
        </div>
        <a href="{{ $ctaContent['primary_button_url'] ?: route('contact') }}" class="relative z-10 whitespace-nowrap rounded-lg bg-[#d4af37] px-8 py-3 font-bold text-slate-900 shadow-lg transition-all hover:brightness-110">
          {{ $ctaContent['primary_button_label'] ?: 'Start a Conversation' }}
        </a>
      </div>
    </div>
  </section>

  <div id="engagement-modal" class="fixed inset-0 z-[80] hidden">
    <div data-engagement-overlay class="absolute inset-0 bg-slate-950/75 backdrop-blur-sm"></div>

    <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
      <div class="relative w-full max-w-6xl overflow-hidden rounded-3xl bg-white shadow-2xl">
        <button
          type="button"
          data-engagement-close
          class="absolute right-4 top-4 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-slate-900/80 text-white transition hover:bg-slate-900"
        >
          <span class="material-symbols-outlined">close</span>
        </button>

        <div class="grid gap-0 lg:grid-cols-[1.1fr_0.9fr]">
          <div class="relative bg-slate-900">
            <img id="engagement-modal-image" src="{{ $fallbackImage }}" alt="" class="h-[320px] w-full object-cover sm:h-[420px] lg:h-[620px]"/>

            <div id="engagement-modal-controls" class="absolute inset-x-0 bottom-5 flex items-center justify-between px-5">
              <button
                type="button"
                data-engagement-prev
                class="flex h-11 w-11 items-center justify-center rounded-full bg-black/65 text-white transition hover:bg-black/85"
              >
                <span class="material-symbols-outlined">chevron_left</span>
              </button>

              <div id="engagement-modal-counter" class="rounded-full bg-black/65 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-white">
                1 / 1
              </div>

              <button
                type="button"
                data-engagement-next
                class="flex h-11 w-11 items-center justify-center rounded-full bg-black/65 text-white transition hover:bg-black/85"
              >
                <span class="material-symbols-outlined">chevron_right</span>
              </button>
            </div>
          </div>

          <div class="flex flex-col justify-between gap-8 p-6 sm:p-8 lg:p-10">
            <div class="space-y-5">
              <div class="space-y-3">
                <p id="engagement-modal-label" class="text-xs font-bold uppercase tracking-[0.3em] text-[#1152d4]"></p>
                <h3 id="engagement-modal-title" class="text-3xl font-black text-slate-900 sm:text-4xl"></h3>
              </div>

              <p id="engagement-modal-description" class="whitespace-pre-line text-sm leading-7 text-slate-600 sm:text-base"></p>
            </div>

            <div class="space-y-4">
              <div id="engagement-modal-thumbs" class="grid grid-cols-4 gap-3 sm:grid-cols-5"></div>
              <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Engagement preview</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  (function () {
    const modal = document.getElementById('engagement-modal');
    const overlay = modal?.querySelector('[data-engagement-overlay]');
    const closeButton = modal?.querySelector('[data-engagement-close]');
    const prevButton = modal?.querySelector('[data-engagement-prev]');
    const nextButton = modal?.querySelector('[data-engagement-next]');
    const image = document.getElementById('engagement-modal-image');
    const label = document.getElementById('engagement-modal-label');
    const title = document.getElementById('engagement-modal-title');
    const description = document.getElementById('engagement-modal-description');
    const thumbs = document.getElementById('engagement-modal-thumbs');
    const counter = document.getElementById('engagement-modal-counter');
    const controls = document.getElementById('engagement-modal-controls');
    const fallbackImage = @json($fallbackImage);

    if (!modal || !overlay || !closeButton || !prevButton || !nextButton || !image || !label || !title || !description || !thumbs || !counter || !controls) {
      return;
    }

    let activeImages = [];
    let activeIndex = 0;

    const render = () => {
      const imageSource = activeImages[activeIndex] || fallbackImage;
      image.src = imageSource;
      counter.textContent = `${activeIndex + 1} / ${Math.max(activeImages.length, 1)}`;
      controls.style.display = activeImages.length > 1 ? 'flex' : 'none';

      thumbs.innerHTML = '';

      if (activeImages.length <= 1) {
        return;
      }

      activeImages.forEach((imageUrl, index) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = `overflow-hidden rounded-xl border-2 transition ${index === activeIndex ? 'border-[#1152d4]' : 'border-slate-200'}`;
        button.innerHTML = `<img src="${imageUrl}" alt="" class="h-16 w-full object-cover">`;
        button.addEventListener('click', () => {
          activeIndex = index;
          render();
        });
        thumbs.appendChild(button);
      });
    };

    const openModal = (item) => {
      activeImages = Array.isArray(item.images) && item.images.length ? item.images : [fallbackImage];
      activeIndex = 0;
      label.textContent = [item.section_label, item.label].filter(Boolean).join(' | ');
      title.textContent = item.title || 'Engagement';
      description.textContent = item.description || '';
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      render();
    };

    const closeModal = () => {
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    };

    document.querySelectorAll('[data-engagement-trigger]').forEach((trigger) => {
      trigger.addEventListener('click', () => {
        const raw = trigger.getAttribute('data-engagement');

        if (!raw) {
          return;
        }

        openModal(JSON.parse(raw));
      });
    });

    prevButton.addEventListener('click', () => {
      if (!activeImages.length) {
        return;
      }

      activeIndex = (activeIndex - 1 + activeImages.length) % activeImages.length;
      render();
    });

    nextButton.addEventListener('click', () => {
      if (!activeImages.length) {
        return;
      }

      activeIndex = (activeIndex + 1) % activeImages.length;
      render();
    });

    overlay.addEventListener('click', closeModal);
    closeButton.addEventListener('click', closeModal);

    document.addEventListener('keydown', (event) => {
      if (modal.classList.contains('hidden')) {
        return;
      }

      if (event.key === 'Escape') {
        closeModal();
      }

      if (event.key === 'ArrowLeft' && activeImages.length > 1) {
        activeIndex = (activeIndex - 1 + activeImages.length) % activeImages.length;
        render();
      }

      if (event.key === 'ArrowRight' && activeImages.length > 1) {
        activeIndex = (activeIndex + 1) % activeImages.length;
        render();
      }
    });
  })();
</script>
@endpush
