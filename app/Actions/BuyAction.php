<?php


namespace App\Actions;


use App\DTO\ProductBoughtDTO;
use App\Tasks\GetOrCreateOperationTask;
use App\Tasks\GetProductByIdTask;
use App\Tasks\SellProductTask;
use Illuminate\Support\Facades\DB;

/**
 * Class BuyAction
 * @package App\Actions
 */
class BuyAction extends BaseAction
{
    /**
     * Продает товар
     *
     * @param  int  $product_id
     *
     * @return ProductBoughtDTO
     * @throws \Exception
     */
    public function run(int $product_id): ProductBoughtDTO
    {
        DB::beginTransaction();
        try {
            $operation = app(GetOrCreateOperationTask::class)->run();
            $product = app(GetProductByIdTask::class)->run($product_id);
            $operation = app(SellProductTask::class)->run($operation, $product);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return new ProductBoughtDTO(['product' => $product, 'operation' => $operation]);
    }
}
