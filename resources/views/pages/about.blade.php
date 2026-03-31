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
    $pageContent = $pageContent ?? [];
    $foundationCards = data_get($pageContent, 'foundation_cards', []);
    $leadershipMembers = collect(data_get($pageContent, 'leadership_members', []))
        ->map(fn (array $member) => [
            ...$member,
            'image' => filled($member['image'] ?? null) ? asset($member['image']) : null,
        ])
        ->all();
    $departments = collect(data_get($pageContent, 'departments', []))
        ->map(fn (array $department) => [
            ...$department,
            'image' => filled($department['image'] ?? null) ? asset($department['image']) : null,
        ])
        ->all();
    $leadershipSummary = data_get($pageContent, 'leadership_summary', 'Meet the partners leading Upturn across monthly retainer engagements, one-time engagements, and internal accounting support.');
    $departmentSummary = data_get($pageContent, 'department_summary', 'Our specialized teams work together across audit, compliance, business development, internal accounting, administration, and HR to serve clients with clarity and consistency.');
  @endphp

  <div class="relative overflow-hidden bg-[#0c2b5e]">
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, #d4af37 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative z-10 mx-auto max-w-[1400px] px-6 py-24 md:py-32">
      <div class="max-w-4xl">
        <h1 class="mb-8 text-4xl font-black leading-tight tracking-tight text-white md:text-7xl">
          {{ $heroContent['title'] ?: 'Your Trusted Partner in Tax Compliance and Sustainable Growth' }}
        </h1>
        <p class="mb-12 max-w-2xl text-lg font-normal text-slate-300 md:text-2xl">
          {{ $heroContent['description'] ?: 'We help business owners and entrepreneurs understand that tax compliance is not just about following the law. It is about securing the future and supporting long-term growth and success.' }}
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
        <h2 class="mb-4 text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $introContent['label'] ?: 'Who We Are' }}</h2>
        <h3 class="mb-6 text-4xl font-bold text-slate-900">{{ $introContent['title'] ?: 'A CPA firm built on compliance, clarity, and long-term client success' }}</h3>
        <p class="mb-6 text-base leading-relaxed text-slate-600">{{ $introContent['description'] ?: 'Upturn Business Solutions supports clients in achieving full compliance with BIR regulations and Philippine tax laws, from analyzing transactions to accurately applying tax rules and navigating complex audit concerns through lawful compromises and available resolutions.' }}</p>
        <div class="h-1 w-20 bg-[#d4af37]"></div>
      </div>
      <div class="grid gap-6 md:w-2/3">
        @foreach($foundationCards as $item)
          <div class="navy-glass flex gap-6 rounded-2xl p-8 transition-all hover:bg-white/5" style="background: rgba(12,20,36,0.07); border: 1px solid rgba(212,175,55,0.15);">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-[#d4af37]/10 text-[#d4af37]">
              <span class="material-symbols-outlined text-3xl">{{ $item['icon'] }}</span>
            </div>
            <div>
              <h4 class="mb-3 text-xl font-bold text-slate-900">{{ $item['title'] }}</h4>
              <p class="text-base leading-relaxed text-slate-600">{{ $item['description'] }}</p>
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
        <h3 class="mb-6 text-3xl font-bold text-slate-900 md:text-5xl">Your Business Success Is Our Priority</h3>
        <p class="mx-auto max-w-3xl text-lg text-slate-600">{{ $leadershipSummary }}</p>
      </div>
      <div class="grid grid-cols-1 gap-12">
        @foreach($leadershipMembers as $member)
          <div class="group grid gap-0 overflow-hidden rounded-3xl border border-slate-200 bg-[#0c1424] shadow-xl md:grid-cols-2">
            @if ($member['layout'] === 'left')
              <div class="h-full overflow-hidden bg-slate-800 aspect-[4/3] md:aspect-auto">
                @if ($member['image'])
                  <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"/>
                @else
                  <div class="flex h-full items-center justify-center bg-[radial-gradient(circle_at_top,#1152d4_0%,#0c1424_65%)] p-10">
                    <div class="text-center">
                      <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full border border-white/10 bg-white/10 text-3xl font-black text-white">{{ $member['initials'] }}</div>
                      <p class="mt-5 text-sm font-semibold uppercase tracking-[0.24em] text-[#d4af37]">Upturn Partner</p>
                    </div>
                  </div>
                @endif
              </div>
              <div class="flex flex-col justify-center border-t border-white/5 p-10 md:border-l md:border-t-0 md:p-16">
                <div class="mb-6">
                  <h4 class="mb-3 text-3xl font-bold text-white md:text-4xl">{{ $member['name'] }}</h4>
                  <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#d4af37]">{{ $member['role'] }}</p>
                </div>
                <div class="border-t border-white/10 pt-8">
                  <p class="text-base leading-relaxed text-slate-300 md:text-lg">{{ $member['description'] }}</p>
                </div>
              </div>
            @else
              <div class="order-2 flex flex-col justify-center border-t border-white/5 p-10 md:order-1 md:border-r md:border-t-0 md:p-16">
                <div class="mb-6">
                  <h4 class="mb-3 text-3xl font-bold text-white md:text-4xl">{{ $member['name'] }}</h4>
                  <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#d4af37]">{{ $member['role'] }}</p>
                </div>
                <div class="border-t border-white/10 pt-8">
                  <p class="text-base leading-relaxed text-slate-300 md:text-lg">{{ $member['description'] }}</p>
                </div>
              </div>
              <div class="order-1 h-full overflow-hidden bg-slate-800 aspect-[4/3] md:order-2 md:aspect-auto">
                @if ($member['image'])
                  <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"/>
                @else
                  <div class="flex h-full items-center justify-center bg-[radial-gradient(circle_at_top,#1152d4_0%,#0c1424_65%)] p-10">
                    <div class="text-center">
                      <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full border border-white/10 bg-white/10 text-3xl font-black text-white">{{ $member['initials'] }}</div>
                      <p class="mt-5 text-sm font-semibold uppercase tracking-[0.24em] text-[#d4af37]">Upturn Partner</p>
                    </div>
                  </div>
                @endif
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
        <p class="mx-auto max-w-3xl text-lg text-slate-400">{{ $departmentSummary }}</p>
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
        <h2 class="mt-4 text-3xl font-bold md:text-4xl">{{ $ctaContent['title'] ?: 'Ready to work with a trusted partner in compliance and growth?' }}</h2>
        <p class="mt-4 text-base leading-relaxed text-slate-200">{{ $ctaContent['description'] ?: 'Tell us about your business goals and we will help you find the right mix of compliance, audit, and advisory support.' }}</p>
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
