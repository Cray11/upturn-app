@extends('layouts.app')
@section('title', 'Upturn Business Solutions | Corporate Financial Excellence')
@section('content')
  @php
    $heroContent = $pageSections['hero'] ?? [];
    $introContent = $pageSections['intro'] ?? [];
    $pageContent = $pageContent ?? [];
    $trustSignals = data_get($pageContent, 'trust_signals', []);
    $trustCards = data_get($pageContent, 'trust_cards', []);
    $missionHighlights = data_get($pageContent, 'mission_highlights', []);
    $accreditationBadges = data_get($pageContent, 'accreditation_badges', []);
    $servicePrinciples = data_get($pageContent, 'service_principles', []);
    $featuredStats = data_get($pageContent, 'featured_stats', []);
    $featuredClients = data_get($pageContent, 'featured_clients', []);
    $deliveryPhases = data_get($pageContent, 'delivery_phases', []);
    $testimonialFormHasErrors = $errors->hasAny([
        'client_name',
        'company',
        'rating',
        'content',
    ]);
    $testimonialCount = is_countable($testimonials) ? count($testimonials) : 0;
    $testimonialMarqueeDuration = max(36, $testimonialCount * 7);
    $marqueeTestimonials = $testimonialCount > 1 ? $testimonials->concat($testimonials) : collect();
    $testimonialReviewNotes = data_get($pageContent, 'testimonial_review_notes', []);
  @endphp

  <section class="relative overflow-hidden bg-black text-white" style="height: calc(100dvh - 72px); min-height: calc(100vh - 72px);">
    <div class="pointer-events-none absolute inset-0 flex items-center justify-center overflow-hidden">
      <video
        class="absolute inset-0 m-auto block h-auto w-auto max-h-full max-w-full object-contain"
        autoplay
        muted
        loop
        playsinline
        aria-hidden="true"
      >
        <source src="{{ asset('images/videopresentation.mp4') }}" type="video/mp4">
      </video>
    </div>

    <div class="relative mx-auto flex h-full max-w-7xl items-end px-4 py-8 sm:px-6 sm:py-10 lg:px-8 lg:py-12">
      <div class="relative z-10 max-w-3xl space-y-8 text-center lg:text-left">
        <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.18)] backdrop-blur-sm">
          <span class="h-2 w-2 animate-pulse rounded-full bg-[#d4af37]"></span>
          {{ $heroContent['label'] ?: 'COMPLY. SECURE. GROW.' }}
        </div>
        <h1 class="text-5xl font-black leading-[1.05] tracking-tight text-white drop-shadow-[0_14px_38px_rgba(7,17,31,0.42)] lg:text-6xl xl:text-7xl">
          {{ $heroContent['title'] ?: 'Building Secure and Tax-Compliant Businesses' }}
        </h1>
        <p class="max-w-2xl text-lg leading-relaxed text-slate-200 lg:text-xl">
          {{ $heroContent['description'] ?: 'Your success is our priority. We provide tailored business solutions designed to keep you compliant, confident, and ready to grow.' }}
        </p>
        <div class="flex justify-center lg:justify-start">
          <a href="{{ $heroContent['primary_button_url'] ?: route('contact') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#1152d4] px-8 py-4 text-base font-bold text-white transition-all hover:-translate-y-0.5 hover:bg-[#0f48bc] hover:shadow-[0_18px_40px_rgba(17,82,212,0.35)]">
            {{ $heroContent['primary_button_label'] ?: 'Book Your Free Consultation Now!' }}
            <span class="material-symbols-outlined">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-[#f6f6f8] py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
        <div class="overflow-hidden rounded-[2rem] bg-[#0c1424] p-8 text-white shadow-2xl md:p-10">
          <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">{{ $introContent['label'] ?: 'Company Overview' }}</p>
          <h2 class="mt-5 text-4xl font-black leading-tight md:text-5xl">{{ $introContent['title'] ?: 'Trusted accounting and taxation support in Valenzuela City' }}</h2>
          <p class="mt-5 max-w-2xl text-base leading-8 text-slate-300 md:text-lg">
            {{ $introContent['description'] ?: 'Upturn Business Solutions is a Valenzuela City-based firm of Certified Public Accountants with over a decade of professional experience in accounting and taxation, helping clients stay compliant with BIR regulations and Philippine tax laws while reducing the risk of costly penalties.' }}
          </p>
          <div class="mt-8 grid gap-4 sm:grid-cols-3">
            @foreach ($trustSignals as $signal)
              <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm">
                <span class="material-symbols-outlined text-3xl text-[#d4af37]">{{ $signal['icon'] }}</span>
                <p class="mt-4 text-sm font-bold uppercase tracking-widest text-slate-200">{{ $signal['title'] }}</p>
              </div>
            @endforeach
          </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
          @foreach ($trustCards as $card)
            <div class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
              <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#1152d4]/10 text-[#1152d4]">
                <span class="material-symbols-outlined text-3xl">{{ $card['icon'] }}</span>
              </div>
              <h3 class="mt-6 text-xl font-bold text-slate-900">{{ $card['title'] }}</h3>
              <p class="mt-3 text-sm leading-7 text-slate-600">{{ $card['description'] }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-3xl text-center">
        <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">Our Mission</p>
        <h2 class="mt-4 text-4xl font-black text-slate-900 md:text-5xl">Driving sustainable growth through trusted compliance support</h2>
        <p class="mt-5 text-base leading-8 text-slate-600 md:text-lg">At Upturn Business Solutions, our mission is to be a trusted partner in driving sustainable growth, ensuring full tax compliance, and empowering business owners and professionals to achieve long-term success.</p>
      </div>
      <div class="mt-14 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($missionHighlights as $highlight)
          <div class="group rounded-[1.75rem] border border-slate-200 bg-[#f8fafc] p-7 transition-all duration-300 hover:-translate-y-1 hover:border-[#1152d4]/20 hover:shadow-xl">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#1152d4]/10 text-[#1152d4] transition-colors group-hover:bg-[#1152d4] group-hover:text-white">
              <span class="material-symbols-outlined text-3xl">{{ $highlight['icon'] }}</span>
            </div>
            <h3 class="mt-6 text-2xl font-bold text-slate-900">{{ $highlight['title'] }}</h3>
            <p class="mt-4 text-sm leading-7 text-slate-600">{{ $highlight['description'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="relative overflow-hidden bg-[#0c1424] py-24 text-white">
    <div class="pointer-events-none absolute inset-0 opacity-30">
      <div class="absolute left-0 top-0 h-80 w-80 rounded-full bg-[#1152d4]/30 blur-[110px]"></div>
      <div class="absolute bottom-0 right-0 h-72 w-72 rounded-full bg-[#d4af37]/20 blur-[110px]"></div>
    </div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="grid items-start gap-10 lg:grid-cols-[1.1fr_0.9fr]">
        <div>
          <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">BIR and Tax Compliance Support</p>
          <h2 class="mt-5 text-4xl font-black leading-tight md:text-5xl">Guidance for complex tax and compliance challenges</h2>
          <p class="mt-6 text-base leading-8 text-slate-300 md:text-lg">
            Upturn Business Solutions supports clients from transaction analysis to the accurate application and interpretation of tax regulations, helping reduce the risk of costly penalties and business disruption.
          </p>
          <p class="mt-5 text-base leading-8 text-slate-300">
            We also assist business owners during BIR audits by helping them navigate tax deficiencies through lawful compromises and available resolutions, with outcomes that can reduce liabilities from full assessments to far more manageable levels depending on the case.
          </p>
        </div>

        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-8 shadow-2xl backdrop-blur-sm">
          <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#d4af37]">Accreditations and Registrations</p>
          <div class="mt-8 space-y-4">
            @foreach ($accreditationBadges as $benefit)
              <div class="flex items-start gap-4 rounded-2xl border border-white/8 bg-white/5 px-4 py-4">
                <span class="material-symbols-outlined mt-0.5 text-[#d4af37]">check_circle</span>
                <div>
                  <p class="font-bold text-white">{{ $benefit }}</p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-[#f6f6f8] py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-3xl text-center">
        <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">Why Clients Choose Upturn</p>
        <h2 class="mt-4 text-4xl font-black text-slate-900 md:text-5xl">Trusted by businesses that value accuracy and reliability</h2>
      </div>
      <div class="mt-14 grid gap-8 lg:grid-cols-3">
        @foreach ($servicePrinciples as $principle)
          <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-lg">
            <div class="h-2 bg-gradient-to-r from-[#1152d4] via-[#1d4ed8] to-[#d4af37]"></div>
            <div class="p-8 md:p-10">
              <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#1152d4]/10 text-[#1152d4]">
                <span class="material-symbols-outlined text-4xl">{{ $principle['icon'] }}</span>
              </div>
              <h3 class="mt-6 text-3xl font-bold text-slate-900">{{ $principle['title'] }}</h3>
              <p class="mt-5 text-base leading-8 text-slate-600">{{ $principle['description'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bg-[#0c2b5e] py-24 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-3xl text-center">
        <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">Stats and Social Proof</p>
        <h2 class="mt-4 text-4xl font-black md:text-5xl">Trusted by businesses across industries</h2>
        <p class="mt-5 text-base leading-8 text-slate-200 md:text-lg">Our work is built on long-term client relationships, successful compliance support, and a growing team of professionals committed to service excellence.</p>
      </div>

      <div class="mt-14 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($featuredStats as $stat)
          <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-8 text-center shadow-lg backdrop-blur-sm">
            <p class="text-4xl font-black text-white md:text-5xl">{{ $stat['value'] }}</p>
            <p class="mt-3 text-sm font-bold uppercase tracking-[0.24em] text-[#d4af37]">{{ $stat['label'] }}</p>
          </div>
        @endforeach
      </div>

      <div class="mt-14 rounded-[2rem] border border-white/10 bg-white/5 p-8 md:p-10">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
          <div>
            <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">Trusted By</p>
            <h3 class="mt-3 text-3xl font-black text-white">Businesses and organizations we have supported</h3>
          </div>
          <p class="max-w-2xl text-sm leading-7 text-slate-200 md:text-right">A selection of companies named in the Upturn company profile, representing the range of industries we have worked with over the years.</p>
        </div>

        <div class="mt-8 flex flex-wrap gap-3">
          @foreach ($featuredClients as $client)
            <span class="rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm font-semibold text-white">{{ $client }}</span>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto mb-16 max-w-3xl space-y-4 text-center">
        <h2 class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">Our Services</h2>
        <h3 class="text-4xl font-bold text-slate-900">Solutions designed to keep your business compliant and moving forward</h3>
        <p class="text-slate-600">Explore Upturn services for one-time engagements, monthly compliance support, annual audit requirements, and workspace solutions for growing businesses.</p>
      </div>
      <div class="grid gap-8 md:grid-cols-3">
        @forelse ($services as $service)
          <div class="group rounded-2xl border border-slate-100 bg-[#f6f6f8] p-8 transition-all duration-300 hover:-translate-y-2 hover:bg-[#1152d4]">
            <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-[#1152d4]/10 transition-colors group-hover:bg-white/20">
              <span class="material-symbols-outlined text-3xl text-[#1152d4] group-hover:text-white">{{ $service['icon'] }}</span>
            </div>
            <h4 class="mb-4 text-xl font-bold text-slate-900 group-hover:text-white">{{ $service['title'] }}</h4>
            <p class="mb-4 leading-relaxed text-slate-600 group-hover:text-white/80">{{ $service['description'] }}</p>
            @if ($service['price_label'])
              <p class="mb-6 text-sm font-semibold text-[#1152d4] group-hover:text-[#d4af37]">{{ $service['price_label'] }}</p>
            @endif
            <a href="{{ route('services') }}" class="flex items-center gap-2 font-bold text-[#1152d4] group-hover:text-[#d4af37]">
              Learn More <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
          </div>
        @empty
          <div class="md:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h4 class="text-xl font-bold text-slate-900">Our service lineup will be published here soon.</h4>
            <p class="mt-3 text-slate-600">For immediate assistance, contact our team and we will guide you to the right service.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mb-16 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-2xl space-y-4">
          <h2 class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">Latest Updates</h2>
        </div>

        @if (($publishedPostsCount ?? $posts->count()) > $posts->count())
          <p class="text-sm font-semibold text-slate-500">
            Showing the latest {{ $posts->count() }} of {{ $publishedPostsCount }} published updates
          </p>
        @endif
      </div>
      <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($posts as $post)
          @if ($post['link_url'])
            <a href="{{ $post['link_url'] }}" class="group overflow-hidden rounded-3xl border border-slate-100 bg-[#f6f6f8] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
              <div class="h-48 w-full bg-cover bg-center" style="background-image: url('{{ $post['image_url'] ?: 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1200&q=80' }}');"></div>
              <div class="space-y-4 p-8">
                <div class="flex items-center justify-between gap-4 text-xs font-bold uppercase tracking-widest text-slate-500">
                  <span>{{ $post['category'] }}</span>
                  <span>{{ $post['published_at_label'] }}</span>
                </div>
                <h4 class="text-2xl font-bold text-slate-900 transition-colors group-hover:text-[#1152d4]">{{ $post['title'] }}</h4>
                <p class="text-sm leading-relaxed text-slate-600">{{ $post['excerpt'] }}</p>
                <div class="inline-flex items-center gap-2 text-sm font-bold text-[#1152d4]">
                  Open update <span class="material-symbols-outlined text-sm">north_east</span>
                </div>
              </div>
            </a>
          @else
            <article class="overflow-hidden rounded-3xl border border-slate-100 bg-[#f6f6f8]">
              <div class="h-48 w-full bg-cover bg-center" style="background-image: url('{{ $post['image_url'] ?: 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1200&q=80' }}');"></div>
              <div class="space-y-4 p-8">
                <div class="flex items-center justify-between gap-4 text-xs font-bold uppercase tracking-widest text-slate-500">
                  <span>{{ $post['category'] }}</span>
                  <span>{{ $post['published_at_label'] }}</span>
                </div>
                <h4 class="text-2xl font-bold text-slate-900">{{ $post['title'] }}</h4>
                <p class="text-sm leading-relaxed text-slate-600">{{ $post['excerpt'] }}</p>
              </div>
            </article>
          @endif
        @empty
          <div class="md:col-span-2 xl:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h4 class="text-xl font-bold text-slate-900">No updates are available right now.</h4>
            <p class="mt-3 text-slate-600">Please check back soon for announcements, insights, and company updates.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  @include('pages.home.partials.testimonial-section', [
    'testimonials' => $testimonials,
    'testimonialCount' => $testimonialCount,
    'testimonialMarqueeDuration' => $testimonialMarqueeDuration,
    'marqueeTestimonials' => $marqueeTestimonials,
  ])

  @include('pages.home.partials.testimonial-modal', [
    'testimonialFormHasErrors' => $testimonialFormHasErrors,
    'testimonialReviewNotes' => $testimonialReviewNotes,
  ])

  <section class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-3xl text-center">
        <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">How We Work</p>
        <h2 class="mt-4 text-4xl font-black text-slate-900 md:text-5xl">A clear client journey from planning to delivery</h2>
      </div>
      <div class="mt-14 grid gap-8 lg:grid-cols-3">
        @foreach ($deliveryPhases as $phase)
          <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-[#f8fafc] shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between border-b border-slate-200 px-7 py-6">
              <p class="text-xl font-black text-[#1152d4]">{{ $phase['number'] }}</p>
              <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-[#1152d4]/10 text-[#1152d4]">
                <span class="material-symbols-outlined text-3xl">{{ $phase['icon'] }}</span>
              </div>
            </div>
            <div class="p-7">
              <h3 class="text-2xl font-bold text-slate-900">{{ $phase['title'] }}</h3>
              <div class="mt-6 space-y-4">
                @foreach ($phase['items'] as $item)
                  <div class="flex gap-3">
                    <span class="material-symbols-outlined mt-0.5 text-[#d4af37]">check_circle</span>
                    <p class="text-sm leading-7 text-slate-600">{{ $item }}</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mb-12 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div class="max-w-2xl space-y-4">
          <h2 class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">Current Openings</h2>
          <h3 class="text-4xl font-bold text-slate-900">Opportunities to grow with the Upturn team</h3>
          <p class="text-slate-600">Explore current roles for professionals who want to work in an environment shaped by integrity, excellence, teamwork, and client impact.</p>
        </div>
        <a href="{{ route('careers') }}" class="inline-flex items-center gap-2 font-bold text-[#1152d4]">
          View all careers <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
      </div>
      <div class="grid gap-6 lg:grid-cols-3">
        @forelse ($jobPostings as $jobPosting)
          <a href="{{ route('careers.show', $jobPosting) }}" class="group rounded-3xl border border-slate-200 bg-[#f6f6f8] p-8 transition-all hover:-translate-y-1 hover:border-[#1152d4]/40 hover:shadow-md">
            <div class="flex items-center justify-between gap-4">
              <span class="rounded-full bg-[#1152d4]/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#1152d4]">{{ $jobPosting->department ?: 'Open Role' }}</span>
              <span class="text-sm font-medium text-slate-500">{{ str($jobPosting->employment_type)->replace('_', ' ')->title() }}</span>
            </div>
            <h4 class="mt-5 text-2xl font-bold text-slate-900 group-hover:text-[#1152d4]">{{ $jobPosting->title }}</h4>
            <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ \Illuminate\Support\Str::of(strip_tags((string) $jobPosting->description))->squish()->limit(140) }}</p>
            <div class="mt-6 flex items-center justify-between text-sm text-slate-500">
              <span>{{ $jobPosting->location ?: 'Valenzuela City' }}</span>
              <span class="font-semibold text-[#1152d4]">Apply now</span>
            </div>
          </a>
        @empty
          <div class="lg:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h4 class="text-xl font-bold text-slate-900">There are no open roles at the moment.</h4>
            <p class="mt-3 text-slate-600">Please check back soon for future opportunities with the Upturn team.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

@endsection

@push('scripts')
<script>
  (function () {
    const modal = document.getElementById('testimonial-modal');
    const overlay = modal?.querySelector('[data-testimonial-overlay]');
    const openButtons = document.querySelectorAll('[data-testimonial-open]');
    const closeButton = modal?.querySelector('[data-testimonial-close]');
    const shouldAutoOpen = @json($testimonialFormHasErrors);

    if (!modal || !overlay || !closeButton || !openButtons.length) {
      return;
    }

    const openModal = () => {
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
      modal.classList.add('hidden');
      document.body.style.overflow = '';
    };

    openButtons.forEach((button) => {
      button.addEventListener('click', openModal);
    });

    closeButton.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
      }
    });

    if (shouldAutoOpen) {
      openModal();
    }
  })();

</script>
@endpush
