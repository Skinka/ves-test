<?php


namespace App\Actions;


use App\Models\Operation;
use App\Tasks\GetCoinByIdTask;
use App\Tasks\GetOrCreateOperationTask;
use App\Tasks\InsertCoinTask;
use Illuminate\Support\Facades\DB;

/**
 * Class InsertCoinAction
 * @package App\Actions
 */
class InsertCoinAction extends BaseAction
{
    /**
     * Добавляет монету в операцию
     *
     * @param  int  $coin_id
     *
     * @return Operation
     * @throws \Exception
     */
    public function run(int $coin_id): Operation
    {
        DB::beginTransaction();
        try {
            $operation = app(GetOrCreateOperationTask::class)->run();
            $coin = app(GetCoinByIdTask::class)->run($coin_id);
            $operation = app(InsertCoinTask::class)->run($operation, $coin);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $operation;
    }
}
