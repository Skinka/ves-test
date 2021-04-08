<?php


namespace App\Http\Controllers;


use App\Actions\BuyAction;
use App\Actions\GetChangeAction;
use App\Actions\GetVendingMachineAction;
use App\DTO\VendingMachineDTO;
use App\Http\Resources\OperationResource;
use App\Http\Resources\ProductBoughtResource;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер по управлению автоматом
 *
 * Class VendingMachineController
 * @package App\Http\Controllers
 */
class VendingMachineController extends Controller
{
    /**
     * Выводит торговый автомат на экран
     *
     * @param  GetVendingMachineAction  $action
     *
     * @return View
     */
    public function show(GetVendingMachineAction $action): View
    {
        $data = $action->run(new VendingMachineDTO(['showEmptyProducts' => true]));
        return view('vending-machine.show', $data);
    }

    /**
     * Продает товар
     *
     * @param  int        $product_id
     * @param  BuyAction  $action
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function buy(int $product_id, BuyAction $action): JsonResponse
    {
        $bought = $action->run($product_id);
        return response()->json(new ProductBoughtResource($bought));
    }

    /**
     * Выдает сдачу и начинает новую операцию
     *
     * @param  GetChangeAction  $action
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function getChange(GetChangeAction $action): JsonResponse
    {
        $data = $action->run();
        return response()->json(new OperationResource($data));
    }
}
