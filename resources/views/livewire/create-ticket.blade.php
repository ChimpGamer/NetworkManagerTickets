@php
    $config = [
        'license_key' => 'gpl',
        /*'skin' => 'oxide-dark',
        'content_css' => 'dark',*/
        'plugins' => 'image media link lists searchreplace wordcount autosave'
    ];
@endphp

<div>
    <x-mary-form wire:submit="submit">
        <x-mary-input wire:model="subject" label="{{ __('ticket-system.input.subject.label') }}" placeholder="{{ __('ticket-system.input.description.label') }}" error-field="subject" autofocus />

        <x-mary-editor wire:model="description" label="{{ __('ticket-system.input.description.label') }}" :config="$config" error-field="description" />

        <x-slot:actions>
            <x-mary-button label="{{ __('ticket-system.button.submit') }}" class="btn-primary" type="submit" spinner="submit"></x-mary-button>
        </x-slot:actions>
    </x-mary-form>
</div>
