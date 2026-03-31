@php
  $variant = $variant ?? 'default';
  $compact = $compact ?? false;
  $showSocials = $showSocials ?? true;
  $showQuickLinks = $showQuickLinks ?? true;
  $showContact = $showContact ?? true;
  $tagline = $tagline ?? 'COMPLY. SECURE. GROW.';
  $companyProfile = $companyProfile ?? config('upturn.company', []);
  $companyName = data_get($companyProfile, 'name', 'Upturn Business Solutions');
  $contactProfile = data_get($companyProfile, 'contact', []);
  $socialLinks = data_get($companyProfile, 'socials', []);
  $contactAddress = data_get($contactProfile, 'address', 'Unit 201-202, C&B Circle Mall, Maysan Road, Malinta, Valenzuela City');
  $contactPhone = data_get($contactProfile, 'phone', '+63 921 551 4785');
  $contactPhones = data_get($contactProfile, 'phones', ['Phone' => $contactPhone]);
  $contactEmail = data_get($contactProfile, 'email', 'sales@upturnpartnership.com');
  $contactEmails = data_get($contactProfile, 'emails', ['Email' => $contactEmail]);
  $officeHoursSummary = data_get($contactProfile, 'office_hours.summary', 'Mon-Fri 8AM-5PM');
  $footerLinks = $links ?? [
    ['label' => 'Home', 'route' => 'home'],
    ['label' => 'Services', 'route' => 'services'],
    ['label' => 'About Us', 'route' => 'about'],
    ['label' => 'Engagements', 'route' => 'engagements'],
    ['label' => 'Careers', 'route' => 'careers'],
    ['label' => 'Contact', 'route' => 'contact'],
  ];
  $isMinimal = $variant === 'minimal';
  $containerClass = $isMinimal ? 'mt-auto border-t border-slate-800 bg-slate-900 py-10 text-slate-400' : 'mt-auto border-t border-slate-800 bg-slate-900 pb-8 pt-16 text-slate-400';
  $topGridClass = $compact || $isMinimal
      ? 'mb-10 grid grid-cols-1 gap-10 lg:grid-cols-[1.5fr_1fr_1fr]'
      : 'mb-12 grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-4';
@endphp

