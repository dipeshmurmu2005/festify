<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class NewAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:new-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('What is your name ? ', 'Admin');
        $email = $this->ask('What is your email ?', 'admin@example.com');
        $password = $this->secret('New Password', 'password');

        try {
            DB::transaction(function () use ($name, $email, $password) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ]);

                $user->roles()->create([
                    'role' => UserRole::Admin
                ]);
            });
            DB::commit();
            $this->info('Admin Created Successfully!');
        } catch (\Throwable $th) {
            $this->info('Cannot Create Admin');
        }
    }
}
