<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    use Toast;

    public ?string $username;
    public ?string $password;

    public function authenticate()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            request()->session()->regenerate();
            $this->success('Logged in successfully', position: 'toast-top');
            return Redirect::route('home');
        } else {
            $this->error("Cannot verify the credentials !", position: 'toast-top');
        }
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.auth.login');
    }
}