<footer class="{{ $containerClass }}">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="{{ $topGridClass }}">
      <div class="flex flex-col gap-5 {{ $compact || $isMinimal ? '' : 'lg:col-span-2' }}">
        <div class="flex items-center gap-3">
          <img src="{{ asset('images/upturnlogo.png') }}" alt="Upturn Logo" class="h-10 w-10 object-contain"/>
          <span class="text-lg font-bold text-white">{{ $companyName }}</span>
        </div>
        <p class="max-w-sm text-sm leading-relaxed">
          {{ $tagline }}
        </p>
        @if ($showSocials)
          <div class="flex gap-3">
            <a href="{{ $socialLinks['tiktok'] ?? '#' }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white/80 transition-colors hover:bg-[#1152d4] hover:text-white">
              <svg viewBox="0 0 16 16" aria-hidden="true" class="h-4 w-4 fill-current"><path d="M9.5 1a.5.5 0 0 1 .5.5v1.92a2.5 2.5 0 0 0 1.7 2.37l1.13.38a.5.5 0 0 1 .34.47v1.16a.5.5 0 0 1-.63.48 5.64 5.64 0 0 1-2.54-1.28v3.73a3.5 3.5 0 1 1-3.5-3.5.5.5 0 0 1 .5.5v1.28a.5.5 0 0 1-.5.5A1.72 1.72 0 1 0 8.22 12V1.5a.5.5 0 0 1 .5-.5h.78Z"/></svg>
            </a>
            <a href="{{ $socialLinks['linkedin'] ?? '#' }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white/80 transition-colors hover:bg-[#1152d4] hover:text-white">
              <svg viewBox="0 0 16 16" aria-hidden="true" class="h-4 w-4 fill-current"><path d="M0 1.15C0 .52.52 0 1.15 0h13.7C15.48 0 16 .52 16 1.15v13.7c0 .63-.52 1.15-1.15 1.15H1.15C.52 16 0 15.48 0 14.85V1.15ZM4.94 13.2V6.17H2.6v7.03h2.34ZM3.77 5.2c.82 0 1.34-.54 1.34-1.22-.02-.7-.52-1.22-1.32-1.22S2.46 3.28 2.46 3.98c0 .68.5 1.22 1.3 1.22Zm9.43 8V9.17c0-2.16-1.15-3.16-2.69-3.16-1.24 0-1.79.68-2.1 1.16v.02h-.02l.02-.02V6.17H6.07c.03.67 0 7.03 0 7.03h2.34V9.28c0-.21.02-.43.08-.58.17-.42.56-.86 1.2-.86.85 0 1.2.65 1.2 1.6v3.76h2.31Z"/></svg>
            </a>
            <a href="{{ $socialLinks['instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white/80 transition-colors hover:bg-[#1152d4] hover:text-white">
              <svg viewBox="0 0 16 16" aria-hidden="true" class="h-4 w-4 fill-current"><path d="M8 0C5.83 0 5.56.01 4.7.05 3.85.09 3.27.22 2.76.42a4.8 4.8 0 0 0-1.73 1.13A4.8 4.8 0 0 0 .42 2.76C.22 3.27.09 3.85.05 4.7 0 5.56 0 5.83 0 8c0 2.17.01 2.44.05 3.3.04.85.17 1.43.37 1.94.24.63.6 1.17 1.13 1.73.56.53 1.1.89 1.73 1.13.51.2 1.09.33 1.94.37.86.04 1.13.05 3.3.05 2.17 0 2.44-.01 3.3-.05.85-.04 1.43-.17 1.94-.37a4.8 4.8 0 0 0 1.73-1.13 4.8 4.8 0 0 0 1.13-1.73c.2-.51.33-1.09.37-1.94.04-.86.05-1.13.05-3.3 0-2.17-.01-2.44-.05-3.3-.04-.85-.17-1.43-.37-1.94a4.8 4.8 0 0 0-1.13-1.73A4.8 4.8 0 0 0 13.24.42C12.73.22 12.15.09 11.3.05 10.44.01 10.17 0 8 0Zm0 1.44c2.13 0 2.38.01 3.24.05.79.04 1.22.17 1.5.28.37.15.64.32.92.61.29.28.46.55.61.92.11.28.24.71.28 1.5.04.86.05 1.11.05 3.24s-.01 2.38-.05 3.24c-.04.79-.17 1.22-.28 1.5-.15.37-.32.64-.61.92-.28.29-.55.46-.92.61-.28.11-.71.24-1.5.28-.86.04-1.11.05-3.24.05s-2.38-.01-3.24-.05c-.79-.04-1.22-.17-1.5-.28a3.36 3.36 0 0 1-.92-.61 3.36 3.36 0 0 1-.61-.92c-.11-.28-.24-.71-.28-1.5A55.3 55.3 0 0 1 1.44 8c0-2.13.01-2.38.05-3.24.04-.79.17-1.22.28-1.5.15-.37.32-.64.61-.92.28-.29.55-.46.92-.61.28-.11.71-.24 1.5-.28.86-.04 1.11-.05 3.24-.05Zm0 2.45A4.11 4.11 0 1 0 8 12.1 4.11 4.11 0 0 0 8 3.89Zm0 6.78A2.67 2.67 0 1 1 8 5.33a2.67 2.67 0 0 1 0 5.34Zm5.23-7.15a.96.96 0 1 1-1.92 0 .96.96 0 0 1 1.92 0Z"/></svg>
            </a>
            <a href="{{ $socialLinks['facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white/80 transition-colors hover:bg-[#1152d4] hover:text-white">
              <svg viewBox="0 0 16 16" aria-hidden="true" class="h-4 w-4 fill-current"><path d="M16 8.05A8 8 0 1 0 6.75 15.95V10.38H4.72V8.05h2.03V6.27c0-2 1.2-3.1 3.02-3.1.88 0 1.8.16 1.8.16V5.3h-1.01c-1 0-1.31.62-1.31 1.25v1.5h2.23l-.36 2.33H9.25v5.57A8 8 0 0 0 16 8.05Z"/></svg>
            </a>
          </div>
        @endif
      </div>

      @if ($showQuickLinks)
        <div>
          <h4 class="mb-5 text-sm font-bold uppercase tracking-widest text-white">Quick Links</h4>
          <ul class="flex flex-col gap-3 text-sm">
            @foreach ($footerLinks as $link)
              <li>
                <a href="{{ route($link['route']) }}" class="transition-colors hover:text-white">{{ $link['label'] }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      @if ($showContact)
        <div>
          <h4 class="mb-5 text-sm font-bold uppercase tracking-widest text-white">Contact</h4>
          <ul class="flex flex-col gap-4 text-sm">
            <li class="flex items-start gap-3">
              <span class="material-symbols-outlined mt-0.5 text-base text-[#1152d4]">location_on</span>
              <span>{{ $contactAddress }}</span>
            </li>
            <li class="flex items-start gap-3">
              <span class="material-symbols-outlined mt-0.5 text-base text-[#1152d4]">call</span>
              <div class="flex flex-col gap-1">
                @foreach ($contactPhones as $label => $phone)
                  <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="transition-colors hover:text-white">{{ is_string($label) ? $label.': ' : '' }}{{ $phone }}</a>
                @endforeach
              </div>
            </li>
            <li class="flex items-start gap-3">
              <span class="material-symbols-outlined mt-0.5 text-base text-[#1152d4]">mail</span>
              <div class="flex flex-col gap-1">
                @foreach ($contactEmails as $label => $email)
                  <a href="mailto:{{ $email }}" class="transition-colors hover:text-white">{{ is_string($label) ? $label.': ' : '' }}{{ $email }}</a>
                @endforeach
              </div>
            </li>
            <li class="flex items-center gap-3">
              <span class="material-symbols-outlined text-base text-[#1152d4]">schedule</span>
              <span>{{ $officeHoursSummary }}</span>
            </li>
          </ul>
        </div>
      @endif
    </div>

    <div class="flex flex-col items-center justify-between gap-4 border-t border-slate-800 pt-8 text-xs sm:flex-row">
      <p>&copy; {{ date('Y') }} Upturn Business Solutions. All rights reserved.</p>
      <div class="flex gap-6">
        <a href="#" class="transition-colors hover:text-white">Privacy Policy</a>
        <a href="#" class="transition-colors hover:text-white">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>
