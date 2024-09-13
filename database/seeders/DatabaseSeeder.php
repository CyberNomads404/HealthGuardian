<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Register;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        Register::factory(10)
            ->withRandomPolymorphic()
            ->for($user)
            ->create();

        User::factory(10)->create()->each(function ($user) {
            Register::factory(50)
            ->withRandomPolymorphic()
            ->for($user)
            ->create();
        });
    }
}
