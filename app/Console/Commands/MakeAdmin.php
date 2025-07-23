<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Import your User model
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    protected $signature = 'make:admin'; // This is the command you’ll run

    protected $description = 'Create a new admin user';

    public function handle()
    {
        $name = $this->ask('Enter name');
        $email = $this->ask('Enter email');
        $password = $this->ask('Enter password');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true, // Or use 'role' => 'admin' if using roles
        ]);

        $this->info("✅ Admin user '{$user->email}' created successfully!");
    }
}
