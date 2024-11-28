<div>
    <!-- HEADER -->
    <x-mary-header title="Hello {{ Auth::user()->username }}" separator progress-indicator>

    </x-mary-header>

    <!-- TABLE  -->
    <livewire:my-tickets-table />
</div>
