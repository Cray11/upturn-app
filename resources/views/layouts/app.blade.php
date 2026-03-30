<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Upturn Business Solutions')</title>
  <link rel="icon" type="image/png" href="{{ asset('images/upturnlogo.png') }}"/>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
  @stack('head')
</head>
@php
  $navVariant = trim($__env->yieldContent('nav_variant', 'default')) ?: 'default';
  $navShowContact = ! in_array(strtolower(trim($__env->yieldContent('nav_show_contact', 'true'))), ['0', 'false', 'no', 'off'], true);
  $navCtaLabel = trim($__env->yieldContent('nav_cta_label', 'Contact Us')) ?: 'Contact Us';
  $navCtaTarget = trim($__env->yieldContent('nav_cta_target', 'contact')) ?: 'contact';
  $companyTagline = data_get($companyProfile ?? [], 'tagline', "Providing reliable financial, administrative, and compliance services to help Philippine enterprises thrive in today's competitive landscape.");

  $footerVariant = trim($__env->yieldContent('footer_variant', 'default')) ?: 'default';
  $footerCompact = in_array(strtolower(trim($__env->yieldContent('footer_compact', 'false'))), ['1', 'true', 'yes', 'on'], true);
  $footerShowSocials = ! in_array(strtolower(trim($__env->yieldContent('footer_show_socials', 'true'))), ['0', 'false', 'no', 'off'], true);
  $footerShowQuickLinks = ! in_array(strtolower(trim($__env->yieldContent('footer_show_quick_links', 'true'))), ['0', 'false', 'no', 'off'], true);
  $footerShowContact = ! in_array(strtolower(trim($__env->yieldContent('footer_show_contact', 'true'))), ['0', 'false', 'no', 'off'], true);
  $footerTagline = trim($__env->yieldContent('footer_tagline', $companyTagline))
      ?: $companyTagline;
@endphp
<body class="overflow-x-hidden bg-[#f6f6f8] text-slate-900">
  @include('components.nav', [
    'variant' => $navVariant,
    'showContact' => $navShowContact,
    'ctaLabel' => $navCtaLabel,
    'ctaTarget' => $navCtaTarget,
  ])

  @if (session('success'))
    <div class="fixed left-1/2 top-24 z-[60] w-[calc(100%-2rem)] max-w-xl -translate-x-1/2 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-900 shadow-lg">
      {{ session('success') }}
    </div>
  @endif

  <main>
    @yield('content')
  </main>

  @include('components.footer', [
    'variant' => $footerVariant,
    'compact' => $footerCompact,
    'showSocials' => $footerShowSocials,
    'showQuickLinks' => $footerShowQuickLinks,
    'showContact' => $footerShowContact,
    'tagline' => $footerTagline,
  ])
  @stack('scripts')
</body>
</html>
