<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Добавляет товар из задания
 *
 * Class ProductSeeder
 * @package Database\Seeders
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Товар 1', 'price' => 10, 'amount' => 10],
            ['name' => 'Товар 2', 'price' => 20, 'amount' => 5],
            ['name' => 'Товар 3', 'price' => 30, 'amount' => 3],
            ['name' => 'Товар 4', 'price' => 40, 'amount' => 20],
            ['name' => 'Товар 5', 'price' => 50, 'amount' => 15],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
