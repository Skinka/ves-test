<?php


namespace App\Tasks;


use App\Models\Banknote;
use App\Models\Operation;
use App\Repositories\OperationRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Принимает банкноту в автомат
 *
 * Class InsertBanknoteTask
 * @package App\Tasks
 */
class InsertBanknoteTask extends Task
{
    private OperationRepository $operationRepo;

    public function __construct(OperationRepository $operationRepo)
    {
        $this->operationRepo = $operationRepo;
    }

    /**
     * @param  Operation  $operation
     * @param  Banknote   $banknote
     *
     * @return Operation
     */
    public function run(Operation $operation, Banknote $banknote): Operation
    {
        DB::beginTransaction();
        if (!$this->operationRepo->insertBanknote($operation, $banknote)) {
            DB::rollBack();
            throw new BadRequestHttpException('Ошибка приема банкноты');
        }
        DB::commit();
        return $operation;
    }
}
