<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'admin',
            'password' => bcrypt(config('project.admin_user_password')),
        ]);
    }
}
