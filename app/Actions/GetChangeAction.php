<?php


namespace App\Actions;


use App\Models\Operation;
use App\Tasks\GetChangeTask;
use App\Tasks\GetOrCreateOperationTask;
use Illuminate\Support\Facades\DB;

/**
 * Class GetChangeAction
 * @package App\Actions
 */
class GetChangeAction extends BaseAction
{
    /**
     * Выдает сдачу
     *
     * @return Operation
     * @throws \Exception
     */
    public function run(): Operation
    {
        DB::beginTransaction();
        try {
            $operation = app(GetOrCreateOperationTask::class)->run();
            $operation = app(GetChangeTask::class)->run($operation);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        request()->session()->regenerate(true);
        return $operation;
    }
}
