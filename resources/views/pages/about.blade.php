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
    $heroContent = $contentBlocks->get('hero', [
        'label' => null,
        'title' => 'Trusted Tax and Compliance Partner for Your Business',
        'description' => 'Empowering your business through expert financial solutions and unwavering compliance. We handle the complexity so you can focus on growth.',
        'image_url' => null,
        'primary_button_label' => 'Our Services',
        'primary_button_url' => route('services'),
        'secondary_button_label' => 'Get in Touch',
        'secondary_button_url' => route('contact'),
    ]);
    $introContent = $contentBlocks->get('intro', [
        'label' => 'Our Foundation',
        'title' => 'Driving Excellence in Compliance',
        'description' => 'We partner with businesses that need dependable tax, finance, and operational guidance. Every engagement is built around clarity, accountability, and long-term growth.',
    ]);
    $ctaContent = $contentBlocks->get('cta', [
        'label' => 'Next Step',
        'title' => 'Ready to work with a trusted compliance partner?',
        'description' => 'Tell us about your goals and we will help you shape the right mix of advisory, compliance, and operational support.',
        'primary_button_label' => 'Talk to Our Team',
        'primary_button_url' => route('contact'),
        'secondary_button_label' => 'Explore Services',
        'secondary_button_url' => route('services'),
    ]);
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

  <section class="bg-[#f6f6f8] px-6 py-20">
    <div class="mx-auto max-w-[1200px]">
      <div class="mb-10 max-w-2xl">
        <h2 class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">Live Platform Snapshot</h2>
        <h3 class="mt-4 text-3xl font-bold text-slate-900 md:text-4xl">Backend activity reflected on the public site</h3>
        <p class="mt-4 text-slate-600">These figures update from the records maintained in your admin and HR panels, helping visitors see a site that stays aligned with your current operations.</p>
      </div>
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ([
          ['value' => number_format($servicesCount), 'label' => 'Active Services'],
          ['value' => number_format($spacesCount), 'label' => 'Available Spaces'],
          ['value' => number_format($publishedPostsCount), 'label' => 'Published Updates'],
          ['value' => number_format($openRolesCount), 'label' => 'Open Roles'],
        ] as $stat)
          <div class="rounded-2xl border border-slate-200 bg-white px-6 py-8 shadow-sm">
            <p class="text-4xl font-black text-[#1152d4]">{{ $stat['value'] }}</p>
            <p class="mt-3 text-xs font-bold uppercase tracking-[0.25em] text-slate-500">{{ $stat['label'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <div class="border-y border-slate-200 bg-white px-6 py-24">
    <div class="mx-auto max-w-[1200px]">
      <div class="mb-20 text-center">
        <h2 class="mb-4 text-sm font-bold uppercase tracking-[0.3em] text-[#d4af37]">The Leadership</h2>
        <h3 class="mb-6 text-3xl font-bold text-slate-900 md:text-5xl">Meet Our Partners</h3>
        <p class="mx-auto max-w-2xl text-lg text-slate-600">Our team of seasoned professionals brings decades of collective experience in taxation, accounting, and business compliance.</p>
      </div>
      <div class="grid grid-cols-1 gap-12">
        @foreach([
          ['Dennis Bayangos', 'Managing Partner', 'Strategic Leadership &amp; Tax Planning', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCrg4z4HBtWRD9lpgcWak-f5T5sy47Rp2_H41LQFabVRA2pRxKvm5SRw1_0rcHsgcg4YP0IRBqBKqGdqJUkfnXkNspKV05PKyt-OK-GKQsrhzBsbdKh_2Bb6jI61xUlbA2d7JHQ_WEQz6sw6YmlYxD3et4PK2keS10qxxRuKmEwZ5eLG73a0qOCIPEAUHhL9Lz7qdRP04EIgOMC875xTu5WAcVv2sb1JZ8uKJW7ZFxk73jITPIJg9usgrOC9-SkOZ9ikbIMtJ39-VnS', 'left'],
          ['Mark Alvin Barcenas', 'Tax Compliance Partner', 'Corporate Tax Compliance', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCXag5nIjlZ3wCZimqvc3j9bRPt5B34M2hipiRofdElNjFt0txXQsZUTAdebvGXvDGYwNrd6j6o0DcdVTz6qHE_pVYr3n3I9wAZ2WFJTTeL3UzGtYRfILelePYAwDA0jjY6r9BUzjZz0kLNn-9AFYOAWtwnGXfaI_X7bNlQxjM_BTu0fs2nifkGn4NGnlDOtErSfE5MHTvcYTRidH3fHJFEXBK7AbOKxqqxRIeQ2ak0K5sXuXwsBjOruXvt9_u0J2JyoJzo4GzV9YSS', 'right'],
          ['John Dela Cruz', 'Financial Advisory Partner', 'Wealth Management &amp; Advisory', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAzDgrTX-Fz-Lf7MjwlC7JnPeaRWK9EBHFBhX6vgelHNbmZnsJ67bv3mg7jCobsKiwoTwjLWVRpFjE-0EvkP8dkxmahXZ1mIJ3mWpCoM_MzfWxnVGLi_VukkNHk_uGDmBEECN_0KlDff5ZHMz443R6vszqgtKgZp5ATpi163-cuFn188xRtJqRaroITW2rR6eHU2nYQ3XmcopnTbZS8UgDdgqq4nEnCaYpxjRu4tmssJAWhiQqr57gBNPW53oVMJUoagKE0OMByg5xj', 'left'],
          ['Maria Santos', 'Operations Director', 'Operational Efficiency &amp; Risk', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAsgwN_0Bqe2u-IcGM60jsDYibyOuKSiSH65vjRnHYX6MNeufAH9DltiAb13NacakYDjlusNVre4_Zsc4mySNs5pZqFan4zqaTCLF1anB_M6QCvdW6qiHRI1N-5sKC2tSw_vPzSlyM2CBO1BoE9Rhr_AZRwo8w3oeAE1TCIYOXNuJ55gAfhWwK6g4NfMZNZ5axYSYw62_2nRAucsDCFsvpqRHnoP8Md4RxJwKs4bG3HffeSsG_LADUX7xbfLQy7Ls7ZRyyy3oURmh1a', 'right'],
        ] as $member)
          <div class="group grid gap-0 overflow-hidden rounded-3xl border border-slate-200 bg-[#0c1424] shadow-xl md:grid-cols-2">
            @if ($member[4] === 'left')
              <div class="h-full overflow-hidden bg-slate-800 aspect-[4/3] md:aspect-auto">
                <img src="{{ $member[3] }}" alt="{{ $member[0] }}" class="h-full w-full object-cover grayscale brightness-90 transition-all duration-700 group-hover:scale-105 group-hover:grayscale-0"/>
              </div>
              <div class="flex flex-col justify-center border-l border-white/5 p-10 md:p-16">
                <div class="mb-8">
                  <h4 class="mb-2 text-3xl font-bold text-white md:text-4xl">{{ $member[0] }}</h4>
                  <p class="text-lg font-semibold tracking-wide text-[#d4af37]">{{ $member[1] }}</p>
                </div>
                <div class="border-t border-white/10 pt-8">
                  <div class="inline-flex items-center gap-3 rounded-lg border border-[#d4af37]/30 bg-[#d4af37]/10 px-4 py-2">
                    <span class="material-symbols-outlined text-[#d4af37]">verified</span>
                    <span class="font-medium text-slate-200">Specialization: {!! $member[2] !!}</span>
                  </div>
                </div>
              </div>
            @else
              <div class="order-2 flex flex-col justify-center border-r border-white/5 p-10 md:order-1 md:p-16">
                <div class="mb-8">
                  <h4 class="mb-2 text-3xl font-bold text-white md:text-4xl">{{ $member[0] }}</h4>
                  <p class="text-lg font-semibold tracking-wide text-[#d4af37]">{{ $member[1] }}</p>
                </div>
                <div class="border-t border-white/10 pt-8">
                  <div class="inline-flex items-center gap-3 rounded-lg border border-[#d4af37]/30 bg-[#d4af37]/10 px-4 py-2">
                    <span class="material-symbols-outlined text-[#d4af37]">verified</span>
                    <span class="font-medium text-slate-200">Specialization: {!! $member[2] !!}</span>
                  </div>
                </div>
              </div>
              <div class="order-1 h-full overflow-hidden bg-slate-800 aspect-[4/3] md:order-2 md:aspect-auto">
                <img src="{{ $member[3] }}" alt="{{ $member[0] }}" class="h-full w-full object-cover grayscale brightness-90 transition-all duration-700 group-hover:scale-105 group-hover:grayscale-0"/>
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
        @foreach([
          ['fact_check', 'MRE Department', 'Managing and reviewing regulatory excellence across all business operations to ensure total compliance.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCdLJ0JCisb75ypWWC9_y5dkTRpY8_Tm9wu9PvqjSK2uUs9ZJgiIuLGIx1zG_wHa6PvT46CfXBdw_f5xoPhY_gVUS-lnIabV0VJwoQxgf8luNyPD8G9c5y0i5q1Cs4ESMH_wLKkRYSrz0vcAix_9hduSQmHGzhvUaZattAqmrmqEUADX5EbMG4Rl1G5lKYhcNpHA3T1G9uOKY5htbPFCNAEv-Cn7OT7RAM5yKyUtSValffjareajzxrjcVJgYTwQiZ_n7W2Cuj-bzWB'],
          ['settings_suggest', 'OTE Department', 'Optimizing technical execution and operational efficiency for client success through innovative workflows.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDkD8pcCK5OW-ugXR4rT4plZv8iUNSzHXYdXxphXDW6ii6OEhNy63OAmxtS_kHcb2_QnLRv2T-hhrPUdIv29w_zQC-PgHo84ZO3iAnBnMoT-ZHWANZkY0xFBn3exsLMHK8wbao-Glape-yk58eAd-AsR_9omu1yUz02lKlkof2LUpEn0GX7VvnTsn2uu_cCbfeaPsMl7lj1GAeZ5X4UWw-UHYF3NWuYFagXd0bvkgsaYzBZH62vlkoVptpcSWtFp7Xbeq4Q698pRLLy'],
          ['account_balance_wallet', 'AAE Department', 'Advanced accounting and examination services for comprehensive financial compliance and accurate reporting.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBwLrYHaxafr3Ze6EmttvrBZa18t-63-a-rV86uAX2YjloK1k2eeUxyCt0uVcQ_E1ib4KrXWVDcUnXMmsrO84ixgUnxiUAFB8v5GJ_zgl1TDV9kt2JJ2ajndSB3J7_dgxvmOyGJw4zs3BYcRHhRWjKxC1GSHE57M4gweEEviJlz7OI2cZZXA74pShoZ0hqo8HWgqnC_hklP07jlx2ux5l02gwuoc68LZj0YUCz-1f4nD3_VBsLE9BYfiKJoWsjGMQP5B39yYKrscVIp'],
          ['business_center', 'Business Development', 'Driving growth through strategic partnerships, client acquisition, and comprehensive market positioning initiatives.', 'https://lh3.googleusercontent.com/aida-public/AB6AXuD1CVhbdSNoA1e4241OJ8nrhAPa6WH_Sf9pC3UGCytUcg4NVdMYk5kPp2lb6RfiB5iShJzv8TI8yTtkGXeK58vZUUkdgnTdDQbli57An6EIb7iYceIeA4LF-zL0F2WhFHitU8Bo_g5upMgpty5xdtwcRewSFz6RruaWVJfFIw8jJSNaY32NHOezH--KUl1oRgMglLD-czR-49fb-6y3fqWFGSV0deGhv4lReBvZNX5qwVCZaKNcNE3EFzZSsNMfpRDTvN0n3zM3GBTV'],
        ] as $department)
          <div class="group relative aspect-[4/5] min-w-[85%] shrink-0 snap-center overflow-hidden rounded-3xl border border-white/10 sm:aspect-[3/2] md:min-w-[75%] lg:min-w-[65%]">
            <img src="{{ $department[3] }}" alt="{{ $department[1] }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"/>
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-[#0c2b5e]/90 p-6 text-center transition-all duration-500 group-hover:bg-[#0c2b5e]/60 md:bg-[#0c2b5e]/80 md:p-8">
              <span class="material-symbols-outlined mb-4 text-5xl text-[#d4af37]">{{ $department[0] }}</span>
              <h4 class="mb-4 text-3xl font-black text-white md:text-4xl">{{ $department[1] }}</h4>
              <p class="mx-auto max-w-xl text-base leading-relaxed text-slate-200 md:text-lg">{{ $department[2] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bg-white px-6 py-24">
    <div class="mx-auto max-w-[1200px]">
      <div class="mb-12 max-w-2xl">
        <h2 class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">Latest Insights</h2>
        <h3 class="mt-4 text-3xl font-bold text-slate-900 md:text-4xl">Recent CMS updates from the backend</h3>
        <p class="mt-4 text-slate-600">Published posts are surfaced here automatically so the About page stays current without manual edits.</p>
      </div>
      <div class="grid gap-8 md:grid-cols-3">
        @forelse ($latestPosts as $post)
          <article class="rounded-3xl border border-slate-200 bg-[#f8fafc] p-8 shadow-sm">
            <div class="flex items-center justify-between gap-4 text-xs font-bold uppercase tracking-[0.22em] text-slate-500">
              <span>{{ $post['category'] }}</span>
              <span>{{ $post['published_at_label'] }}</span>
            </div>
            <h4 class="mt-5 text-2xl font-bold text-slate-900">{{ $post['title'] }}</h4>
            <p class="mt-4 text-sm leading-relaxed text-slate-600">{{ $post['excerpt'] }}</p>
          </article>
        @empty
          <div class="md:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h4 class="text-xl font-bold text-slate-900">No published updates yet.</h4>
            <p class="mt-3 text-slate-600">Publish posts in the CMS and they will appear here automatically.</p>
          </div>
        @endforelse
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
