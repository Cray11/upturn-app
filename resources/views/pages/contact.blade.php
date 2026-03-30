@extends('layouts.app')
@section('title', 'Contact Us - Upturn Business Solutions')
@section('content')
  @php
    $heroContent = $pageSections['hero'] ?? [];
    $introContent = $pageSections['intro'] ?? [];
    $ctaContent = $pageSections['cta'] ?? [];
    $contactProfile = data_get($companyProfile ?? [], 'contact', []);
    $contactAddress = data_get($contactProfile, 'address', 'Unit 201-202, C&B Circle Mall, Maysan Road, Malinta, Valenzuela City');
    $contactPhone = data_get($contactProfile, 'phone', '+63 921 551 4785');
    $contactEmail = data_get($contactProfile, 'email', 'sales@upturnpartnership.com');
    $officeHoursWeekday = data_get($contactProfile, 'office_hours.weekday', 'Mon - Fri: 8:00 AM - 5:00 PM');
    $officeHoursWeekend = data_get($contactProfile, 'office_hours.weekend', 'Sat: 9:00 AM - 12:00 PM');
    $contactServiceOptions = $serviceOptions->push('Careers')->unique()->values();
    $requestedService = old('service_interest') ?: request('service');
    $selectedService = $contactServiceOptions->first(fn (string $option) => $option === $requestedService);
    $selectedFormDescription = $selectedService
        ? 'Your selected service is already picked below so your quote request reaches the right team faster.'
        : ($introContent['description'] ?: 'Use the contact form below for general inquiries, service requests, or career-related questions.');
  @endphp

  <div class="w-full bg-slate-100">
    <div class="mx-auto max-w-[1280px] px-6 py-12 lg:px-40 lg:py-20">
      <h1 class="text-4xl font-black leading-tight tracking-tight text-slate-900 lg:text-6xl">{{ $heroContent['title'] ?: 'Contact Us' }}</h1>
      <p class="mt-4 max-w-2xl text-lg text-slate-600 lg:text-xl">{{ $heroContent['description'] ?: 'We are here to help your business upturn and thrive. Reach out to our team of experts for tailored business solutions.' }}</p>
    </div>
  </div>

  <div class="mx-auto w-full max-w-[1280px] px-6 py-12 lg:px-40">
    <div class="grid grid-cols-1 gap-16 lg:grid-cols-2">
      <div class="flex flex-col gap-8 rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
        <div class="space-y-3">
          <p class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $introContent['label'] ?: 'Let us know what you need' }}</p>
          <h3 class="text-2xl font-bold text-slate-900">{{ $introContent['title'] ?: 'Send us a Message' }}</h3>
          <p class="text-sm leading-relaxed text-slate-600">{{ $selectedFormDescription }}</p>
        </div>

        @if ($selectedService)
          <div class="rounded-2xl border border-[#1152d4]/15 bg-[#1152d4]/5 p-5">
            <p class="text-xs font-bold uppercase tracking-[0.26em] text-[#1152d4]">Selected Service</p>
            <div class="mt-3 flex items-center justify-between gap-4">
              <div>
                <p class="text-lg font-bold text-slate-900">{{ $selectedService }}</p>
                <p class="mt-1 text-sm leading-relaxed text-slate-600">The service interest field below has been prefilled from your quote request.</p>
              </div>
              <a href="{{ route('services') }}" class="inline-flex items-center gap-2 rounded-full border border-[#1152d4]/15 bg-white px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-[#1152d4] transition-all hover:border-[#1152d4]/30 hover:bg-[#1152d4]/5">
                Back to Services
                <span class="material-symbols-outlined text-sm">arrow_back</span>
              </a>
            </div>
          </div>
        @endif

        <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="flex flex-col gap-6">
          @csrf
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required class="w-full rounded-lg border-slate-300 bg-white p-3 text-slate-900 focus:border-[#1152d4] focus:ring-[#1152d4] @error('name') border-red-400 @enderror"/>
            @error('name')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required class="w-full rounded-lg border-slate-300 bg-white p-3 text-slate-900 focus:border-[#1152d4] focus:ring-[#1152d4] @error('email') border-red-400 @enderror"/>
            @error('email')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Contact Number</label>
            <input type="text" name="contact_no" value="{{ old('contact_no') }}" placeholder="+63 9XX XXX XXXX" required class="w-full rounded-lg border-slate-300 bg-white p-3 text-slate-900 focus:border-[#1152d4] focus:ring-[#1152d4] @error('contact_no') border-red-400 @enderror"/>
            @error('contact_no')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Business Name</label>
            <input type="text" name="business_name" value="{{ old('business_name') }}" placeholder="Company or business name" class="w-full rounded-lg border-slate-300 bg-white p-3 text-slate-900 focus:border-[#1152d4] focus:ring-[#1152d4] @error('business_name') border-red-400 @enderror"/>
            @error('business_name')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Service Interest</label>
            <select name="service_interest" class="w-full rounded-lg border-slate-300 bg-white p-3 text-slate-900 focus:border-[#1152d4] focus:ring-[#1152d4]">
              <option value="">General Inquiry</option>
              @foreach ($contactServiceOptions as $option)
                <option value="{{ $option }}" @selected(old('service_interest', $selectedService) === $option)>{{ $option }}</option>
              @endforeach
            </select>
          </div>
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Message</label>
            <textarea name="message" rows="4" placeholder="How can we help your business?" required class="w-full resize-none rounded-lg border-slate-300 bg-white p-3 text-slate-900 focus:border-[#1152d4] focus:ring-[#1152d4] @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
            @error('message')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#1152d4] py-4 font-bold text-white shadow-lg transition-all hover:bg-opacity-90">
            <span>Send Message</span>
            <span class="material-symbols-outlined text-sm">send</span>
          </button>
        </form>
      </div>

      <div class="flex flex-col gap-10">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
          <div class="flex flex-col gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#1152d4]/10 text-[#1152d4]">
              <span class="material-symbols-outlined">location_on</span>
            </div>
            <h4 class="font-bold text-slate-900">Office Address</h4>
            <p class="text-sm leading-relaxed text-slate-600">{{ $contactAddress }}</p>
          </div>
          <div class="flex flex-col gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#d4af37]/10 text-[#d4af37]">
              <span class="material-symbols-outlined">call</span>
            </div>
            <h4 class="font-bold text-slate-900">Phone Number</h4>
            <p class="text-sm leading-relaxed text-slate-600">
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}" class="hover:text-[#1152d4]">{{ $contactPhone }}</a>
            </p>
          </div>
          <div class="flex flex-col gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#1152d4]/10 text-[#1152d4]">
              <span class="material-symbols-outlined">mail</span>
            </div>
            <h4 class="font-bold text-slate-900">Email Address</h4>
            <p class="text-sm leading-relaxed text-slate-600">
              <a href="mailto:{{ $contactEmail }}" class="hover:text-[#1152d4]">{{ $contactEmail }}</a>
            </p>
          </div>
          <div class="flex flex-col gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#d4af37]/10 text-[#d4af37]">
              <span class="material-symbols-outlined">schedule</span>
            </div>
            <h4 class="font-bold text-slate-900">Office Hours</h4>
            <p class="text-sm leading-relaxed text-slate-600">{{ $officeHoursWeekday }}<br/>{{ $officeHoursWeekend }}</p>
          </div>
        </div>

        <div class="relative h-[300px] w-full overflow-hidden rounded-xl border border-slate-200 bg-slate-200">
          <div class="absolute inset-0 flex flex-col items-center justify-center bg-slate-300/20">
            <span class="material-symbols-outlined mb-2 text-4xl text-slate-400">map</span>
            <span class="font-medium text-slate-500">Map View: Valenzuela City</span>
          </div>
          <div class="h-full w-full bg-cover bg-center opacity-50 grayscale transition-all duration-500 hover:grayscale-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBPyLPGnSLDNisUjrxPZPwFm47e__FMCnvnGQmyLBaBp-ktdt9QO_fFLp0CJCGlHLSgAhwnfxsbxacuJbtPgod3M-6GLM8YxqU3f2cLzcdU-C2_f46E7n-lG8BIwUOc4IlNwh3IrrAxLpg_SpIv0-m1aXqXeSADWWAmBa6Dy6-ILLYn5VzTvZoh7NtlsYGI0akwC0pYxLfuBpqFjUz58sTDpuWCwNb7ap5UU_67oHFYHxY5MZ7p5_Hh7vG_S8jfHHeHiqdo7JEgul5v');"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="w-full bg-[#1152d4] py-16">
    <div class="mx-auto flex max-w-[1280px] flex-col items-center justify-between gap-8 px-6 text-white lg:flex-row lg:px-40">
      <div class="flex flex-col gap-2 text-center lg:text-left">
        <h2 class="text-3xl font-bold">{{ $ctaContent['title'] ?: 'Ready to scale your business?' }}</h2>
        <p class="font-medium text-white/80">{{ $ctaContent['description'] ?: 'Let\'s discuss how Upturn can transform your operations.' }}</p>
      </div>
      <div class="flex gap-4">
        <a href="{{ $ctaContent['primary_button_url'] ?: route('contact') }}" class="rounded-lg bg-white px-8 py-3 font-bold text-[#1152d4] transition-colors hover:bg-slate-100">{{ $ctaContent['primary_button_label'] ?: 'Schedule a Call' }}</a>
        <a href="{{ $ctaContent['secondary_button_url'] ?: route('services') }}" class="rounded-lg border-2 border-white px-8 py-3 font-bold text-white transition-colors hover:bg-white/10">{{ $ctaContent['secondary_button_label'] ?: 'View Services' }}</a>
      </div>
    </div>
  </div>

@endsection
