<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 1,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 1,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Create 2 users for role 2
        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 2,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 2,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Create 2 users for role 3
        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 3,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 3,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Create 2 users for role 4
        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 4,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 4,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Create 2 users for role 5
        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 5,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 5,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Create 2 users for role 6
        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 6,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role_id' => 6,
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $this->call(JobOrderSeeder::class);
        $this->call(JobDraftSeeder::class);
    }
}
