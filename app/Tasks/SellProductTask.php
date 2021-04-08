<?php


namespace App\Tasks;


use App\Models\Operation;
use App\Models\Product;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Выдает продукт из автомата
 *
 * Class SellProductTask
 * @package App\Tasks
 */
class SellProductTask extends Task
{
    /**
     * @param  Operation  $operation
     * @param  Product    $product
     *
     * @return Operation
     * @throws BadRequestHttpException
     */
    public function run(Operation $operation, Product $product): Operation
    {
        if ($product->amount < 1) {
            throw new BadRequestHttpException('Продукт закончился');
        }
        if ($operation->filled < $product->price) {
            throw new BadRequestHttpException('Не достаточно денег на счету');
        }
        $product->amount--;
        $product->save();
        $operation->filled -= $product->price;
        $operation->spent += $product->price;
        $operation->save();
        $operation->products()->create([
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
        ]);
        return $operation;
    }
}
