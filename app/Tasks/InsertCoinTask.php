<?php


namespace App\Tasks;


use App\Models\Coin;
use App\Models\Operation;
use App\Repositories\OperationRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Добавляет монету в автомат
 *
 * Class InsertCoinTask
 * @package App\Tasks
 */
class InsertCoinTask extends Task
{
    private OperationRepository $operationRepo;

    public function __construct(OperationRepository $operationRepo)
    {
        $this->operationRepo = $operationRepo;
    }

    /**
     * @param  Operation  $operation
     * @param  Coin       $coin
     *
     * @return Operation
     */
    public function run(Operation $operation, Coin $coin): Operation
    {
        DB::beginTransaction();
        if (!$this->operationRepo->insertCoin($operation, $coin)) {
            DB::rollBack();
            throw new BadRequestHttpException('Ошибка приема монеты');
        }
        DB::commit();
        return $operation;
    }
}
