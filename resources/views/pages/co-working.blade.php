@extends('layouts.app')
@section('title', 'Book a Space - Upturn Business Solutions')
@section('content')
  @php
    $heroContent = $pageSections['hero'] ?? [];
    $introContent = $pageSections['intro'] ?? [];
    $ctaContent = $pageSections['cta'] ?? [];
  @endphp

  <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-10 lg:py-20">
    <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
      <div class="order-2 flex flex-col gap-6 lg:order-1">
        <span class="inline-flex items-center rounded-full bg-[#D4AF37]/20 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#D4AF37]">{{ $heroContent['label'] ?: 'Premium Workspaces' }}</span>
        <h1 class="text-3xl font-black leading-tight text-slate-900 sm:text-4xl lg:text-6xl">
          {{ $heroContent['title'] ?: 'Modern Co-working Space' }}  
        </h1>
        <p class="max-w-lg text-lg leading-relaxed text-slate-600">{{ $heroContent['description'] ?: 'Elevate your productivity in our high-fidelity professional environments designed for business growth and collaborative success.' }}</p>
        <div class="flex gap-4">
          <a href="{{ $heroContent['primary_button_url'] ?: '#booking-form' }}" class="rounded-lg bg-[#1152d4] px-8 py-4 font-bold text-white transition-all hover:bg-[#1152d4]/90">{{ $heroContent['primary_button_label'] ?: 'Book Now' }}</a>
          <a href="{{ $heroContent['secondary_button_url'] ?: '#spaces' }}" class="rounded-lg border border-slate-300 px-8 py-4 font-bold transition-all hover:bg-slate-50">{{ $heroContent['secondary_button_label'] ?: 'Explore Gallery' }}</a>
        </div>
      </div>
      <div class="order-1 lg:order-2">
        <div class="relative h-[250px] overflow-hidden rounded-xl shadow-2xl sm:h-[400px] lg:h-[500px]">
          <img src="{{ $heroContent['image_url'] ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAH7Aatm_snHCoEGFvQhlkGTT_B6cYoBrg-KXUJDFyaAnTZdodKD6IoEeJu5SR1oNLxm_ZSWSIXmjKTa0a6KMpxrQCF6zqtR7WjFfQgdJ0PU828OpPnrN14yZPul8jXNGHlHGA_MK_nVo1bi2aEdMhYVfs7Nmba9zxK4TCG4LXHbLVRgjZmiYqXOcpEdK4G4SW9I4Ju1JUibgVmx9bVsH4HXaep1mptTaYm4rJkX6wDhu2cxL3fyD4KdMTBBLpj5rx6I2gFXHc_7QqS' }}" alt="Modern office interior" class="h-full w-full object-cover"/>
          <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-slate-50 py-20" id="spaces">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-10">
      <div class="mb-12">
        <p class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $introContent['label'] ?: 'Workspace Options' }}</p>
        <h2 class="mb-4 mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">{{ $introContent['title'] ?: 'Our Premium Spaces' }}</h2>
        <p class="text-slate-600">{{ $introContent['description'] ?: 'Select the environment that best suits your needs.' }}</p>
      </div>
      <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2">
        @foreach([
          ['8-Seater Conference Room', 'Private', 'Perfect for board meetings, presentations, and collaborative workshops with full tech support.', ['8 Pax', 'High Speed', 'Smart Display'], 'https://lh3.googleusercontent.com/aida-public/AB6AXuCeNiT4AV5sIJbrYkXt2-dqbQnkhjSjJV9yE37EDzMmabAj_f-J79VwinsKbRKSRuvvfJFPa20Ymr36zSTwrROOtq4H6FpxIrjA2k2aPhCpPtTEI2zi80InimQpK94U5gqBGYeRnCgYkuRTBlHaHFtbJuqTJXcm6SadaaxpGHiehNBqfWo-s5EaDI9EIuK-SS7t1FOpdzLVBLyhn12Ndx94RSihQmXzd4wEmTPRa2vLCPxMETR1L3JbYELHlAiODovuQ1vnMWMTpe0J', '#D4AF37'],
          ['Open Co-working Space', 'Community', 'Flexible hot-desks in a vibrant professional community. Ideal for freelancers and remote teams.', ['Flexi Desk', 'Coffee Bar', 'Lockers'], 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUREn9Dg0yDlV8tp1VpBDHWK5pulEfswTLrah8lMRIPpjnqkJjPCXM2hcD6PO5XYbYFm1F7uIhlmcHqIHZV1PWIlXIRrAQr-xiLx5N0aWShsRO2xRq3qmimNuQ51hc6kg-xE4yDU_BXgpv5dF14DLoN--f4DFcFw5yvJQ-lytg6ZaxXoEXcGggTYCK0I3FMHnvNb36pMEgKBKXbaH5djTqVcDExF3v8y1zVVpKveoNHT7_238Jxmy_TTmAPWVJOOw3TVSaTKBmRdrp', '#1152d4'],
        ] as $space)
          <div class="group overflow-hidden rounded-xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-xl">
            <div class="relative h-64 overflow-hidden">
              <img src="{{ $space[4] }}" alt="{{ $space[0] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"/>
            </div>
            <div class="p-6">
              <div class="mb-2 flex items-start justify-between">
                <h3 class="text-xl font-bold text-slate-900">{{ $space[0] }}</h3>
                <span class="rounded px-2 py-1 text-xs font-bold" style="background-color: {{ $space[5] }}1a; color: {{ $space[5] }};">{{ $space[1] }}</span>
              </div>
              <p class="mb-6 text-slate-600">{{ $space[2] }}</p>
              <div class="mb-6 flex items-center gap-4 text-sm text-slate-500">
                @foreach ($space[3] as $feature)
                  <span class="flex items-center gap-1"><span class="material-symbols-outlined text-base">check_circle</span> {{ $feature }}</span>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 sm:py-24" id="booking-form">
    <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-2xl">
      <div class="bg-[#1152d4] px-6 py-8 text-center text-white sm:px-10 sm:py-12">
        <p class="text-sm font-bold uppercase tracking-widest text-[#d4af37]">{{ $ctaContent['label'] ?: 'Booking Request' }}</p>
        <h2 class="mb-4 mt-3 text-2xl font-bold sm:text-3xl">{{ $ctaContent['title'] ?: 'Reserve Your Space' }}</h2>
        <p class="mx-auto max-w-md text-white/80">{{ $ctaContent['description'] ?: 'Fill in the details below and our team will contact you to confirm pricing and availability offline.' }}</p>
      </div>
      <div class="p-6 sm:p-10">
        @if ($errors->any())
          <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            Please review the highlighted fields and try again.
          </div>
        @endif

        <form action="{{ route('co-working.store') }}" method="POST" class="grid grid-cols-1 gap-8 md:grid-cols-2">
          @csrf
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required class="w-full rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-transparent focus:ring-2 focus:ring-[#1152d4] @error('name') border-red-400 @enderror"/>
            @error('name')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required class="w-full rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-transparent focus:ring-2 focus:ring-[#1152d4] @error('email') border-red-400 @enderror"/>
            @error('email')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Contact Number</label>
            <input type="text" name="contact_no" value="{{ old('contact_no') }}" placeholder="+63 9XX XXX XXXX" required class="w-full rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-transparent focus:ring-2 focus:ring-[#1152d4] @error('contact_no') border-red-400 @enderror"/>
            @error('contact_no')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold text-slate-700">Choice of Space</label>
            <select name="space_type" required class="w-full rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-transparent focus:ring-2 focus:ring-[#1152d4] @error('space_type') border-red-400 @enderror">
              <option value="8-Seater Conference Room" @selected(old('space_type') === '8-Seater Conference Room')>8-Seater Conference Room</option>
              <option value="Open Co-working Space" @selected(old('space_type') === 'Open Co-working Space')>Open Co-working Space</option>
            </select>
            @error('space_type')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="flex flex-col gap-2 md:col-span-2">
            <label class="text-sm font-semibold text-slate-700">Preferred Booking Date and Time</label>
            <div class="flex flex-col gap-4 sm:flex-row">
              <input type="date" name="booking_date" value="{{ old('booking_date') }}" required class="flex-1 rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-transparent focus:ring-2 focus:ring-[#1152d4] @error('booking_date') border-red-400 @enderror"/>
              <input type="time" name="booking_time" value="{{ old('booking_time') }}" required class="flex-1 rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-transparent focus:ring-2 focus:ring-[#1152d4] @error('booking_time') border-red-400 @enderror"/>
            </div>
            @error('booking_date')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
            @error('booking_time')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
          </div>
          <div class="pt-4 md:col-span-2">
            <button type="submit" class="w-full rounded-lg bg-[#D4AF37] py-4 text-base font-black text-slate-900 shadow-lg transition-all hover:-translate-y-0.5 hover:brightness-105 sm:text-lg">
              Confirm Booking Request
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

@endsection
