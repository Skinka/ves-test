<?php


namespace App\Actions;


use App\DTO\VendingMachineDTO;
use App\Repositories\BanknoteRepository;
use App\Repositories\CoinRepository;
use App\Repositories\ProductRepository;

/**
 * Возвращает массив данных о торговом автомате
 *
 * Class GetVendingMachineAction
 * @package App\Actions
 */
class GetVendingMachineAction extends BaseAction
{
    private $productRepo;
    private $banknoteRepo;
    private $coinRepo;


    public function __construct()
    {
        $this->productRepo = app(ProductRepository::class);
        $this->banknoteRepo = app(BanknoteRepository::class);
        $this->coinRepo = app(CoinRepository::class);
    }

    /**
     * @param  VendingMachineDTO  $data
     */
    public function run($data)
    {
        $products = $this->productRepo->getList($data->showEmptyProducts);
        $banknotes = $this->banknoteRepo->getList();
        $coins = $this->coinRepo->getList();

        return ['products' => $products, 'banknotes' => $banknotes, 'coins' => $coins];
    }
}
