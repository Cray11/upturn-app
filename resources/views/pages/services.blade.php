@extends('layouts.app')
@section('title', 'Our Services - Upturn Business Solutions')
@section('content')
  @php
    $heroContent = $pageSections['hero'] ?? [];
    $introContent = $pageSections['intro'] ?? [];
    $ctaContent = $pageSections['cta'] ?? [];
  @endphp

  <div class="relative overflow-hidden bg-[#0c2b5e]">
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, #d4af37 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative z-10 mx-auto max-w-[1200px] px-6 py-24 md:py-28">
      <div class="max-w-4xl">
        <span class="mb-3 inline-block text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $heroContent['label'] ?: 'Our Expertise' }}</span>
        <h1 class="mb-6 text-4xl font-black leading-tight tracking-tight text-white md:text-6xl">{{ $heroContent['title'] ?: 'Comprehensive Business Solutions' }}</h1>
        <p class="max-w-3xl text-lg font-medium text-slate-200 md:text-xl">{{ $heroContent['description'] ?: 'From one-time compliance projects to ongoing retainer support, annual audit engagements, virtual office solutions, and conference room rentals, Upturn helps businesses stay compliant and ready to grow.' }}</p>
      </div>
    </div>
  </div>

  <div class="flex flex-1 justify-center px-4 py-6 md:px-20 md:py-10">
    <div class="flex w-full max-w-[1100px] flex-1 flex-col">

      <div class="mb-10 rounded-3xl border border-slate-200 bg-slate-50 px-6 py-8 md:px-8">
        <span class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $introContent['label'] ?: 'Service Portfolio' }}</span>
        <h2 class="mt-3 text-3xl font-black text-slate-900 md:text-4xl">{{ $introContent['title'] ?: 'Solutions tailored to each stage of business growth' }}</h2>
        <p class="mt-4 max-w-3xl text-base leading-relaxed text-slate-600">{{ $introContent['description'] ?: 'Choose from one-time engagements, monthly retainer services, annual audit support, virtual office rental, and conference room solutions based on your operational needs.' }}</p>
        <p class="mt-3 text-sm font-medium text-[#1152d4]">Open a preview to see the full service description and image before requesting a quote.</p>
      </div>

      <div class="grid grid-cols-1 gap-6 p-0 md:grid-cols-2 md:p-4">
        @forelse ($services as $service)
          <div
            class="group flex cursor-pointer flex-col items-stretch gap-6 rounded-[1.75rem] border border-slate-100 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl md:flex-row"
            data-service-preview-open="{{ $service['slug'] }}"
            role="button"
            tabindex="0"
            aria-label="Preview {{ $service['title'] }}"
          >
            <div class="flex flex-1 flex-col justify-between gap-4">
              <div class="flex flex-col gap-2">
                <div class="mb-2 flex h-12 w-12 items-center justify-center rounded-lg bg-[#1152d4]/10 text-[#1152d4]">
                  <span class="material-symbols-outlined text-3xl">{{ $service['icon'] }}</span>
                </div>
                <h3 class="text-xl font-bold leading-tight text-slate-900">{{ $service['title'] }}</h3>
                <p class="text-sm leading-relaxed text-slate-600">
                  {{ $service['description'] }}
                  <span class="font-semibold text-[#1152d4]">...see more</span>
                </p>
                @if ($service['price_label'])
                  <p class="text-sm font-semibold text-[#1152d4]">{{ $service['price_label'] }}</p>
                @endif
              </div>
              <div class="flex flex-col gap-3 sm:flex-row">
                <a href="{{ $service['quote_url'] }}" data-service-preview-action class="flex h-11 items-center justify-center rounded-lg bg-slate-100 px-6 text-sm font-bold text-[#1152d4] transition-all hover:bg-[#1152d4] hover:text-white">
                  Request a Quote
                </a>
              </div>
            </div>
            <div class="hidden h-40 w-full flex-none rounded-lg bg-cover bg-center bg-no-repeat sm:block md:h-auto md:w-40" style="background-image: url('{{ $service['image_url'] ?: 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=900&q=80' }}');"></div>
          </div>
        @empty
          <div class="md:col-span-2 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h3 class="text-2xl font-bold text-slate-900">No active services are published yet.</h3>
            <p class="mt-3 text-slate-600">Please contact our team directly and we will recommend the best service for your business needs.</p>
          </div>
        @endforelse
      </div>

      @if ($services->isNotEmpty())
        <div id="service-preview-modal" class="fixed inset-0 z-[80] hidden" aria-hidden="true">
          <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm" data-service-preview-overlay></div>
          <div class="relative flex min-h-full items-center justify-center p-4 md:p-8">
            <div class="relative w-full max-w-5xl overflow-hidden rounded-[2rem] bg-white shadow-[0_32px_90px_rgba(15,23,42,0.35)]" data-service-preview-dialog>
              <button type="button" class="absolute right-4 top-4 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-slate-900/70 text-white transition-colors hover:bg-slate-900" data-service-preview-close aria-label="Close preview">
                <span class="material-symbols-outlined text-xl">close</span>
              </button>

              <div class="max-h-[88vh] overflow-y-auto">
                @foreach ($services as $service)
                  <div class="hidden" data-service-preview-panel="{{ $service['slug'] }}">
                    <div class="grid lg:grid-cols-[0.95fr_1.05fr]">
                      <div class="min-h-[18rem] bg-[#0c1424] lg:min-h-[36rem]">
                        <div class="h-full w-full bg-cover bg-center" style="background-image: linear-gradient(180deg, rgba(7,17,31,0.16), rgba(7,17,31,0.5)), url('{{ $service['image_url'] ?: 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=1200&q=80' }}');"></div>
                      </div>

                      <div class="p-6 md:p-10">
                        <p class="text-xs font-bold uppercase tracking-[0.28em] text-[#d4af37]">Service Preview</p>
                        <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                          <h3 class="text-3xl font-black tracking-tight text-slate-900 md:text-4xl">{{ $service['title'] }}</h3>
                          @if ($service['price_label'])
                            <span class="rounded-full bg-[#1152d4]/10 px-4 py-2 text-sm font-bold text-[#1152d4]">{{ $service['price_label'] }}</span>
                          @endif
                        </div>

                        <div class="mt-6 rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6">
                          <p class="text-sm leading-8 text-slate-600">{!! nl2br(e($service['details'])) !!}</p>
                        </div>

                        <div class="mt-6 rounded-[1.5rem] border border-[#1152d4]/12 bg-[#f6f9ff] p-6">
                          <p class="text-xs font-bold uppercase tracking-[0.28em] text-[#1152d4]">What happens next</p>
                          <div class="mt-4 space-y-3">
                            <div class="flex items-start gap-3">
                              <span class="material-symbols-outlined mt-0.5 text-[#1152d4]">check_circle</span>
                              <p class="text-sm leading-7 text-slate-600">We begin with a discovery call or consultation to understand your needs and confirm the right service.</p>
                            </div>
                            <div class="flex items-start gap-3">
                              <span class="material-symbols-outlined mt-0.5 text-[#1152d4]">check_circle</span>
                              <p class="text-sm leading-7 text-slate-600">You receive a customized quote and engagement confirmation before onboarding or kickoff begins.</p>
                            </div>
                            <div class="flex items-start gap-3">
                              <span class="material-symbols-outlined mt-0.5 text-[#1152d4]">check_circle</span>
                              <p class="text-sm leading-7 text-slate-600">After execution, deliverables are completed and final or monthly billing follows the agreed arrangement.</p>
                            </div>
                          </div>
                        </div>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                          <a href="{{ $service['quote_url'] }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#1152d4] px-7 py-4 text-sm font-bold uppercase tracking-[0.16em] text-white transition-all hover:bg-[#0f48bc]">
                            Request a Quote
                            <span class="material-symbols-outlined text-base">north_east</span>
                          </a>
                          <a href="{{ route('contact') }}#contact-form" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 px-7 py-4 text-sm font-bold uppercase tracking-[0.16em] text-slate-700 transition-all hover:border-[#1152d4]/30 hover:bg-[#1152d4]/5 hover:text-[#1152d4]">
                            Contact Us
                            <span class="material-symbols-outlined text-base">mail</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      @endif

      <section class="mt-12 rounded-3xl bg-[#0c1424] px-6 py-10 text-white md:px-10 md:py-14">
        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
          <div class="max-w-2xl space-y-3">
            <span class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $ctaContent['label'] ?: 'Workspace Solutions' }}</span>
            <h2 class="text-3xl font-black md:text-4xl">{{ $ctaContent['title'] ?: 'Flexible virtual office and conference room options' }}</h2>
            <p class="text-slate-300">{{ $ctaContent['description'] ?: 'Give your business a professional address and a reliable meeting space with support designed for startups, remote teams, consultants, and growing businesses.' }}</p>
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
              <p class="mt-3 text-slate-300">Please contact our team for current availability, virtual office options, and workspace recommendations.</p>
            </div>
          @endforelse
        </div>
      </section>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  (function () {
    const modal = document.getElementById('service-preview-modal');
    const overlay = modal?.querySelector('[data-service-preview-overlay]');
    const closeButton = modal?.querySelector('[data-service-preview-close]');
    const dialog = modal?.querySelector('[data-service-preview-dialog]');
    const panels = modal?.querySelectorAll('[data-service-preview-panel]');
    const openButtons = document.querySelectorAll('[data-service-preview-open]');

    if (!modal || !overlay || !closeButton || !dialog || !panels?.length || !openButtons.length) {
      return;
    }

    const hidePanels = () => {
      panels.forEach((panel) => {
        panel.classList.add('hidden');
      });
    };

    const openModal = (serviceSlug) => {
      const targetPanel = modal.querySelector(`[data-service-preview-panel="${serviceSlug}"]`);

      if (!targetPanel) {
        return;
      }

      hidePanels();
      targetPanel.classList.remove('hidden');
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
      modal.classList.add('hidden');
      hidePanels();
      document.body.style.overflow = '';
    };

    openButtons.forEach((button) => {
      button.addEventListener('click', (event) => {
        if (event.target.closest('[data-service-preview-action]')) {
          return;
        }

        openModal(button.getAttribute('data-service-preview-open'));
      });

      button.addEventListener('keydown', (event) => {
        if (event.key !== 'Enter' && event.key !== ' ') {
          return;
        }

        if (event.target.closest('[data-service-preview-action]')) {
          return;
        }

        event.preventDefault();
        openModal(button.getAttribute('data-service-preview-open'));
      });
    });

    closeButton.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);
    modal.addEventListener('click', (event) => {
      if (!dialog.contains(event.target)) {
        closeModal();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
      }
    });
  })();
</script>
@endpush
