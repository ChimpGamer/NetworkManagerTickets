<div>
    <x-mary-header title="{{ __('login.header.title') }}" separator progress-indicator>
    </x-mary-header>
    <x-mary-tabs selected="login-tab">
        <x-mary-tab name="login-tab" label="{{ __('login.tab.login.label') }}">
            <x-mary-form wire:submit="authenticate">
                <x-mary-input label="{{ __('login.input.username.label') }}" icon="o-envelope" wire:model="username" placeholder="{{ __('login.input.username.placeholder') }}" />
                <x-mary-password label="{{ __('login.input.password.label') }}" icon="o-key" wire:model="password" placeholder="{{ __('login.input.password.placeholder') }}" right clearable />

                <x-slot:actions>
                    <x-mary-button label="{{ __('login.button.login') }}" class="btn-success" type="submit" spinner="save" />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-tab>
        <x-mary-tab name="register-tab" label="{{ __('login.tab.register.label') }}">
            {!! __('login.tab.register.text') !!}
        </x-mary-tab>
    </x-mary-tabs>
</div>
