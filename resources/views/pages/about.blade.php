@extends('layouts.app')
@section('title', 'About Us - Upturn Business Solutions')

@push('head')
<style>
  .gold-gradient-text {
    background: linear-gradient(to right, #d4af37, #f4d03f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .navy-glass {
    background: rgba(12, 20, 36, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(212, 175, 55, 0.1);
  }
  .hide-scrollbar::-webkit-scrollbar { display: none; }
  .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@section('content')
  @php
    $heroContent = $pageSections['hero'] ?? [];
    $introContent = $pageSections['intro'] ?? [];
    $ctaContent = $pageSections['cta'] ?? [];
    $leadershipMembers = [
        [
            'name' => 'Dennis Bayangos, CPA, CTT, MBA',
            'role' => 'Managing Partner, Monthly Retainer Engagements',
            'description' => 'Dennis Bayangos oversees the entire firm, providing strategic direction and ensuring all teams deliver high-quality services. He leads with a focus on client satisfaction, compliance, and sustainable growth, fostering collaboration across departments to maintain professional standards and drive long-term success.',
            'image' => asset('images/dennis_bayangos_cpa_ctt_mba.png'),
            'layout' => 'left',
        ],
        [
            'name' => 'Patrick Baluyan, CPA, CTT, MBA',
            'role' => 'Partner, One-Time Engagements',
            'description' => 'Patrick Baluyan specializes in one-time engagements such as business registration and compliance projects. He provides expert guidance and manages projects from start to finish to ensure timely and effective solutions.',
            'image' => asset('images/patrick_baluyan_cpa_ctt_mba.png'),
            'layout' => 'right',
        ],
        [
            'name' => 'Justine Amor Guiling, CTT, MBA',
            'role' => 'Partner, Internal Accounting',
            'description' => 'Justine Amor Guiling oversees the firm\'s internal accounting operations, including billing and collection, disbursement and payables, ensuring financial accuracy, budgeting, and compliance. She focuses on maintaining strong financial controls and supporting the firm\'s fiscal health.',
            'image' => asset('images/justine_amor_guiling_ctt_mba.png'),
            'layout' => 'left',
        ],
    ];
    $departments = [
        [
            'icon' => 'account_balance_wallet',
            'name' => 'AAE Department',
            'description' => 'Advanced accounting and examination services for comprehensive financial compliance and accurate reporting.',
            'image' => asset('images/aae.JPG'),
        ],
        [
            'icon' => 'settings_suggest',
            'name' => 'OTE Department',
            'description' => 'Optimizing technical execution and operational efficiency for client success through innovative workflows.',
            'image' => asset('images/ote.JPG'),
        ],
        [
            'icon' => 'fact_check',
            'name' => 'MRE Department',
            'description' => 'Managing and reviewing regulatory excellence across all business operations to ensure total compliance.',
            'image' => asset('images/mre.JPG'),
        ],
        [
            'icon' => 'business_center',
            'name' => 'Business Development Department',
            'description' => 'Driving growth through strategic partnerships, client acquisition, and comprehensive market positioning initiatives.',
            'image' => asset('images/bd.JPG'),
        ],
        [
            'icon' => 'groups',
            'name' => 'Internal Accounting, Admin and HR Department',
            'description' => 'Supporting the firm through internal accounting, people operations, and administrative coordination that keep teams aligned, compliant, and ready to serve clients efficiently.',
            'image' => asset('images/internal.JPG'),
        ],
    ];
  @endphp

  <div class="relative overflow-hidden bg-[#0c2b5e]">
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, #d4af37 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative z-10 mx-auto max-w-[1400px] px-6 py-24 md:py-32">
      <div class="max-w-4xl">
        <h1 class="mb-8 text-4xl font-black leading-tight tracking-tight text-white md:text-7xl">
          {{ $heroContent['title'] ?: 'Trusted Tax and Compliance Partner for Your Business' }}
        </h1>
        <p class="mb-12 max-w-2xl text-lg font-normal text-slate-300 md:text-2xl">
          {{ $heroContent['description'] ?: 'Empowering your business through expert financial solutions and unwavering compliance. We handle the complexity so you can focus on growth.' }}
        </p>
        <div class="flex flex-col gap-4 sm:flex-row">
          <a href="{{ $heroContent['primary_button_url'] ?: route('services') }}" class="inline-flex h-14 min-w-[160px] items-center justify-center rounded-full bg-[#d4af37] px-8 text-lg font-bold text-[#0c2b5e] transition-all hover:scale-105">
            {{ $heroContent['primary_button_label'] ?: 'Our Services' }}
          </a>
          <a href="{{ $heroContent['secondary_button_url'] ?: route('contact') }}" class="inline-flex h-14 min-w-[160px] items-center justify-center rounded-full border border-white/20 bg-white/5 px-8 text-lg font-bold text-white transition-all hover:bg-white/10">
            {{ $heroContent['secondary_button_label'] ?: 'Get in Touch' }}
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="mx-auto max-w-[1200px] px-6 py-24">
    <div class="flex flex-col items-start gap-12 md:flex-row">
      <div class="md:sticky md:top-32 md:w-1/3">
        <h2 class="mb-4 text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $introContent['label'] ?: 'Our Foundation' }}</h2>
        <h3 class="mb-6 text-4xl font-bold text-slate-900">{{ $introContent['title'] ?: 'Driving Excellence in Compliance' }}</h3>
        <p class="mb-6 text-base leading-relaxed text-slate-600">{{ $introContent['description'] ?: 'We partner with businesses that need dependable tax, finance, and operational guidance. Every engagement is built around clarity, accountability, and long-term growth.' }}</p>
        <div class="h-1 w-20 bg-[#d4af37]"></div>
      </div>
      <div class="grid gap-6 md:w-2/3">
        @foreach([
          ['target', 'Our Mission', 'To provide seamless tax and compliance services that foster business growth through accuracy, integrity, and professional excellence.'],
          ['visibility', 'Our Vision', 'To be the most trusted strategic partner for businesses nationwide, recognized for our commitment to financial health and regulatory adherence.'],
          ['flag', 'Our Goal', 'Ensuring every client achieves financial excellence and regulatory peace of mind through proactive strategies and expert advisory.'],
        ] as $item)
          <div class="navy-glass flex gap-6 rounded-2xl p-8 transition-all hover:bg-white/5" style="background: rgba(12,20,36,0.07); border: 1px solid rgba(212,175,55,0.15);">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#d4af37]/10 text-[#d4af37]">
              <span class="material-symbols-outlined text-3xl">{{ $item[0] }}</span>
            </div>
            <div>
              <h4 class="mb-3 text-xl font-bold text-slate-900">{{ $item[1] }}</h4>
              <p class="text-base leading-relaxed text-slate-600">{{ $item[2] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="border-y border-slate-200 bg-white px-6 py-24">
    <div class="mx-auto max-w-[1200px]">
      <div class="mb-20 text-center">
        <h2 class="mb-4 text-sm font-bold uppercase tracking-[0.3em] text-[#d4af37]">The Leadership</h2>
        <h3 class="mb-6 text-3xl font-bold text-slate-900 md:text-5xl">Meet Our Partners</h3>
        <p class="mx-auto max-w-2xl text-lg text-slate-600">Our team of seasoned professionals brings decades of collective experience in taxation, accounting, and business compliance.</p>
      </div>
      <div class="grid grid-cols-1 gap-12">
        @foreach($leadershipMembers as $member)
          <div class="group grid gap-0 overflow-hidden rounded-3xl border border-slate-200 bg-[#0c1424] shadow-xl md:grid-cols-2">
            @if ($member['layout'] === 'left')
              <div class="h-full overflow-hidden bg-slate-800 aspect-[4/3] md:aspect-auto">
                <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"/>
              </div>
              <div class="flex flex-col justify-center border-l border-white/5 p-10 md:p-16">
                <div class="mb-6">
                  <h4 class="mb-3 text-3xl font-bold text-white md:text-4xl">{{ $member['name'] }}</h4>
                  <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#d4af37]">{{ $member['role'] }}</p>
                </div>
                <div class="border-t border-white/10 pt-8">
                  <p class="text-base leading-relaxed text-slate-300 md:text-lg">{{ $member['description'] }}</p>
                </div>
              </div>
            @else
              <div class="order-2 flex flex-col justify-center border-r border-white/5 p-10 md:order-1 md:p-16">
                <div class="mb-6">
                  <h4 class="mb-3 text-3xl font-bold text-white md:text-4xl">{{ $member['name'] }}</h4>
                  <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#d4af37]">{{ $member['role'] }}</p>
                </div>
                <div class="border-t border-white/10 pt-8">
                  <p class="text-base leading-relaxed text-slate-300 md:text-lg">{{ $member['description'] }}</p>
                </div>
              </div>
              <div class="order-1 h-full overflow-hidden bg-slate-800 aspect-[4/3] md:order-2 md:aspect-auto">
                <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"/>
              </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <section class="overflow-hidden bg-[#050a14] py-24">
    <div class="mx-auto max-w-[1200px] px-6">
      <div class="mb-16 text-center">
        <h2 class="mb-4 text-sm font-bold uppercase tracking-[0.3em] text-[#d4af37]">Core Expertise</h2>
        <h3 class="mb-6 text-4xl font-bold text-white md:text-5xl">Our Departments</h3>
        <p class="mx-auto max-w-2xl text-lg text-slate-400">Our specialized teams work in synergy to provide comprehensive business solutions tailored to your unique needs.</p>
      </div>
      <div class="hide-scrollbar flex snap-x snap-mandatory gap-4 overflow-x-auto px-4 pb-8 md:gap-6">
        @foreach($departments as $department)
          <div class="group relative aspect-[4/5] min-w-[85%] shrink-0 snap-center overflow-hidden rounded-3xl border border-white/10 sm:aspect-[3/2] md:min-w-[75%] lg:min-w-[65%]">
            <img src="{{ $department['image'] }}" alt="{{ $department['name'] }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"/>
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-[#0c2b5e]/90 p-6 text-center transition-all duration-500 group-hover:bg-[#0c2b5e]/60 md:bg-[#0c2b5e]/80 md:p-8">
              <span class="material-symbols-outlined mb-4 text-5xl text-[#d4af37]">{{ $department['icon'] }}</span>
              <h4 class="mb-4 text-3xl font-black text-white md:text-4xl">{{ $department['name'] }}</h4>
              <p class="mx-auto max-w-xl text-base leading-relaxed text-slate-200 md:text-lg">{{ $department['description'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bg-[#0c2b5e] px-6 py-20">
    <div class="mx-auto flex max-w-[1200px] flex-col gap-8 rounded-[2rem] border border-white/10 bg-white/5 p-10 text-white backdrop-blur-sm lg:flex-row lg:items-center lg:justify-between">
      <div class="max-w-2xl">
        <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">{{ $ctaContent['label'] ?: 'Next Step' }}</p>
        <h2 class="mt-4 text-3xl font-bold md:text-4xl">{{ $ctaContent['title'] ?: 'Ready to work with a trusted compliance partner?' }}</h2>
        <p class="mt-4 text-base leading-relaxed text-slate-200">{{ $ctaContent['description'] ?: 'Tell us about your goals and we will help you shape the right mix of advisory, compliance, and operational support.' }}</p>
      </div>
      <div class="flex flex-col gap-4 sm:flex-row">
        <a href="{{ $ctaContent['primary_button_url'] ?: route('contact') }}" class="inline-flex items-center justify-center rounded-full bg-[#d4af37] px-8 py-4 font-bold text-[#0c2b5e] transition-all hover:brightness-105">
          {{ $ctaContent['primary_button_label'] ?: 'Talk to Our Team' }}
        </a>
        <a href="{{ $ctaContent['secondary_button_url'] ?: route('services') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/10 px-8 py-4 font-bold text-white transition-all hover:bg-white/15">
          {{ $ctaContent['secondary_button_label'] ?: 'Explore Services' }}
        </a>
      </div>
    </div>
  </section>

@endsection
