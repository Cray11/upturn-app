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
<body class="overflow-x-hidden bg-[#f6f6f8] text-slate-900">
  @include('components.nav')

  @if (session('success'))
    <div class="fixed left-1/2 top-24 z-[60] w-[calc(100%-2rem)] max-w-xl -translate-x-1/2 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-900 shadow-lg">
      {{ session('success') }}
    </div>
  @endif

  <main>
    @yield('content')
  </main>

  @include('components.footer')
  @stack('scripts')
</body>
</html>
