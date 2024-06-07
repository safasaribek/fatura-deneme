<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'admin',
            'email' => 'safa@safa',
            'password' => Hash::make(12345678)
        ]);

        Item::create([
            'name' => 'saat',
            'unit' => 'adet',
            'quantity' => '10',
            'price' => '1500',
        ]);
        Item::create([
            'name' => 'gömlek',
            'unit' => 'adet',
            'quantity' => '25',
            'price' => '730',
        ]);
    }
}
