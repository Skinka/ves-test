<?php


namespace App\Tasks;


use App\Models\Banknote;
use App\Models\Operation;

/**
 * Добавляет банкноту в автомат
 *
 * Class InsertBanknoteTask
 * @package App\Tasks
 */
class InsertBanknoteTask extends Task
{
    /**
     * @param  Operation  $operation
     * @param  Banknote   $banknote
     *
     * @return Operation
     */
    public function run(Operation $operation, Banknote $banknote): Operation
    {
        $banknote->amount++;
        $banknote->save();
        $operation->filled += $banknote->denomination;
        $operation->save();
        return $operation;
    }
}
