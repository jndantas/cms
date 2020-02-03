<?php

use App\Model\Profile;
use App\Model\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);

        Profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/profile/garoto.png',
            'about' => 'qualquer coisa'
        ]);
    }
}
