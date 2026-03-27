<div id="testimonial-modal" class="fixed inset-0 z-[90] hidden">
  <div data-testimonial-overlay class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>

  <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
    <div class="relative w-full max-w-5xl overflow-hidden rounded-[2rem] border border-white/10 bg-white shadow-2xl">
      <button
        type="button"
        data-testimonial-close
        class="absolute right-4 top-4 z-20 flex h-11 w-11 items-center justify-center rounded-full bg-slate-900/80 text-white transition hover:bg-slate-900"
      >
        <span class="material-symbols-outlined">close</span>
      </button>

      <div class="grid gap-0 lg:grid-cols-[0.9fr_1.1fr]">
        <div class="bg-[#0c1424] px-8 py-10 text-white md:px-10 md:py-12">
          <p class="text-sm font-bold uppercase tracking-[0.28em] text-[#d4af37]">Share Your Experience</p>
          <h4 class="mt-4 text-3xl font-black">Leave a Testimonial</h4>
          <p class="mt-5 text-base leading-8 text-slate-300">
            Tell us about your experience working with Upturn Business Solutions. Your testimonial will be reviewed by the admin before it is published on the website.
          </p>

          <div class="mt-8 space-y-4">
            @foreach ($testimonialReviewNotes as $note)
              <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                <span class="material-symbols-outlined mt-0.5 text-[#d4af37]">check_circle</span>
                <p class="text-sm leading-7 text-slate-200">{{ $note }}</p>
              </div>
            @endforeach
          </div>
        </div>

        <div class="max-h-[85vh] overflow-y-auto p-8 md:p-10">
          @if ($testimonialFormHasErrors)
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
              Please review the testimonial form fields and try again.
            </div>
          @endif

          <form action="{{ route('testimonials.store') }}" method="POST" class="grid gap-6 md:grid-cols-2">
            @csrf

            <div class="flex flex-col gap-2">
              <label for="client_name" class="text-sm font-semibold text-slate-700">Full Name</label>
              <input id="client_name" type="text" name="client_name" value="{{ old('client_name') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 outline-none transition focus:border-[#1152d4] focus:ring-2 focus:ring-[#1152d4]/15 @error('client_name') border-red-400 @enderror" placeholder="Juan Dela Cruz" required>
              @error('client_name')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex flex-col gap-2">
              <label for="company" class="text-sm font-semibold text-slate-700">Company</label>
              <input id="company" type="text" name="company" value="{{ old('company') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 outline-none transition focus:border-[#1152d4] focus:ring-2 focus:ring-[#1152d4]/15 @error('company') border-red-400 @enderror" placeholder="Business or organization name">
              @error('company')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
              <label for="rating" class="text-sm font-semibold text-slate-700">Rating</label>
              <select id="rating" name="rating" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-900 outline-none transition focus:border-[#1152d4] focus:ring-2 focus:ring-[#1152d4]/15 @error('rating') border-red-400 @enderror" required>
                @foreach ([5, 4, 3, 2, 1] as $rating)
                  <option value="{{ $rating }}" @selected((int) old('rating', 5) === $rating)>{{ $rating }} Star{{ $rating > 1 ? 's' : '' }}</option>
                @endforeach
              </select>
              @error('rating')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
              <label for="content" class="text-sm font-semibold text-slate-700">Your Testimonial</label>
              <textarea id="content" name="content" rows="5" class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3 text-slate-900 outline-none transition focus:border-[#1152d4] focus:ring-2 focus:ring-[#1152d4]/15 @error('content') border-red-400 @enderror" placeholder="Share what it was like working with Upturn Business Solutions." required>{{ old('content') }}</textarea>
              @error('content')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-between gap-4 md:col-span-2">
              <p class="text-xs uppercase tracking-[0.22em] text-slate-400">Admin review required before publishing</p>
              <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-[#d4af37] px-7 py-3.5 text-sm font-bold text-slate-900 transition-all hover:-translate-y-0.5 hover:shadow-lg">
                Submit Testimonial
                <span class="material-symbols-outlined text-sm">send</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
