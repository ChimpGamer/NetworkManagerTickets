<?php

namespace App\Livewire;

use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketMessage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class ViewTicket extends Component
{
    use Toast;

    public Ticket $ticket;

    #[Validate('required', message: 'The message is required')]
    public string $description;

    public function submit(): void
    {
        $this->validate();

        $ticketId = $this->ticket->id;
        $uuid = auth()->user()->uuid;
        $message = $this->description;
        $time = now()->getTimestampMs();

        $username = auth()->user()->username;

        TicketMessage::create([
            'ticket_id' => $ticketId,
            'uuid' => $uuid,
            'message' => $message,
            'time' => $time,
        ]);

        $this->ticket->update([
            'last_answer' => $username,
            'last_update' => $time,
        ]);

        $this->success('Successfully replied to ticket!');
        $this->ticket->refresh();
    }

    public function render(): View|Factory|Application
    {
        abort_if($this->ticket->creator != auth()->user()->uuid, 404);
        $listItemData = [
            'name' => $this->ticket->getCreatorName(),
            'avatar' => 'https://minotar.net/helm/' . $this->ticket->creator,
        ];

        return view('livewire.view-ticket')->with('listItemData', $listItemData);
    }
}
