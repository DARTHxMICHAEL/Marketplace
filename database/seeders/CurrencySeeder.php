<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['code' => 'USD', 'name' => 'Dollar'],
            ['code' => 'EUR', 'name' => 'Euro'],
            ['code' => 'GBP', 'name' => 'Pound'],
            ['code' => 'PLN', 'name' => 'Zloty'],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
