<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Banknote;
use App\Models\Operation;
use App\Models\Product;
use App\Repositories\OperationRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class VendingMachineControllerBuyTest extends TestCase
{
    use DatabaseMigrations;

    private OperationRepository $operationRepo;
    private array               $cookie = [];
    private string              $sessionId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->operationRepo = app(OperationRepository::class);
        $this->sessionId = session()->getId();
        $this->cookie = [session()->getName() => $this->sessionId];
    }

    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        // set session_id cookie
        $cookies = array_merge($cookies, $this->cookie);
        return parent::call($method, $uri, $parameters, $cookies, $files, $server, $content);
    }

    /**
     * Покупка в автомате
     */
    public function testBuy()
    {
        $this->seed();

        /** @var Operation $operation */
        $operation = $this->operationRepo->getBySessionId($this->sessionId);

        /** @var Banknote $banknote */
        $banknote = Banknote::query()->first();

        /** @var Product $product */
        $product = Product::query()->first();

        $insert = 0;
        while ($product->price > $insert) {
            if (!$this->operationRepo->insertBanknote($operation, $banknote)) {
                $this->fail();
            }
            $insert += $banknote->denomination;
        }

        $this->post("/api/vending-machine/buy/{$product->id}")
            ->assertOk()
            ->assertJson([
                'product'   => [
                    'name'   => $product->name,
                    'price'  => $product->price,
                    'amount' => $product->amount - 1
                ],
                'operation' => [
                    'filled' => $insert - $product->price,
                    'spent'  => $product->price,
                    'change' => 0
                ]
            ]);
    }

    /**
     * Не хватило денег автомате
     */
    public function testNotEnoughMany()
    {
        $this->seed();

        /** @var Product $product */
        $product = Product::query()->first();

        $this->post("/api/vending-machine/buy/{$product->id}")
            ->assertStatus(400);
    }

    /**
     * Продукт не найден
     */
    public function testProductNotFound()
    {
        $this->seed();

        $this->post("/api/vending-machine/buy/100500")
            ->assertNotFound();
    }

    /**
     * Продукт закончился
     */
    public function testProductIsEmpty()
    {
        $this->seed();
        /** @var Operation $operation */
        $operation = $this->operationRepo->getBySessionId($this->sessionId);

        /** @var Banknote $banknote */
        $banknote = Banknote::query()->first();

        /** @var Product $product */
        $product = Product::query()->first();
        $product->amount = 0;
        $product->save();

        $insert = 0;
        while ($product->price > $insert) {
            if (!$this->operationRepo->insertBanknote($operation, $banknote)) {
                $this->fail();
            }
            $insert += $banknote->denomination;
        }

        $this->post("/api/vending-machine/buy/{$product->id}")
            ->assertStatus(400);
    }
}
