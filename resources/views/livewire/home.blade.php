<div>
    <!-- HEADER -->
    <x-mary-header title="{{ __('ticket-system.home.greeting', ['name' => Auth::user()->username ]) }}" separator progress-indicator>

    </x-mary-header>

    <!-- TABLE  -->
    <livewire:my-tickets-table />
</div>
