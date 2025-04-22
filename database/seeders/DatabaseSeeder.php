<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            CurrencySeeder::class,
        ]);

        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johnny@mail.com',
        ]);

        User::factory()->create([
            'name' => 'John Smith ',
            'email' => 'smith@example.com',
        ]);
    }
}
