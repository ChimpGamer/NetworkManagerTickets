<div>
    <x-mary-header title="TicketSystem" separator progress-indicator>
    </x-mary-header>
    <x-mary-tabs selected="login-tab">
        <x-mary-tab name="login-tab" label="Login">
            <x-mary-form wire:submit="authenticate">
                <x-mary-input label="Username" icon="o-envelope" wire:model="username" placeholder="Username" />
                <x-mary-password label="Password" wore:model="password" icon="o-key" placeholder="Password" right clearable />

                <x-slot:actions>
                    <x-mary-button label="Login" class="btn-success" type="submit" spinner="save" />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-tab>
        <x-mary-tab name="register-tab" label="Register">
            <p>Join the Network and use the command <b>/ticket register [password]</b>. After successfully
                registering yourself you can login on this page and use all features of the ticket system.</p>
        </x-mary-tab>
    </x-mary-tabs>
</div>
