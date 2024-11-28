@php
    $config = [
        'license_key' => 'gpl',
        /*'skin' => 'oxide-dark',
        'content_css' => 'dark',*/
        'plugins' => 'image media link lists searchreplace wordcount autosave'
    ];
@endphp

<div>
    <x-mary-header title="{{ $ticket->title }}" separator>
        <x-slot:middle class="!justify-end text-4xl font-extrabold">
            #{{ $ticket->id }}
        </x-slot:middle>
    </x-mary-header>

    @if($ticket->active)
        <x-mary-form wire:submit="submit">
            <x-mary-editor wire:model="description" label="Description *" :config="$config" error-field="description" />

            <x-slot:actions>
                <x-mary-button label="Submit" class="btn-primary" type="submit" spinner="submit"></x-mary-button>
            </x-slot:actions>
        </x-mary-form>
    @endif
    <br />

    @foreach($ticket->ticketMessages->sortByDesc('id') as $ticketMessage)
        <x-mary-card separator>
            <x-mary-list-item :item="$ticketMessage" no-separator>
                <x-slot:avatar>
                    <div class="py-3">
                        <div class="avatar">
                            <div class="w-11 rounded-full">
                                <img src="https://minotar.net/helm/{{ $ticketMessage->uuid }}" />
                            </div>
                        </div>
                    </div>
                </x-slot:avatar>
                <x-slot:value>
                    {{ $ticketMessage->getSenderName() }}
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $ticketMessage->getTimeFormatted() }}
                </x-slot:sub-value>
            </x-mary-list-item>
            <div class="flex justify-start items-center gap-4 px-3">
                <div class="flex-1 overflow-hidden whitespace-nowrap truncate w-0">
                    <div class="py-3">
                        {!! $ticketMessage->message !!}
                    </div>
                </div>
            </div>
        </x-mary-card>
        <br />
    @endforeach

    <x-mary-card>
        <x-mary-list-item :item="$listItemData" no-separator>
            <x-slot:sub-value>
                {{ $ticket->getCreationFormatted() }}
            </x-slot:sub-value>
        </x-mary-list-item>
        <div class="flex justify-start items-center gap-4 px-3">
            <div class="flex-1 overflow-hidden whitespace-nowrap truncate w-0">
                <div class="py-3">
                    {!! $ticket->message !!}
                </div>
            </div>
        </div>
    </x-mary-card>
</div>
