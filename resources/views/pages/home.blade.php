@extends('layouts.app')
@section('title', 'Upturn Business Solutions | Corporate Financial Excellence')
@section('content')
  @php
    $heroContent = $pageSections['hero'] ?? [];
    $introContent = $pageSections['intro'] ?? [];
    $trustSignals = [
        ['icon' => 'support_agent', 'title' => 'Responsive Support'],
        ['icon' => 'receipt_long', 'title' => 'Tax-Ready Records'],
        ['icon' => 'shield_person', 'title' => 'Compliance-First Guidance'],
    ];
    $trustCards = [
        [
            'icon' => 'query_stats',
            'title' => 'Clear Financial Direction',
            'description' => 'Get practical accounting guidance that supports better decisions for your business.',
        ],
        [
            'icon' => 'schedule',
            'title' => 'Timely Submissions',
            'description' => 'Keep deadlines under control with a team that values accuracy and consistency.',
        ],
        [
            'icon' => 'workspace_premium',
            'title' => 'Reliable Professional Care',
            'description' => 'Work with professionals who understand both compliance detail and client service.',
        ],
        [
            'icon' => 'trending_up',
            'title' => 'Growth-Focused Support',
            'description' => 'Stay organized while your business scales, without losing sight of compliance.',
        ],
    ];
    $missionHighlights = [
        [
            'icon' => 'work',
            'title' => 'Focus on Your Business',
            'description' => 'Let our expert team handle the administrative tasks, so you can concentrate on what truly matters to you.',
        ],
        [
            'icon' => 'gpp_bad',
            'title' => 'Avoid Penalties',
            'description' => 'Our professionals ensure timely and accurate submissions, helping you avoid costly penalties.',
        ],
        [
            'icon' => 'sentiment_calm',
            'title' => 'Reduce Stress',
            'description' => 'Delegate the paperwork to us and enjoy less stress while focusing on your core priorities.',
        ],
        [
            'icon' => 'task_alt',
            'title' => 'Effortless Compliance',
            'description' => 'Get expert assistance to meet all legal requirements and steer clear of fines.',
        ],
    ];
    $complianceBenefits = [
        'Focus on Your Business',
        'Avoid Penalties',
        'Less Stress',
        'Easy Compliance',
        'Savings',
    ];
    $servicePrinciples = [
        [
            'icon' => 'workspace_premium',
            'title' => 'Quality Services',
            'description' => 'Understand the needs of the client by providing the highest quality accounting practice and other related professional services.',
        ],
        [
            'icon' => 'verified_user',
            'title' => 'Professionalism',
            'description' => 'At Upturn Business Solutions, we uphold the highest standards of professionalism, ensuring integrity, accuracy, and adherence to industry regulations in every service we provide. Our expert team delivers tailored solutions with precision, offering reliable support for your financial and business needs.',
        ],
    ];
    $deliveryPhases = [
        [
            'number' => '01.',
            'icon' => 'forum',
            'title' => 'Deliberations',
            'items' => [
                'Identify Client\'s Needs: Initial discussions to understand the client\'s specific requirements and objectives.',
                'Assessment and Strategy Building: Develop tailored strategies and plans to meet the client\'s goals.',
            ],
        ],
        [
            'number' => '02.',
            'icon' => 'assignment_add',
            'title' => 'Onboarding Process',
            'items' => [
                'Client Onboarding: Formalize the engagement by signing agreements and setting expectations.',
                'Gathering Business Information: Collect necessary data and documents from the client.',
                'Setting Up Tools and Platforms: Implement and configure the tools and platforms required for service delivery.',
            ],
        ],
        [
            'number' => '03.',
            'icon' => 'monitoring',
            'title' => 'Monthly Collaborations or Project Monitoring',
            'items' => [
                'Documents & Transactions Transmittal: Regular submission of necessary documents and transaction records by the client.',
                'Processing: Upturn will do its job by handling the received information, completing tasks, and ensuring compliance.',
                'Reporting & Deliverables: Provide the client with detailed reports and deliverables, summarizing completed tasks and outcomes.',
            ],
        ],
    ];
    $testimonialFormHasErrors = $errors->hasAny([
        'client_name',
        'company',
        'rating',
        'content',
    ]);
    $testimonialCount = is_countable($testimonials) ? count($testimonials) : 0;
    $testimonialMarqueeDuration = max(36, $testimonialCount * 7);
    $marqueeTestimonials = $testimonialCount > 1 ? $testimonials->concat($testimonials) : collect();
    $testimonialReviewNotes = [
        'Only approved testimonials are published on the homepage.',
        'You can share your company name, or leave it blank if you prefer.',
        'Your experience helps future clients understand how Upturn works.',
    ];
  @endphp

  <section class="relative -mt-[72px] min-h-[100vh] overflow-hidden bg-[#07111f] text-white">
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <video
        class="absolute left-1/2 top-1/2 h-auto min-h-full min-w-full max-w-none -translate-x-1/2 -translate-y-1/2 object-cover"
        autoplay
        muted
        loop
        playsinline
        aria-hidden="true"
      >
        <source src="{{ asset('images/videopresentation.mp4') }}" type="video/mp4">
      </video>
    </div>

    <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(7,17,31,0.88)_0%,rgba(12,20,36,0.72)_45%,rgba(17,82,212,0.3)_100%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(212,175,55,0.18),transparent_38%),radial-gradient(circle_at_bottom_right,rgba(17,82,212,0.22),transparent_34%)]"></div>

    <div class="relative mx-auto flex min-h-[100vh] max-w-7xl items-center px-4 pb-20 pt-36 sm:px-6 sm:pt-40 lg:px-8 lg:pb-24 lg:pt-44">
      <div class="relative z-10 max-w-3xl space-y-8 text-center lg:text-left">
        <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.18)] backdrop-blur-sm">
          <span class="h-2 w-2 animate-pulse rounded-full bg-[#d4af37]"></span>
          {{ $heroContent['label'] ?: 'Trusted By Local Businesses' }}
        </div>
        <h1 class="text-5xl font-black leading-[1.05] tracking-tight text-white drop-shadow-[0_14px_38px_rgba(7,17,31,0.42)] lg:text-6xl xl:text-7xl">
          {{ $heroContent['title'] ?: 'Building Secure and Tax-Compliant Businesses' }}
        </h1>
        <p class="max-w-2xl text-lg leading-relaxed text-slate-200 lg:text-xl">
          {{ $heroContent['description'] ?: 'Empowering your enterprise with expert financial strategies, meticulous regulatory excellence, and forward-thinking growth solutions.' }}
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
          <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">{{ $introContent['label'] ?: 'Trusted tax and accounting support' }}</p>
          <h2 class="mt-5 text-4xl font-black leading-tight md:text-5xl">{{ $introContent['title'] ?: 'Looking for a Trustworthy Accountant?' }}</h2>
          <p class="mt-5 max-w-2xl text-base leading-8 text-slate-300 md:text-lg">
            {{ $introContent['description'] ?: 'Work with a team that keeps your bookkeeping, tax compliance, and regulatory requirements organized so you can lead your business with confidence.' }}
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
        <h2 class="mt-4 text-4xl font-black text-slate-900 md:text-5xl">To simplify your accounting and tax compliance needs!</h2>
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
          <h2 class="mt-5 text-4xl font-black leading-tight md:text-5xl">Navigating BIR &amp; Tax compliance problems? We're here to help you!</h2>
          <p class="mt-6 text-base leading-8 text-slate-300 md:text-lg">
            We offer comprehensive bookkeeping, accounting, tax advisory, and tax preparation services for business owners, entrepreneurs, and professionals. Let us manage the complexities of Philippine tax compliance so you can focus on growing your business.
          </p>
          <p class="mt-5 text-base leading-8 text-slate-300">
            Our firm is owned and operated by Certified Public Accountants duly accredited by the BOA (Board of Accountancy) and BIR (Bureau of Internal Revenue) to render high quality, reliable, and timely professional services at reasonable fees.
          </p>
        </div>

        <div class="rounded-[2rem] border border-white/10 bg-white/5 p-8 shadow-2xl backdrop-blur-sm">
          <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#d4af37]">What You Gain</p>
          <div class="mt-8 space-y-4">
            @foreach ($complianceBenefits as $benefit)
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
        <h2 class="mt-4 text-4xl font-black text-slate-900 md:text-5xl">Service built on quality and professionalism</h2>
      </div>
      <div class="mt-14 grid gap-8 lg:grid-cols-2">
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

  <section class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto mb-16 max-w-3xl space-y-4 text-center">
        <h2 class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">Our Expertise</h2>
        <h3 class="text-4xl font-bold text-slate-900">Services Published from the Admin Panel</h3>
        <p class="text-slate-600">The cards below are powered by your live service records, so updates in the admin panel immediately shape the public experience.</p>
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
            <h4 class="text-xl font-bold text-slate-900">No services are published yet.</h4>
            <p class="mt-3 text-slate-600">Add services from the admin panel and they will appear here automatically.</p>
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
            <h4 class="text-xl font-bold text-slate-900">No published posts yet.</h4>
            <p class="mt-3 text-slate-600">Once you publish announcements or updates in the CMS, they will appear here.</p>
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
          <h3 class="text-4xl font-bold text-slate-900">Hiring needs from the HR backend</h3>
          <p class="text-slate-600">Open roles published by HR appear here automatically, giving applicants a straight path from discovery to application.</p>
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
            <h4 class="text-xl font-bold text-slate-900">No open roles are published yet.</h4>
            <p class="mt-3 text-slate-600">Publish a job posting from the HR panel and it will show up here automatically.</p>
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
