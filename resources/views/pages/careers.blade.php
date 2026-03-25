@extends('layouts.app')
@section('title', 'Careers - Upturn Business Solutions')
@section('content')
  @php
    $heroContent = $contentBlocks->get('hero', [
        'label' => 'Join Our Team',
        'title' => 'Shape the Future of Business Solutions',
        'description' => 'Be part of a growing team of tax and business professionals dedicated to excellence and innovation.',
        'primary_button_label' => 'View Openings',
        'primary_button_url' => '#openings',
        'secondary_button_label' => 'Our Culture',
        'secondary_button_url' => '#culture',
    ]);
    $introContent = $contentBlocks->get('intro', [
        'label' => 'Inside Upturn',
        'title' => 'Our Work Culture',
        'description' => 'Show candidates what it feels like to work with your team, how people grow, and the environment they can expect.',
    ]);
    $ctaContent = $contentBlocks->get('cta', [
        'title' => 'Don\'t see a perfect match?',
        'description' => 'Browse our open roles and apply to the one that best fits your background.',
        'primary_button_label' => 'Contact HR',
        'primary_button_url' => route('contact'),
    ]);
  @endphp

  <div class="px-4 py-8 md:px-20">
    <div class="relative flex h-[400px] items-center justify-center overflow-hidden rounded-xl px-6 py-12 text-center md:h-[500px] bg-slate-900">
      <div class="absolute inset-0 bg-cover bg-center opacity-40" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB3xslqWUp-224GFbj5hpbIMXCV7AJTxk8cVx1V2J-RxkPM4zsZVcsobAD6oKihV-L_MfzmNSkb1TeD2uxc0N5cSUgZIXBGKvvyrqST91u8822NR8TP2bll1-e_1-0Bz0PzOq_ccxS4lSFjPw6KtD4x3shiWmNbnQbbM-t2TXQDE6khLTsX7ocpuYe5HhEaxjqgAI6kg5gw1hc8JthGMow7HrYhRSMkmXyBsBpyvfJgpPNZ4glxc1r_mJF9LrmiQlif9OSJ4exnbNpo');"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>
      <div class="relative z-10 flex max-w-3xl flex-col gap-6">
        <span class="text-sm font-bold uppercase tracking-widest text-[#fbbf24]">{{ $heroContent['label'] ?: 'Join Our Team' }}</span>
        <h1 class="text-4xl font-black leading-tight tracking-tight text-white md:text-6xl">{{ $heroContent['title'] ?: 'Shape the Future of Business Solutions' }}</h1>
        <p class="mx-auto max-w-2xl text-lg font-normal text-slate-200 md:text-xl">{{ $heroContent['description'] ?: 'Be part of a growing team of tax and business professionals dedicated to excellence and innovation.' }}</p>
        <div class="mt-4 flex flex-wrap justify-center gap-4">
          <a href="{{ $heroContent['primary_button_url'] ?: '#openings' }}" class="inline-flex h-12 min-w-[160px] items-center justify-center rounded-lg bg-[#1152d4] px-6 text-base font-bold text-white transition-all hover:brightness-110">{{ $heroContent['primary_button_label'] ?: 'View Openings' }}</a>
          <a href="{{ $heroContent['secondary_button_url'] ?: '#culture' }}" class="inline-flex h-12 min-w-[160px] items-center justify-center rounded-lg border border-white/20 bg-white/10 px-6 text-base font-bold text-white backdrop-blur-md transition-all hover:bg-white/20">{{ $heroContent['secondary_button_label'] ?: 'Our Culture' }}</a>
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
        <p class="mx-auto mt-6 max-w-2xl text-slate-600">{{ $introContent['description'] ?: 'Show candidates what it feels like to work with your team, how people grow, and the environment they can expect.' }}</p>
      </div>
      <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        @foreach([
          ['trending_up', 'Growth-Oriented', 'We provide continuous learning opportunities, mentorship programs, and clear career progression paths for every team member.'],
          ['work_history', 'Professional', 'We maintain the highest standards of integrity and excellence, fostering an environment where professional ethics are paramount.'],
          ['groups', 'Collaborative', 'Our success is built on teamwork. We work together across departments to solve complex business and tax challenges for our clients.'],
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

  <div id="openings" class="px-4 py-16 md:px-20">
    <div class="mx-auto max-w-6xl">
      <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div>
          <h2 class="text-3xl font-bold text-slate-900">Current Opportunities</h2>
          <p class="mt-2 text-slate-600">Find your next career milestone at Upturn Business Solutions.</p>
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
          <p class="mt-2 opacity-90">{{ $ctaContent['description'] ?: 'Browse our open roles and apply to the one that best fits your background.' }}</p>
        </div>
        <a href="{{ $ctaContent['primary_button_url'] ?: route('contact') }}" class="relative z-10 w-full rounded-lg bg-[#fbbf24] px-8 py-3 text-center font-bold text-slate-900 shadow-lg transition-all hover:brightness-110 active:scale-95 md:w-auto">
          {{ $ctaContent['primary_button_label'] ?: 'Contact HR' }}
        </a>
      </div>
    </div>
  </div>

@endsection
