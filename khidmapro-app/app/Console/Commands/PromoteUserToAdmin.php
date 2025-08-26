<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PromoteUserToAdmin extends Command
{
    protected $signature = 'user:promote-admin {email}';
    protected $description = 'Promote a user to admin role';

    public function handle(): int
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();
        if (!$user) { $this->error('User not found'); return self::FAILURE; }
        $user->role = 'admin';
        $user->save();
        $this->info('Promoted to admin');
        return self::SUCCESS;
    }
}
