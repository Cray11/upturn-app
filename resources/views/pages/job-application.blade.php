@extends('layouts.app')
@section('title', $jobPosting->title . ' - Upturn Business Solutions')
@section('content')

  <section class="relative overflow-hidden bg-slate-900 py-24">
    <div class="pointer-events-none absolute inset-0 opacity-10">
      <div class="absolute right-0 top-0 h-[500px] w-[500px] rounded-full bg-[#1152d4] blur-[120px]"></div>
      <div class="absolute bottom-0 left-0 h-[300px] w-[300px] rounded-full bg-[#d4af37]/30 blur-[80px]"></div>
    </div>
    <div class="relative z-10 mx-auto max-w-5xl px-4 text-center text-white sm:px-6 lg:px-8">
      <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-[#d4af37]/20 bg-[#1152d4]/20 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#d4af37]">
        <span class="h-2 w-2 animate-pulse rounded-full bg-[#d4af37]"></span>
        Careers at Upturn
      </div>
      <h1 class="text-4xl font-black tracking-tight md:text-6xl">{{ $jobPosting->title }}</h1>
      <p class="mx-auto mt-6 max-w-3xl text-lg leading-relaxed text-slate-300 md:text-xl">
        Apply for a role that lets you grow with a team focused on compliance excellence, professional development, and meaningful client work.
      </p>
      <div class="mt-8 flex flex-wrap items-center justify-center gap-3 text-sm text-slate-200">
        <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2">{{ $jobPosting->department ?: 'Department to be confirmed' }}</span>
        <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2">{{ $jobPosting->location ?: 'Valenzuela City' }}</span>
        <span class="rounded-full border border-white/10 bg-white/5 px-4 py-2">{{ str($jobPosting->employment_type)->replace('_', ' ')->title() }}</span>
      </div>
    </div>
  </section>

  <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    @if ($errors->any())
      <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
        <p class="font-semibold">Please review the highlighted fields before submitting your application.</p>
      </div>
    @endif

    <div class="grid gap-8 lg:grid-cols-[0.88fr_1.12fr]">
      <div class="space-y-8">
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
          <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="text-2xl font-bold text-slate-900">Role Overview</h2>
          </div>
          <div class="space-y-6 px-6 py-6">
            <div>
              <p class="text-xs font-bold uppercase tracking-[0.24em] text-slate-500">Role Summary</p>
              <div class="prose mt-3 max-w-none prose-slate">{!! $jobPosting->description !!}</div>
            </div>
            @if ($jobPosting->requirements)
              <div>
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-slate-500">Requirements</p>
                <div class="prose mt-3 max-w-none prose-slate">{!! $jobPosting->requirements !!}</div>
              </div>
            @endif
            <div class="grid gap-4 sm:grid-cols-2">
              <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Employment Type</p>
                <p class="mt-2 font-semibold text-slate-900">{{ str($jobPosting->employment_type)->replace('_', ' ')->title() }}</p>
              </div>
              <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Deadline</p>
                <p class="mt-2 font-semibold text-slate-900">{{ $jobPosting->deadline?->format('F j, Y') ?? 'Open until filled' }}</p>
              </div>
            </div>
          </div>
        </div>

        @if ($relatedRoles->isNotEmpty())
          <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
              <h2 class="text-2xl font-bold text-slate-900">Other Open Roles</h2>
            </div>
            <div class="space-y-4 px-6 py-6">
              @foreach ($relatedRoles as $relatedRole)
                <a href="{{ route('careers.show', $relatedRole) }}" class="block rounded-2xl border border-slate-200 px-5 py-4 transition hover:-translate-y-0.5 hover:border-[#1152d4] hover:shadow-sm">
                  <p class="text-lg font-bold text-slate-900">{{ $relatedRole->title }}</p>
                  <p class="mt-1 text-sm text-slate-500">{{ $relatedRole->department ?: 'Department to be confirmed' }} | {{ $relatedRole->location ?: 'Valenzuela City' }}</p>
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </div>

      <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-6 sm:px-8">
          <h2 class="text-3xl font-black text-slate-900">Apply for this role</h2>
          <p class="mt-3 text-sm leading-6 text-slate-600">
            Complete the form below and upload your resume as a PDF. Your submission will be reviewed by our hiring team.
          </p>
        </div>

        <form action="{{ route('careers.apply', $jobPosting) }}" method="POST" enctype="multipart/form-data" class="space-y-10 px-6 py-6 sm:px-8 sm:py-8">
          @csrf

          <section>
            <div class="mb-6 flex items-center gap-2 border-b border-slate-100 pb-2">
              <span class="material-symbols-outlined text-[#1152d4]">person</span>
              <h3 class="text-xl font-bold text-slate-900">Personal Information</h3>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
              <div class="md:col-span-2">
                <label for="applicant_name" class="mb-2 block text-sm font-semibold text-slate-700">Full Name *</label>
                <input id="applicant_name" type="text" name="applicant_name" value="{{ old('applicant_name') }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('applicant_name') border-red-400 @enderror"/>
                @error('applicant_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email Address *</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('email') border-red-400 @enderror"/>
                @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="contact_no" class="mb-2 block text-sm font-semibold text-slate-700">Contact Number *</label>
                <input id="contact_no" type="text" name="contact_no" value="{{ old('contact_no') }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('contact_no') border-red-400 @enderror"/>
                @error('contact_no')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
              <div class="md:col-span-2">
                <label for="address" class="mb-2 block text-sm font-semibold text-slate-700">Home Address *</label>
                <input id="address" type="text" name="address" value="{{ old('address') }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('address') border-red-400 @enderror"/>
                @error('address')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
              <div class="md:col-span-2">
                <label for="transportation_mode" class="mb-2 block text-sm font-semibold text-slate-700">Mode of Transportation to Valenzuela *</label>
                <input id="transportation_mode" type="text" name="transportation_mode" value="{{ old('transportation_mode') }}" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('transportation_mode') border-red-400 @enderror"/>
                @error('transportation_mode')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
            </div>
          </section>

          <section>
            <div class="mb-6 flex items-center gap-2 border-b border-slate-100 pb-2">
              <span class="material-symbols-outlined text-[#1152d4]">work</span>
              <h3 class="text-xl font-bold text-slate-900">Professional Background</h3>
            </div>
            <div class="space-y-6">
              <div>
                <label for="professional_summary" class="mb-2 block text-sm font-semibold text-slate-700">Professional Summary *</label>
                <textarea id="professional_summary" name="professional_summary" rows="4" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('professional_summary') border-red-400 @enderror">{{ old('professional_summary') }}</textarea>
                @error('professional_summary')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="educational_background" class="mb-2 block text-sm font-semibold text-slate-700">Educational Background *</label>
                <textarea id="educational_background" name="educational_background" rows="4" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('educational_background') border-red-400 @enderror">{{ old('educational_background') }}</textarea>
                @error('educational_background')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                  <label for="recent_company" class="mb-2 block text-sm font-semibold text-slate-700">Most Recent Company</label>
                  <input id="recent_company" type="text" name="recent_company" value="{{ old('recent_company') }}" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('recent_company') border-red-400 @enderror"/>
                  @error('recent_company')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                  <label for="recent_position" class="mb-2 block text-sm font-semibold text-slate-700">Most Recent Position</label>
                  <input id="recent_position" type="text" name="recent_position" value="{{ old('recent_position') }}" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('recent_position') border-red-400 @enderror"/>
                  @error('recent_position')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
              </div>
              <div>
                <label for="opportunity_reason" class="mb-2 block text-sm font-semibold text-slate-700">Reason for Seeking New Opportunities *</label>
                <textarea id="opportunity_reason" name="opportunity_reason" rows="4" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('opportunity_reason') border-red-400 @enderror">{{ old('opportunity_reason') }}</textarea>
                @error('opportunity_reason')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="best_time_to_contact" class="mb-2 block text-sm font-semibold text-slate-700">Best Time to Contact *</label>
                <input id="best_time_to_contact" type="text" name="best_time_to_contact" value="{{ old('best_time_to_contact') }}" placeholder="Weekdays after 2 PM" required class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-[#1152d4] focus:ring-[#1152d4] @error('best_time_to_contact') border-red-400 @enderror"/>
                @error('best_time_to_contact')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
              </div>
            </div>
          </section>

          <section>
            <div class="mb-6 flex items-center gap-2 border-b border-slate-100 pb-2">
              <span class="material-symbols-outlined text-[#1152d4]">upload_file</span>
              <h3 class="text-xl font-bold text-slate-900">Upload Resume</h3>
            </div>
            <div class="rounded-xl border-2 border-dashed border-slate-300 p-6 text-center transition-colors hover:border-[#1152d4]">
              <span class="material-symbols-outlined mb-3 block text-4xl text-slate-400">upload_file</span>
              <p class="text-sm text-slate-500">Upload a PDF resume up to 10MB.</p>
              <input id="resume" type="file" name="resume" accept="application/pdf" required class="mx-auto mt-4 block text-sm text-slate-600"/>
              @error('resume')<p class="mt-2 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
          </section>

          <button type="submit" class="w-full rounded-xl bg-[#1152d4] py-4 text-lg font-black text-white shadow-lg transition-all hover:bg-[#1152d4]/90">
            Submit Application
          </button>
        </form>
      </div>
    </div>
  </main>

@endsection
