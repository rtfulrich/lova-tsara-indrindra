<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'rtfulrich@gmail.com';
        $user->username = 'tahirintsoa_ulrich';
        $user->first_name = 'Tahirinstsoa';
        $user->last_name = 'Ulrich';
        $user->password = Hash::make('qdndulti@10');
        $user->email_verified_at = now();
        $user->role = 'superadmin';
        $user->save();
    }
}
