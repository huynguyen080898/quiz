<?php

use App\Models\User;
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
        $this->call(CreateAdminSeeder::class);
    }

}

class CreateAdminSeeder extends Seeder
{
    public function run()
    {
        $admin = [  'email' => 'admin@gmail.com',
                'name' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('admin@123'),  
            ];
        User::create($admin);
    }
    
}