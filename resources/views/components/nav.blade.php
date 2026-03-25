@php
  $navLinks = [
    ['label' => 'Home', 'route' => 'home'],
    ['label' => 'Services', 'route' => 'services'],
    ['label' => 'About Us', 'route' => 'about'],
    ['label' => 'Engagements', 'route' => 'engagements'],
    ['label' => 'Careers', 'route' => 'careers'],
  ];
@endphp

<header class="sticky top-0 z-50 w-full border-b border-blue-500/30 bg-slate-900 backdrop-blur-md">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-[72px] items-center justify-between">
      <a href="{{ route('home') }}" class="flex flex-shrink-0 items-center gap-3 px-3 py-2">
        <img src="{{ asset('images/upturnlogo.png') }}" alt="Upturn Logo" class="h-9 w-9 object-contain"/>
        <span class="text-lg font-bold tracking-tight">
          <span class="text-[#D4AF37]">Upturn</span>
          <span class="text-white/90"> Business Solutions</span>
        </span>
      </a>

      <nav class="hidden items-center gap-8 lg:flex">
        @foreach ($navLinks as $link)
          <a
            href="{{ route($link['route']) }}"
            class="{{ request()->routeIs($link['route']) ? 'border-b-2 border-[#D4AF37] pb-0.5 text-sm font-bold text-white' : 'text-sm font-medium text-white/80 transition-colors hover:text-white' }}"
          >
            {{ $link['label'] }}
          </a>
        @endforeach
      </nav>

      <div class="hidden items-center gap-3 lg:flex">
        <a href="{{ route('contact') }}" class="rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-[#1152d4] shadow-sm transition-all hover:bg-slate-100">
          Contact Us
        </a>
      </div>

      <button
        id="hamburger-btn"
        aria-label="Open menu"
        aria-expanded="false"
        class="flex h-10 w-10 items-center justify-center rounded-lg text-white transition-colors hover:bg-white/10 lg:hidden"
      >
        <span class="material-symbols-outlined" id="hamburger-icon">menu</span>
      </button>
    </div>
  </div>
</header>

<div id="mobile-overlay" class="pointer-events-none fixed inset-0 z-40 bg-black/40 opacity-0 backdrop-blur-sm transition-opacity duration-300 lg:hidden"></div>

<div id="mobile-drawer" class="fixed right-0 top-0 z-50 flex h-full w-72 max-w-[85vw] translate-x-full flex-col bg-white shadow-2xl transition-transform duration-300 ease-in-out lg:hidden">
  <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
    <div class="flex items-center gap-2">
      <img src="{{ asset('images/upturnlogo.png') }}" alt="Upturn Logo" class="h-8 w-8 object-contain"/>
      <span class="text-sm font-bold text-slate-900">Upturn Business</span>
    </div>
    <button id="close-drawer-btn" aria-label="Close menu" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-900">
      <span class="material-symbols-outlined text-lg">close</span>
    </button>
  </div>

  <nav class="flex flex-1 flex-col overflow-y-auto py-2">
    @foreach ($navLinks as $link)
      <a
        href="{{ route($link['route']) }}"
        class="flex items-center gap-3 border-b border-slate-100 px-6 py-4 text-sm font-semibold transition-all duration-150 {{ request()->routeIs($link['route']) ? 'border-l-4 border-l-[#1152d4] bg-blue-50 pl-5 text-[#1152d4]' : 'text-slate-700 hover:bg-slate-50 hover:text-[#1152d4]' }}"
      >
        {{ $link['label'] }}
      </a>
    @endforeach
  </nav>

  <div class="border-t border-slate-100 p-5">
    <a href="{{ route('contact') }}" class="flex h-11 w-full items-center justify-center rounded-lg bg-[#1152d4] text-sm font-bold text-white shadow-sm transition-all hover:bg-[#1152d4]/90">
      Contact Us
    </a>
  </div>
</div>

@push('scripts')
<script>
  (function () {
    const btn = document.getElementById('hamburger-btn');
    const icon = document.getElementById('hamburger-icon');
    const drawer = document.getElementById('mobile-drawer');
    const overlay = document.getElementById('mobile-overlay');
    const closeBtn = document.getElementById('close-drawer-btn');

    if (!btn || !icon || !drawer || !overlay || !closeBtn) {
      return;
    }

    const open = () => {
      drawer.classList.remove('translate-x-full');
      overlay.classList.remove('opacity-0', 'pointer-events-none');
      overlay.classList.add('opacity-100');
      icon.textContent = 'close';
      btn.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    };

    const close = () => {
      drawer.classList.add('translate-x-full');
      overlay.classList.add('opacity-0', 'pointer-events-none');
      overlay.classList.remove('opacity-100');
      icon.textContent = 'menu';
      btn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    };

    btn.addEventListener('click', open);
    closeBtn.addEventListener('click', close);
    overlay.addEventListener('click', close);
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        close();
      }
    });
  })();
</script>
@endpush
