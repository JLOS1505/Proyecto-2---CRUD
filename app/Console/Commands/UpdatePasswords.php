<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdatePasswords extends Command
{
    protected $signature = 'passwords:update';

    protected $description = 'Update all passwords to use Bcrypt algorithm';

    public function handle()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $newPassword = Hash::make($user->password);
            DB::table('users')->where('id', $user->id)->update(['password' => $newPassword]);
        }

        $this->info('Passwords updated successfully.');
    }
}

