<?php


namespace App\Http\Controllers;


use App\Actions\InsertBanknoteAction;
use App\Actions\InsertCoinAction;
use App\Http\Resources\OperationResource;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер по управлению монето-приемником
 *
 * Class MoneyReceiverController
 * @package App\Http\Controllers
 */
class MoneyReceiverController extends Controller
{
    /**
     * Добавление купюры в автомат
     *
     * @param  int                   $banknote_id
     * @param  InsertBanknoteAction  $action
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function setBanknote(int $banknote_id, InsertBanknoteAction $action): JsonResponse
    {
        $operation = $action->run($banknote_id);
        return response()->json(new OperationResource($operation));
    }

    /**
     * Добавление монеты в автомат
     *
     * @param  int               $coin_id
     * @param  InsertCoinAction  $action
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function setCoin(int $coin_id, InsertCoinAction $action): JsonResponse
    {
        $operation = $action->run($coin_id);
        return response()->json(new OperationResource($operation));
    }
}
