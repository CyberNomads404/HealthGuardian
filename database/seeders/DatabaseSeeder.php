<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Profile;
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
        Profile::create([
            "name" => "admin"
        ]);

        Profile::create([
            "name" => "doctor"
        ]);

        Profile::create([
            "name" => "person"
        ]);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        $admin->assignProfile('admin');

        $doctor = User::factory()->create([
            'name' => 'doctor',
            'email' => 'doctor@gmail.com',
            'password' => bcrypt('doctor'),
        ]);
        $doctor->assignProfile('doctor');

        $person = User::factory()->create([
            'name' => 'person',
            'email' => 'person@gmail.com',
            'password' => bcrypt('person'),
        ]);
        $person->assignProfile('person');

        Register::factory(10)
            ->withRandomPolymorphic()
            ->for($admin)
            ->create();

        User::factory(5)->create()->each(function($user) {
            $user->assignProfile('doctor');
        });

        User::factory(10)->create()->each(function ($user) {
            $user->assignProfile('person');
            Register::factory(50)
            ->withRandomPolymorphic()
            ->for($user)
            ->create();
        });
    }
}
