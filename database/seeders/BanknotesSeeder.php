<?php

namespace Database\Seeders;

use App\Models\Banknote;
use Illuminate\Database\Seeder;

/**
 * Добавляет Банкноты которые принимает аппарат
 *
 * Class BanknoteSeeder
 * @package Database\Seeders
 */
class BanknotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['denomination' => 1, 'amount' => 0],
            ['denomination' => 2, 'amount' => 0],
            ['denomination' => 5, 'amount' => 0],
            ['denomination' => 10, 'amount' => 0],
            ['denomination' => 20, 'amount' => 0],
        ];

        foreach ($products as $product) {
            Banknote::create($product);
        }
    }
}
