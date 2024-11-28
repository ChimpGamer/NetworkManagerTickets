<?php

namespace App\Livewire;

use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketPriority;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class CreateTicket extends Component
{
    use Toast;

    #[Validate('required', message: 'The subject is required')]
    public string $subject;

    #[Validate('required', message: 'The message is required')]
    public string $description;

    public function submit(): RedirectResponse
    {
        $this->validate();

        $creator = auth()->user()->uuid;
        $subject = $this->subject;
        $description = $this->description;
        $creation = now()->getTimestampMs();
        $priority = TicketPriority::NONE;
        $active = true;

        Ticket::create([
            'creator' => $creator,
            'title' => $subject,
            'message' => $description,
            'creation' => $creation,
            'priority' => $priority,
            'last_update' => $creation,
            'active' => $active,
        ]);

        $this->success('Successfully created ticket!');
        return Redirect::route('home');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.create-ticket');
    }
}
