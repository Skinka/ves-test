<?php


namespace App\Actions;


use App\Tasks\GetBanknoteByIdTask;
use App\Tasks\GetOrCreateOperationTask;
use App\Tasks\InsertBanknoteTask;
use Illuminate\Support\Facades\DB;

/**
 * Class SetBanknoteAction
 * @package App\Actions
 */
class InsertBanknoteAction extends BaseAction
{
    /**
     * Добавляет банкноту в операцию
     *
     * @param  int  $banknote_id
     *
     * @return array
     */
    public function run(int $banknote_id)
    {
        DB::beginTransaction();
        try {
            $operation = app(GetOrCreateOperationTask::class)->run();
            $banknote = app(GetBanknoteByIdTask::class)->run($banknote_id);
            $operation = app(InsertBanknoteTask::class)->run($operation, $banknote);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $operation;
    }
}
