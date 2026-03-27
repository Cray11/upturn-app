@php
  $links = $links ?? [
    ['label' => 'Home', 'route' => 'home'],
    ['label' => 'Services', 'route' => 'services'],
    ['label' => 'About Us', 'route' => 'about'],
    ['label' => 'Engagements', 'route' => 'engagements'],
    ['label' => 'Careers', 'route' => 'careers'],
  ];

  $variant = $variant ?? 'default';
  $showContact = $showContact ?? true;
  $ctaLabel = $ctaLabel ?? 'Contact Us';
  $ctaTarget = $ctaTarget ?? 'contact';

  $ctaHref = \Illuminate\Support\Str::startsWith($ctaTarget, ['http://', 'https://', '/', '#'])
      ? $ctaTarget
      : route($ctaTarget);

  $headerClass = match ($variant) {
      'floating' => 'sticky top-0 z-50 w-full px-3 pt-3 sm:px-4 sm:pt-4',
      'minimal' => 'sticky top-0 z-50 w-full border-b border-slate-200 bg-white/95 backdrop-blur-md',
      default => 'sticky top-0 z-50 w-full border-b border-blue-500/30 bg-slate-900 backdrop-blur-md',
  };

  $wrapperClass = match ($variant) {
      'floating' => 'mx-auto max-w-7xl rounded-[24px] border border-white/10 bg-slate-900/90 px-4 shadow-2xl backdrop-blur-md sm:px-6 lg:px-8',
      default => 'mx-auto max-w-7xl px-4 sm:px-6 lg:px-8',
  };

  $brandTextClass = $variant === 'minimal' ? 'text-slate-900/90' : 'text-white/90';
  $mobileButtonClass = $variant === 'minimal'
      ? 'flex h-10 w-10 items-center justify-center rounded-lg text-slate-700 transition-colors hover:bg-slate-100 lg:hidden'
      : 'flex h-10 w-10 items-center justify-center rounded-lg text-white transition-colors hover:bg-white/10 lg:hidden';
  $desktopNavClass = $variant === 'floating' ? 'hidden items-center gap-3 lg:flex' : 'hidden items-center gap-8 lg:flex';
@endphp

<header class="{{ $headerClass }}">
  <div class="{{ $wrapperClass }}">
    <div class="flex h-[72px] items-center justify-between">
      <a href="{{ route('home') }}" class="flex flex-shrink-0 items-center gap-3 px-3 py-2">
        <img src="{{ asset('images/upturnlogo.png') }}" alt="Upturn Logo" class="h-9 w-9 object-contain"/>
        <span class="text-lg font-bold tracking-tight">
          <span class="text-[#D4AF37]">Upturn</span>
          <span class="{{ $brandTextClass }}"> Business Solutions</span>
        </span>
      </a>

      <nav class="{{ $desktopNavClass }}">
        @foreach ($links as $link)
          @php
            $isActive = request()->routeIs($link['route']);
            $linkClasses = match ($variant) {
                'floating' => $isActive
                    ? 'rounded-full bg-white/10 px-4 py-2 text-sm font-bold text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.14)]'
                    : 'rounded-full px-4 py-2 text-sm font-medium text-white/80 transition-all hover:bg-white/10 hover:text-white',
                'minimal' => $isActive
                    ? 'border-b-2 border-[#D4AF37] pb-0.5 text-sm font-bold text-slate-900'
                    : 'text-sm font-medium text-slate-600 transition-colors hover:text-slate-900',
                default => $isActive
                    ? 'border-b-2 border-[#D4AF37] pb-0.5 text-sm font-bold text-white'
                    : 'text-sm font-medium text-white/80 transition-colors hover:text-white',
            };
          @endphp
          <a
            href="{{ route($link['route']) }}"
            class="{{ $linkClasses }}"
          >
            {{ $link['label'] }}
          </a>
        @endforeach
      </nav>

      @if ($showContact)
        <div class="hidden items-center gap-3 lg:flex">
          <a
            href="{{ $ctaHref }}"
            class="{{ $variant === 'minimal'
                ? 'rounded-lg bg-[#1152d4] px-5 py-2.5 text-sm font-bold text-white shadow-sm transition-all hover:bg-[#1152d4]/90'
                : 'rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-[#1152d4] shadow-sm transition-all hover:bg-slate-100' }}"
          >
            {{ $ctaLabel }}
          </a>
        </div>
      @endif

      <button
        id="hamburger-btn"
        aria-label="Open menu"
        aria-expanded="false"
        class="{{ $mobileButtonClass }}"
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
    @foreach ($links as $link)
      <a
        href="{{ route($link['route']) }}"
        class="flex items-center gap-3 border-b border-slate-100 px-6 py-4 text-sm font-semibold transition-all duration-150 {{ request()->routeIs($link['route']) ? 'border-l-4 border-l-[#1152d4] bg-blue-50 pl-5 text-[#1152d4]' : 'text-slate-700 hover:bg-slate-50 hover:text-[#1152d4]' }}"
      >
        {{ $link['label'] }}
      </a>
    @endforeach
  </nav>

  @if ($showContact)
    <div class="border-t border-slate-100 p-5">
      <a href="{{ $ctaHref }}" class="flex h-11 w-full items-center justify-center rounded-lg bg-[#1152d4] text-sm font-bold text-white shadow-sm transition-all hover:bg-[#1152d4]/90">
        {{ $ctaLabel }}
      </a>
    </div>
  @endif
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
