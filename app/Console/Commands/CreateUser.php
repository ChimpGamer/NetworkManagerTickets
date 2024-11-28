<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nm:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create a new user for the ticket web interface.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('You need to use your mc username as username!');
        $username = $this->ask('What is the username?');
        $password = $this->secret('What is the password?');

        $uuid = Player::getUUID($username);
        if ($uuid === null) {
            $this->error('Could not find uuid for this username in database!');
            return;
        }

        User::create([
            'uuid' => $uuid,
            'username' => $username,
            'password' => $password,
            'created_at' => now(),
        ]);

        $this->info("User $username was created");
    }
}
