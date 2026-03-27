@extends('layouts.app')
@section('title', 'Upturn Business Solutions | Corporate Financial Excellence')
@section('content')
  @php
    $heroContent = $contentBlocks->get('hero', [
        'label' => 'Trusted Corporate Partners',
        'title' => 'Building Secure and Tax-Compliant Businesses',
        'description' => 'Empowering your enterprise with expert financial strategies, meticulous regulatory excellence, and forward-thinking growth solutions.',
        'image_url' => null,
        'primary_button_label' => 'Get Started',
        'primary_button_url' => route('contact'),
        'secondary_button_label' => 'View Case Studies',
        'secondary_button_url' => route('engagements'),
    ]);
    $introContent = $contentBlocks->get('intro', [
        'label' => 'Who We Are',
        'title' => 'Upturn is dedicated to top-tier corporate services.',
        'description' => 'We believe that a strong financial foundation is the cornerstone of every successful enterprise. Our team of certified accountants and legal experts works in tandem to reduce compliance risks while helping clients move forward with confidence.',
    ]);
  @endphp

  <section class="relative overflow-hidden bg-white py-20 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="grid items-center gap-12 lg:grid-cols-2">
        <div class="relative z-10 space-y-8 text-center lg:text-left">
          <div class="inline-flex items-center gap-2 rounded-full bg-[#1152d4]/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#1152d4]">
            <span class="h-2 w-2 animate-pulse rounded-full bg-[#d4af37]"></span>
            {{ $heroContent['label'] ?: 'Trusted Corporate Partners' }}
          </div>
          <h1 class="text-5xl font-black leading-[1.1] tracking-tight text-slate-900 lg:text-6xl">
            {{ $heroContent['title'] ?: 'Building Secure and Tax-Compliant Businesses' }}
          </h1>
          <p class="max-w-lg text-lg leading-relaxed text-slate-600">
            {{ $heroContent['description'] ?: 'Empowering your enterprise with expert financial strategies, meticulous regulatory excellence, and forward-thinking growth solutions.' }}
          </p>
          <div class="flex flex-col justify-center gap-4 sm:flex-row lg:justify-start">
            <a href="{{ $heroContent['primary_button_url'] ?: route('contact') }}" class="flex items-center justify-center gap-2 rounded-xl bg-[#1152d4] px-8 py-4 text-base font-bold text-white transition-all hover:shadow-lg">
              {{ $heroContent['primary_button_label'] ?: 'Get Started' }} <span class="material-symbols-outlined">arrow_forward</span>
            </a>
            <a href="{{ $heroContent['secondary_button_url'] ?: route('engagements') }}" class="flex items-center justify-center rounded-xl border-2 border-slate-200 bg-white px-8 py-4 text-base font-bold text-slate-700 transition-all hover:bg-slate-50">
              {{ $heroContent['secondary_button_label'] ?: 'View Case Studies' }}
            </a>
          </div>
        </div>
        <div class="relative">
          <div class="absolute -right-20 -top-20 h-96 w-96 rounded-full bg-[#1152d4]/5 blur-3xl"></div>
          <div class="relative overflow-hidden rounded-2xl border-8 border-white shadow-2xl">
            <img src="{{ $heroContent['image_url'] ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBhbqtFfqjaIYQrQYbC_SXaPONULsGTkeUpnvX1PlZiDdOgfPlX8utnFKXmi-H6nKevP3pSWQSdNxmk0XfygvwUPQkumqxz4erX0CAClCptGpvVr8tuCFLv3kUsWi3Ri674NXuNL4grVibNyuMW1FKGUfKbBNGP0xVvDv30AFIY0EYbS-Izp0GWjnS87_jJn4wxCRPUcaNf7z2OyhHGAQmjigKasDHVCLz9Z4KIsXWnLSKTeI-tMi2ndEmrub0pLrFewUkq5AuC-KDV' }}" alt="Modern corporate building" class="h-72 w-full object-cover sm:h-[500px]"/>
          </div>
          <div class="absolute -bottom-6 -left-6 max-w-[220px] rounded-xl bg-[#d4af37] p-6 text-white shadow-xl">
            <p class="text-3xl font-bold">{{ $stats[0]['value'] ?: '0' }}</p>
            <p class="text-xs font-bold uppercase tracking-widest opacity-90">{{ $stats[0]['label'] }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-[#f6f6f8] py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col items-center gap-16 md:flex-row">
        <div class="w-full md:w-1/2">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDM1Tog-lUUiyTDs7C1g8kUcC21fXoq_S41a29rK3Dn1JgB43b0mQDRMV9F0cuhAt1mgmSX6QzxKReJ6z72gYJSkoxyG6Xx0IyawLozqTZ0VzOuvygb-S99kOF9JezM40hRhiFc4d9LqUvBjxBDjSHmWxKxazfat-QCFNvskd4vxNib5ECQO1fKU4RTDOgl6-WncuKGcSvHBHXXF7T7hNQwUELoQ7OsB4creUtGRzv0OldGBT1whkEP1EKzooTeDp4rTbP7A8YwH_mc" alt="Team collaborating" class="rounded-2xl shadow-xl grayscale transition-all duration-700 hover:grayscale-0"/>
        </div>
        <div class="w-full space-y-6 md:w-1/2">
          <h2 class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $introContent['label'] ?: 'Who We Are' }}</h2>
          <h3 class="text-4xl font-bold text-slate-900">{{ $introContent['title'] ?: 'Upturn is dedicated to top-tier corporate services.' }}</h3>
          <p class="text-lg leading-relaxed text-slate-600">{{ $introContent['description'] ?: 'We believe that a strong financial foundation is the cornerstone of every successful enterprise. Our team of certified accountants and legal experts works in tandem to reduce compliance risks while helping clients move forward with confidence.' }}</p>
          <div class="grid grid-cols-2 gap-6 pt-4">
            @foreach ([
              ['verified', 'Excellence', 'Uncompromising standards in every report and recommendation.'],
              ['security', 'Integrity', 'Transparent processes and careful handling of every client record.'],
            ] as $value)
              <div class="space-y-2">
                <span class="material-symbols-outlined text-3xl text-[#1152d4]">{{ $value[0] }}</span>
                <h4 class="text-lg font-bold text-slate-900">{{ $value[1] }}</h4>
                <p class="text-sm text-slate-500">{{ $value[2] }}</p>
              </div>
            @endforeach
          </div>
        </div>
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

  <section class="relative overflow-hidden bg-slate-900 py-24 text-white">
    <div class="pointer-events-none absolute inset-0 opacity-10">
      <div class="absolute right-0 top-0 h-[500px] w-[500px] rounded-full bg-[#1152d4] blur-[120px]"></div>
    </div>
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mb-12 max-w-2xl space-y-4">
        <h2 class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">Live Business Snapshot</h2>
        <h3 class="text-4xl font-bold">Real-time highlights from the backend</h3>
        <p class="text-slate-300">These figures are pulled directly from your active content, available spaces, published updates, and open positions.</p>
      </div>
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
          <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm">
            <p class="mb-3 text-4xl font-bold text-[#d4af37]">{{ $stat['value'] }}</p>
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-slate-300">{{ $stat['label'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="bg-white py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mb-16 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div class="max-w-2xl space-y-4">
          <h2 class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">Latest Updates</h2>
          <h3 class="text-4xl font-bold text-slate-900">Fresh content from your CMS</h3>
          <p class="text-slate-600">Published posts in the admin panel flow straight into this section, keeping the public site current without extra template work.</p>
        </div>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 font-bold text-[#1152d4]">
          Plan your next update <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
      </div>
      <div class="grid gap-8 md:grid-cols-3">
        @forelse ($posts as $post)
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
        @empty
          <div class="md:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h4 class="text-xl font-bold text-slate-900">No published posts yet.</h4>
            <p class="mt-3 text-slate-600">Once you publish announcements or updates in the CMS, they will appear here.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <section class="bg-[#f6f6f8] py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mb-16 max-w-2xl space-y-4">
        <h2 class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">Client Testimonials</h2>
        <h3 class="text-4xl font-bold text-slate-900">Partnering for Growth</h3>
      </div>
      <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($testimonials as $testimonial)
          <div class="flex flex-col justify-between rounded-3xl border border-slate-100 bg-white p-10 shadow-sm">
            <div class="space-y-6">
              <div class="flex text-[#d4af37]">
                @for ($i = 0; $i < max($testimonial['rating'], 1); $i++)
                  <span class="material-symbols-outlined">star</span>
                @endfor
              </div>
              <p class="text-xl italic leading-relaxed text-slate-700">"{{ $testimonial['content'] }}"</p>
            </div>
            <div class="mt-8 flex items-center gap-4">
              <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#1152d4] font-bold text-white">
                {{ $testimonial['initials'] ?: 'UB' }}
              </div>
              <div>
                <p class="font-bold text-slate-900">{{ $testimonial['client_name'] }}</p>
                <p class="text-sm text-slate-500">{{ $testimonial['company'] ?: 'Client Partner' }}</p>
              </div>
            </div>
          </div>
        @empty
          <div class="md:col-span-2 xl:col-span-3 rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-8 py-12 text-center">
            <h4 class="text-xl font-bold text-slate-900">No featured testimonials yet.</h4>
            <p class="mt-3 text-slate-600">Mark testimonials as featured in the admin panel to surface them on the homepage.</p>
          </div>
        @endforelse
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
