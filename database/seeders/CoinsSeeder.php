<?php

namespace Database\Seeders;

use App\Models\Coin;
use Illuminate\Database\Seeder;

/**
 * Добавляет монеты которые принимает аппарат
 *
 * Class CoinsSeeder
 * @package Database\Seeders
 */
class CoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['denomination' => 1, 'amount' => 300],
            ['denomination' => 0.5, 'amount' => 300],
        ];

        foreach ($products as $product) {
            Coin::create($product);
        }
    }
}
