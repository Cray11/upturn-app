@extends('layouts.app')
@section('title', 'Careers - Upturn Business Solutions')

@push('head')
<style>
  .masonry-grid { columns: 1; gap: 1.5rem; }
  @media (min-width: 768px) { .masonry-grid { columns: 2; } }
  @media (min-width: 1024px) { .masonry-grid { columns: 3; } }
</style>
@endpush

@section('content')
  @php
    $fallbackImage = 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1200&q=80';
    $heroContent = $pageSections['hero'] ?? [];
    $introContent = $pageSections['intro'] ?? [];
    $ctaContent = $pageSections['cta'] ?? [];
    $careersVideoUrl = 'https://www.youtube.com/embed/_OYqHFQbgBw?rel=0';
    $secondaryHeroUrl = ($heroContent['secondary_button_url'] ?? null) === '#culture'
        ? '#culture-gallery'
        : ($heroContent['secondary_button_url'] ?: '#culture-gallery');
  @endphp

  <div class="relative overflow-hidden bg-[#0c2b5e]">
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, #d4af37 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative z-10 mx-auto max-w-[1200px] px-6 py-24 text-center md:py-28">
      <div class="mx-auto flex max-w-4xl flex-col gap-6">
        <span class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $heroContent['label'] ?: 'Join Our Team' }}</span>
        <h1 class="text-4xl font-black leading-tight tracking-tight text-white md:text-6xl">{{ $heroContent['title'] ?: 'Shape the Future of Business Solutions' }}</h1>
        <p class="mx-auto max-w-2xl text-lg font-normal text-slate-200 md:text-xl">{{ $heroContent['description'] ?: 'Join a team that values compliance, collaboration, continuous learning, and meaningful client impact.' }}</p>
        <div class="mt-4 flex flex-wrap justify-center gap-4">
          <a href="{{ $heroContent['primary_button_url'] ?: '#openings' }}" class="inline-flex h-12 min-w-[160px] items-center justify-center rounded-lg bg-[#1152d4] px-6 text-base font-bold text-white transition-all hover:brightness-110">{{ $heroContent['primary_button_label'] ?: 'View Openings' }}</a>
          <a href="{{ $secondaryHeroUrl }}" class="inline-flex h-12 min-w-[160px] items-center justify-center rounded-lg border border-white/20 bg-white/10 px-6 text-base font-bold text-white backdrop-blur-md transition-all hover:bg-white/20">{{ $heroContent['secondary_button_label'] ?: 'Our Culture' }}</a>
        </div>
      </div>
    </div>
  </div>

  <div id="culture" class="bg-white px-4 py-16 md:px-20">
    <div class="mx-auto max-w-6xl">
      <div class="mb-12 text-center">
        <p class="text-sm font-bold uppercase tracking-widest text-[#fbbf24]">{{ $introContent['label'] ?: 'Inside Upturn' }}</p>
        <h2 class="mt-4 text-3xl font-bold leading-tight text-slate-900">{{ $introContent['title'] ?: 'Our Work Culture' }}</h2>
        <div class="mx-auto mt-4 h-1 w-20 rounded-full bg-[#fbbf24]"></div>
        <p class="mx-auto mt-6 max-w-2xl text-slate-600">{{ $introContent['description'] ?: 'At Upturn, we value integrity, adaptability, innovation, teamwork, and respect as we help clients navigate complex business and tax challenges.' }}</p>
      </div>
      <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        @foreach([
          ['verified_user', 'Integrity and Excellence', 'We hold ourselves to high standards of professionalism, accuracy, accountability, and ethical service.'],
          ['bolt', 'Adaptable and Innovative', 'We stay proactive, open to change, and committed to continuous learning so our team and clients can keep moving forward.'],
          ['groups', 'Teamwork and Respect', 'We collaborate across departments with empathy and respect, knowing great work comes from strong relationships and shared effort.'],
        ] as $value)
          <div class="flex flex-col gap-5 rounded-xl border border-slate-200 bg-white p-8 shadow-sm transition-shadow hover:shadow-md">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-[#1152d4]/10 text-[#1152d4]">
              <span class="material-symbols-outlined text-3xl">{{ $value[0] }}</span>
            </div>
            <div class="flex flex-col gap-2">
              <h3 class="text-xl font-bold text-slate-900">{{ $value[1] }}</h3>
              <p class="text-base leading-relaxed text-slate-600">{{ $value[2] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <section class="bg-[#f8fafc] px-4 py-16 md:px-20">
    <div class="mx-auto max-w-6xl">
      <div class="mb-8 text-center">
        <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">Careers Video</p>
        <h2 class="mt-4 text-3xl font-bold leading-tight text-slate-900 md:text-4xl">See what life at Upturn looks like</h2>
        <p class="mx-auto mt-4 max-w-3xl text-base leading-relaxed text-slate-600">Watch this video to get a better feel for the team, the workplace, and the kind of environment you will be stepping into before you explore our current openings.</p>
      </div>

      <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-950 shadow-[0_24px_70px_rgba(15,23,42,0.18)]">
        <div class="aspect-video">
          <iframe
            src="{{ $careersVideoUrl }}"
            title="Upturn careers video"
            class="h-full w-full"
            loading="lazy"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </div>
  </section>

  <section id="culture-gallery" class="bg-[#002147] py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
      <div class="mb-12 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
          <h2 class="text-3xl font-bold text-[#d4af37]">Culture Gallery</h2>
          <div class="mt-2 h-1 w-20 rounded-full bg-[#d4af37]"></div>
        </div>
        <p class="max-w-2xl text-slate-300 md:text-right">A snapshot of the teams, celebrations, and shared moments that shape what it feels like to build a career at Upturn.</p>
      </div>

      <div class="masonry-grid">
        @forelse ($cultureGallery as $photo)
          <div class="mb-8 break-inside-avoid px-2">
            <button
              type="button"
              data-culture-trigger
              data-culture='@json($photo)'
              class="group w-full overflow-hidden rounded-lg border-[8px] border-white bg-white text-left shadow-2xl transition-transform hover:-translate-y-1"
            >
              <img src="{{ $photo['primary_image_url'] ?: $fallbackImage }}" alt="{{ $photo['title'] }}" class="w-full object-cover"/>
              <div class="border-t border-slate-100 bg-white p-4">
                <p class="text-sm italic text-[#002147]">{{ $photo['title'] }}</p>
                @if ($photo['image_count'] > 1)
                  <p class="mt-1 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $photo['image_count'] }} images</p>
                @endif
              </div>
            </button>
          </div>
        @empty
          <div class="rounded-3xl border border-dashed border-white/15 bg-white/5 px-8 py-12 text-center text-white">
            <h3 class="text-xl font-bold">No culture gallery items published yet.</h3>
            <p class="mt-3 text-slate-300">Team moments, celebrations, and workplace highlights will be featured here soon.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <div id="openings" class="px-4 py-16 md:px-20">
    <div class="mx-auto max-w-6xl">
      <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
          <h2 class="text-3xl font-bold text-slate-900">Current Opportunities</h2>
          <p class="mt-2 text-slate-600">Find your next career milestone with a team built on integrity, excellence, and client-focused work.</p>
        </div>
        <div class="flex gap-2">
          <span class="rounded-full border border-[#1152d4]/20 bg-[#1152d4]/10 px-4 py-2 text-sm font-semibold text-[#1152d4]">All Departments</span>
        </div>
      </div>

      <div class="flex flex-col gap-4">
        @forelse ($jobPostings as $jobPosting)
          <div class="group flex flex-col items-start justify-between rounded-xl border border-slate-200 bg-white p-6 transition-all cursor-pointer hover:border-[#1152d4]/50 md:flex-row md:items-center">
            <div class="flex flex-col gap-1">
              <h4 class="text-lg font-bold text-slate-900 transition-colors group-hover:text-[#1152d4]">{{ $jobPosting->title }}</h4>
              <div class="flex items-center gap-4 text-sm text-slate-500">
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span> {{ $jobPosting->location }}</span>
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">schedule</span> {{ str($jobPosting->employment_type)->replace('_', ' ')->title() }}</span>
              </div>
            </div>
            <a href="{{ route('careers.show', $jobPosting) }}" class="mt-4 w-full rounded-lg border-2 border-[#1152d4] px-6 py-2 text-center font-bold text-[#1152d4] transition-all hover:bg-[#1152d4] hover:text-white md:mt-0 md:w-auto">
              Apply Now
            </a>
          </div>
        @empty
          <div class="rounded-xl border border-slate-200 bg-white p-6 text-sm text-slate-600">
            No open positions are published yet. Check back soon for new opportunities.
          </div>
        @endforelse
      </div>

      <div class="relative mt-12 flex flex-col items-center justify-between gap-6 overflow-hidden rounded-2xl bg-[#1152d4] p-8 text-white md:flex-row">
        <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10"></div>
        <div class="relative z-10">
          <h3 class="text-2xl font-bold">{{ $ctaContent['title'] ?: 'Don\'t see a perfect match?' }}</h3>
          <p class="mt-2 opacity-90">{{ $ctaContent['description'] ?: 'We still welcome talented professionals who want to grow with a team committed to service, compliance, and long-term success.' }}</p>
        </div>
        <a href="{{ $ctaContent['primary_button_url'] ?: route('contact') }}" class="relative z-10 w-full rounded-lg bg-[#fbbf24] px-8 py-3 text-center font-bold text-slate-900 shadow-lg transition-all hover:brightness-110 active:scale-95 md:w-auto">
          {{ $ctaContent['primary_button_label'] ?: 'Contact HR' }}
        </a>
      </div>
    </div>
  </div>

  <div id="culture-modal" class="fixed inset-0 z-[80] hidden">
    <div data-culture-overlay class="absolute inset-0 bg-slate-950/75 backdrop-blur-sm"></div>

    <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
      <div class="relative w-full max-w-6xl overflow-hidden rounded-3xl bg-white shadow-2xl">
        <button
          type="button"
          data-culture-close
          class="absolute right-4 top-4 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-slate-900/80 text-white transition hover:bg-slate-900"
        >
          <span class="material-symbols-outlined">close</span>
        </button>

        <div class="grid gap-0 lg:grid-cols-[1.1fr_0.9fr]">
          <div class="relative bg-slate-900">
            <img id="culture-modal-image" src="{{ $fallbackImage }}" alt="" class="h-[320px] w-full object-cover sm:h-[420px] lg:h-[620px]"/>

            <div id="culture-modal-controls" class="absolute inset-x-0 bottom-5 flex items-center justify-between px-5">
              <button
                type="button"
                data-culture-prev
                class="flex h-11 w-11 items-center justify-center rounded-full bg-black/65 text-white transition hover:bg-black/85"
              >
                <span class="material-symbols-outlined">chevron_left</span>
              </button>

              <div id="culture-modal-counter" class="rounded-full bg-black/65 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-white">
                1 / 1
              </div>

              <button
                type="button"
                data-culture-next
                class="flex h-11 w-11 items-center justify-center rounded-full bg-black/65 text-white transition hover:bg-black/85"
              >
                <span class="material-symbols-outlined">chevron_right</span>
              </button>
            </div>
          </div>

          <div class="flex flex-col justify-between gap-8 p-6 sm:p-8 lg:p-10">
            <div class="space-y-5">
              <div class="space-y-3">
                <p id="culture-modal-label" class="text-xs font-bold uppercase tracking-[0.3em] text-[#1152d4]"></p>
                <h3 id="culture-modal-title" class="text-3xl font-black text-slate-900 sm:text-4xl"></h3>
              </div>

              <p id="culture-modal-description" class="whitespace-pre-line text-sm leading-7 text-slate-600 sm:text-base"></p>
            </div>

            <div class="space-y-4">
              <div id="culture-modal-thumbs" class="grid grid-cols-4 gap-3 sm:grid-cols-5"></div>
              <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Culture preview</p>
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
    const modal = document.getElementById('culture-modal');
    const overlay = modal?.querySelector('[data-culture-overlay]');
    const closeButton = modal?.querySelector('[data-culture-close]');
    const prevButton = modal?.querySelector('[data-culture-prev]');
    const nextButton = modal?.querySelector('[data-culture-next]');
    const image = document.getElementById('culture-modal-image');
    const label = document.getElementById('culture-modal-label');
    const title = document.getElementById('culture-modal-title');
    const description = document.getElementById('culture-modal-description');
    const thumbs = document.getElementById('culture-modal-thumbs');
    const counter = document.getElementById('culture-modal-counter');
    const controls = document.getElementById('culture-modal-controls');
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
      title.textContent = item.title || 'Culture Gallery';
      description.textContent = item.description || '';
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      render();
    };

    const closeModal = () => {
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    };

    document.querySelectorAll('[data-culture-trigger]').forEach((trigger) => {
      trigger.addEventListener('click', () => {
        const raw = trigger.getAttribute('data-culture');

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
