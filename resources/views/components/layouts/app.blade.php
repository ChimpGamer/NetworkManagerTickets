<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ config('app.theme') }}"
      class="{{ config('app.theme') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

<x-mary-nav sticky>
    <x-slot:brand>
        {{-- Brand --}}
        <img alt="logo" src="/images/full_logo.png" class="h-12" />
    </x-slot:brand>

    {{-- Right side actions --}}
    <x-slot:actions class="!gap-0">
        <x-mary-button label="{{ __('ticket-system.navbar.my-tickets') }}" icon="o-inbox" link="/" class="btn-ghost btn-sm" responsive/>
        <x-mary-button label="{{ __('ticket-system.navbar.create-ticket') }}" icon="o-envelope" link="{{ route('ticket.create') }}" class="btn-ghost btn-sm" responsive/>
        <x-mary-theme-toggle class="btn btn-circle btn-ghost"/>
        <x-mary-button label="{{ __('ticket-system.navbar.logout') }}" icon="o-arrow-right-start-on-rectangle" link="/logout" class="btn-ghost btn-sm" responsive/>
    </x-slot:actions>
</x-mary-nav>

{{-- MAIN --}}
<x-mary-main with-nav>
    {{-- The `$slot` goes here --}}
    <x-slot:content>
        {{ $slot }}
    </x-slot:content>

    <x-slot:footer>
        <div class="py-16 text-center text-sm text-black dark:text-white/70">
            Copyright © ChimpGamer {{ now()->year }}
        </div>
    </x-slot:footer>
</x-mary-main>

{{--  TOAST area --}}
<x-mary-toast/>
</body>
</html>
