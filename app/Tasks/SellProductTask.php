<?php


namespace App\Tasks;


use App\Models\Operation;
use App\Models\Product;
use App\Repositories\OperationRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Выдает продукт из автомата
 *
 * Class SellProductTask
 * @package App\Tasks
 */
class SellProductTask extends Task
{
    private OperationRepository $operationRepo;

    public function __construct(OperationRepository $operationRepo)
    {
        $this->operationRepo = $operationRepo;
    }

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
        if (!$this->operationRepo->sellProduct($operation, $product)) {
            throw new BadRequestHttpException('Ошибка продажи');
        }
        $operation->refresh();

        return $operation;
    }
}
