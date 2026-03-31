<section id="testimonial-form" class="relative overflow-hidden bg-[linear-gradient(180deg,#eef4ff_0%,#f6f6f8_42%,#eef1f8_100%)] py-24">
  <div class="pointer-events-none absolute inset-0">
    <div class="absolute -left-10 top-16 h-64 w-64 rounded-full bg-[#1152d4]/10 blur-[100px]"></div>
    <div class="absolute bottom-10 right-0 h-72 w-72 rounded-full bg-[#d4af37]/10 blur-[120px]"></div>
  </div>

  <div class="relative mx-auto max-w-[92rem] px-4 sm:px-6 lg:px-8">
    <div class="mb-14 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
      <div class="max-w-3xl space-y-4">
        <span class="inline-block rounded-full bg-[#d4af37]/10 px-4 py-1.5 text-[10px] font-bold uppercase tracking-widest text-[#a6892a]">
          Client Success
        </span>
        <h3 class="text-4xl font-black tracking-tight text-slate-800 md:text-6xl">
          Client <span class="text-[#d4af37]">Testimonials</span>
        </h3>
      </div>

      <div class="flex flex-wrap items-center gap-3">
        <button type="button" data-testimonial-open class="group inline-flex items-center gap-2 rounded-2xl bg-[#1152d4] px-8 py-4 text-sm font-bold text-white transition-all hover:bg-[#0d41aa] hover:shadow-[0_20px_40px_rgba(17,82,212,0.3)] active:scale-95">
          Leave a Testimonial
          <span class="material-symbols-outlined text-lg transition-transform group-hover:rotate-12">edit_square</span>
        </button>
      </div>
    </div>

    @if ($testimonialCount > 1)
      <div class="group/container relative rounded-[3rem] bg-white/80 p-2 shadow-[0_40px_100px_rgba(15,23,42,0.08)] backdrop-blur-xl md:p-4">
        <div class="pointer-events-none absolute inset-y-0 left-0 z-20 w-32 rounded-l-[3rem] bg-gradient-to-r from-white/80 to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 z-20 w-32 rounded-r-[3rem] bg-gradient-to-l from-white/80 to-transparent"></div>

        <div class="mb-8 p-6 pb-0">
          <p class="text-[10px] font-bold uppercase tracking-[0.4em] text-[#1152d4]">Client Notes Wall</p>
          <h4 class="mt-3 max-w-2xl text-xl font-bold leading-snug text-slate-700 md:text-2xl">
            A testimonial is a story of a <span class="text-[#1152d4]">partnership</span> that worked and a promise kept.
          </h4>
        </div>

        <div class="testimonial-marquee overflow-hidden group-hover/container:[animation-play-state:paused]" style="--testimonial-marquee-duration: {{ $testimonialMarqueeDuration }}s;">
          <div class="testimonial-marquee-track flex gap-8 py-8">
            @foreach ($marqueeTestimonials as $testimonial)
              <x-home.testimonial-note
                :testimonial="$testimonial"
                class="w-[400px] shrink-0 transition-all duration-500 hover:-translate-y-2"
              />
            @endforeach
          </div>
        </div>
      </div>
    @elseif ($testimonialCount === 1)
      <div class="mx-auto max-w-3xl">
        <x-home.testimonial-note
          :testimonial="$testimonials->first()"
          class="w-full max-w-none"
          surface-class="flex h-full flex-col rounded-3xl bg-white p-10 shadow-2xl shadow-blue-900/5 transition-transform hover:scale-[1.01]"
        />
      </div>
    @else
      <div class="rounded-3xl border border-dashed border-slate-300 bg-white/80 px-8 py-12 text-center shadow-sm">
        <h4 class="text-xl font-bold text-slate-900">No featured testimonials yet.</h4>
        <p class="mt-3 text-slate-600">Client stories and testimonials will be featured here soon.</p>
      </div>
    @endif
  </div>
</section>
