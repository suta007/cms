<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'admin ef',
            'username' => '0x46',
            'email' => 'Mr.Suta@gmail.com',
            'password' => Hash::make('Admin@1234'),
            'type' => 'admin',
        ]);

        Setting::create([
            'name' => 'index',
            'value' => 'post'
        ]);
    }
}
