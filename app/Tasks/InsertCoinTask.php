<?php


namespace App\Tasks;


use App\Models\Coin;
use App\Models\Operation;

/**
 * Добавляет монету в автомат
 *
 * Class InsertCoinTask
 * @package App\Tasks
 */
class InsertCoinTask extends Task
{
    /**
     * @param  Operation  $operation
     * @param  Coin       $coin
     *
     * @return Operation
     */
    public function run(Operation $operation, Coin $coin): Operation
    {
        $coin->amount++;
        $coin->save();
        $operation->filled += $coin->denomination;
        $operation->save();
        return $operation;
    }
}
