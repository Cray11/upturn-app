@extends('layouts.app')
@section('title', 'Engagements - Upturn Business Solutions')

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
    $heroContent = $contentBlocks->get('hero', [
        'title' => 'Life at Upturn',
        'description' => 'Explore the projects, team moments, and culture highlights now managed directly from the engagement content module.',
        'primary_button_label' => 'Join Our Team',
        'primary_button_url' => route('careers'),
    ]);
    $introContent = $contentBlocks->get('intro', [
        'label' => 'Milestones',
        'title' => 'Milestones and Celebrations',
        'description' => 'A decade of growth, partnership, and steady professional excellence.',
    ]);
    $ctaContent = $contentBlocks->get('cta', [
        'title' => 'Want to partner with us?',
        'description' => 'Tell us about your business and we will tailor a solution around your goals.',
        'primary_button_label' => 'Start a Conversation',
        'primary_button_url' => route('contact'),
    ]);
  @endphp

  <section class="relative flex h-[500px] items-center justify-center overflow-hidden">
    <div class="absolute inset-0">
      <div class="absolute inset-0 z-10 bg-[#002147]/65"></div>
      <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUIOzRktQodlU4MRAvDpLqUPlzt2qh78jxVH-8hqn8YaMIlKlT9O8iJFghngm4h7PfINGb8-k7_NUASQ5qccfTFCAl7AD-ViME7O1xvFmLqpQACwYyANZWbXc5zFQ_mQX2GK3c2nhR29mK-ob1flmAmWrlw3jHfUlUqHxx56qVssVj_zmhqLAjEUeeBTi_prKxrEVmR_SFMJsE12vOS5DrkNeRDeJHOgcUd-KXOT1W_J8ju-4A6r1cyoEt4gDFSNLLtNCUsTgIO5wF" alt="Office culture" class="h-full w-full object-cover"/>
    </div>
    <div class="relative z-20 max-w-3xl px-4 text-center">
      <h1 class="text-5xl font-black tracking-tight text-white md:text-6xl">{{ $heroContent['title'] ?: 'Life at Upturn' }}</h1>
      <p class="mt-6 text-lg leading-relaxed text-white/90 md:text-xl">
        {{ $heroContent['description'] ?: 'Explore the projects, team moments, and culture highlights now managed directly from the engagement content module.' }}
      </p>
      <div class="mt-8 flex justify-center">
        <a href="{{ $heroContent['primary_button_url'] ?: route('careers') }}" class="rounded-xl bg-[#d4af37] px-8 py-4 text-lg font-bold text-[#002147] transition-transform hover:scale-105">
          {{ $heroContent['primary_button_label'] ?: 'Join Our Team' }}
        </a>
      </div>
    </div>
  </section>

  <section class="border-t border-slate-200 bg-[#f6f6f8] py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
      <div class="mb-8 flex items-center gap-2">
        <span class="material-symbols-outlined text-[#1152d4]">work</span>
        <h2 class="text-2xl font-bold text-slate-900">Latest Projects</h2>
      </div>

      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($latestProjects as $project)
          <button
            type="button"
            data-engagement-trigger
            data-engagement='@json($project)'
            class="group overflow-hidden rounded-xl border border-slate-200 bg-white text-left shadow-sm transition-all hover:-translate-y-1 hover:shadow-xl"
          >
            <div class="aspect-video overflow-hidden">
              <img src="{{ $project['primary_image_url'] ?: $fallbackImage }}" alt="{{ $project['title'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"/>
            </div>
            <div class="space-y-3 p-6">
              @if ($project['label'])
                <span class="inline-flex rounded-full bg-[#1152d4]/10 px-2.5 py-1 text-xs font-bold uppercase text-[#1152d4]">
                  {{ $project['label'] }}
                </span>
              @endif
              <h3 class="text-xl font-bold text-slate-900">{{ $project['title'] }}</h3>
              <p class="text-sm leading-relaxed text-slate-600">{{ $project['excerpt'] }}</p>
              <div class="flex items-center justify-between pt-2 text-sm font-semibold text-[#1152d4]">
                <span>Open details</span>
                @if ($project['image_count'] > 1)
                  <span>{{ $project['image_count'] }} images</span>
                @endif
              </div>
            </div>
          </button>
        @empty
          <div class="lg:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-white px-8 py-12 text-center">
            <h3 class="text-xl font-bold text-slate-900">No latest projects published yet.</h3>
            <p class="mt-3 text-slate-600">Create engagement entries under Latest Projects in the admin panel to fill this section.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="mx-auto max-w-7xl px-6 py-20 lg:px-10">
    <div class="mb-12 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <div>
        <h2 class="text-3xl font-bold text-[#002147]">Team Building Events</h2>
        <div class="mt-2 h-1 w-20 rounded-full bg-[#d4af37]"></div>
      </div>
      <p class="max-w-md text-slate-600 md:text-right">Highlighting the activities that strengthen collaboration and shape the way our team works together.</p>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
      @forelse ($teamBuildingEvents as $event)
        <button
          type="button"
          data-engagement-trigger
          data-engagement='@json($event)'
          class="group overflow-hidden rounded-2xl border border-slate-200 bg-white text-left shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl"
        >
          <div class="relative h-64 overflow-hidden">
            <img src="{{ $event['primary_image_url'] ?: $fallbackImage }}" alt="{{ $event['title'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"/>
          </div>
          <div class="space-y-3 p-6">
            @if ($event['label'])
              <span class="text-xs font-bold uppercase tracking-widest text-[#d4af37]">{{ $event['label'] }}</span>
            @endif
            <h3 class="text-xl font-bold text-[#002147]">{{ $event['title'] }}</h3>
            <p class="text-sm text-slate-600">{{ $event['excerpt'] }}</p>
            <div class="pt-2 text-sm font-semibold text-[#1152d4]">View event details</div>
          </div>
        </button>
      @empty
        <div class="lg:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
          <h3 class="text-xl font-bold text-slate-900">No team building events published yet.</h3>
          <p class="mt-3 text-slate-600">Add team building entries from content management to populate this section.</p>
        </div>
      @endforelse
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

  <section class="bg-[#002147] py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-[#d4af37]">Culture Gallery</h2>
        <div class="mt-2 h-1 w-20 rounded-full bg-[#d4af37]"></div>
      </div>

      <div class="masonry-grid">
        @forelse ($cultureGallery as $photo)
          <div class="mb-8 break-inside-avoid px-2">
            <button
              type="button"
              data-engagement-trigger
              data-engagement='@json($photo)'
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
            <p class="mt-3 text-slate-300">Add culture gallery entries from content management to display them here.</p>
          </div>
        @endforelse
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
