<?php


namespace App\Repositories;

use App\Models\Banknote;
use App\Models\Coin;
use App\Models\Operation;
use App\Models\Operation as Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class OperationRepository
 * @package App\Repositories
 */
class OperationRepository extends BaseRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Возвращает список продукции
     *
     * @param  string  $sessionId
     *
     * @return Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getBySessionId(string $sessionId)
    {
        return $this->startConditions()
            ->where('operation_id', $sessionId)
            ->firstOrCreate([
                'operation_id' => $sessionId
            ]);
    }

    /**
     * Продает продукт
     * Считается что данные уже провалидированы и все условия удовлетворяют продаже
     *
     * @param  Model    $operation
     * @param  Product  $product
     *
     * @return bool
     */
    public function sellProduct(Operation $operation, Product $product): bool
    {
        $product->amount--;
        if (!$product->save()) {
            return false;
        }

        $operation->filled -= $product->price;
        $operation->spent += $product->price;
        if (!$operation->save()) {
            return false;
        }

        return !!$operation->products()->create([
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
        ]);
    }

    /**
     * Пополняет счет операции банкнотой
     *
     * @param  Model     $operation
     * @param  Banknote  $banknote
     *
     * @return bool
     */
    public function insertBanknote(Operation $operation, Banknote $banknote): bool
    {
        $banknote->amount++;
        if (!$banknote->save()) {
            return false;
        }
        $operation->filled += $banknote->denomination;
        return $operation->save();
    }

    /**
     * Пополняет счет операции монетой
     *
     * @param  Model  $operation
     * @param  Coin   $coin
     *
     * @return bool
     */
    public function insertCoin(Operation $operation, Coin $coin): bool
    {
        $coin->amount++;
        if (!$coin->save()) {
            return false;
        }
        $operation->filled += $coin->denomination;
        return $operation->save();
    }
}
