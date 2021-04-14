<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Banknote;
use App\Models\Operation;
use App\Repositories\OperationRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class VendingMachineControllerGetChangeTest extends TestCase
{
    use DatabaseMigrations;

    private OperationRepository $operationRepo;
    private string              $sessionId;
    private array               $cookie = [];

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
     * Выдача сдачи
     */
    public function testGetChange()
    {
        $this->seed();

        /** @var Operation $operation */
        $operation = $this->operationRepo->getBySessionId($this->sessionId);

        /** @var Banknote $banknote */
        $banknote = Banknote::query()->first();

        $this->operationRepo->insertBanknote($operation, $banknote);

        $this->post("/api/vending-machine/get-change")
            ->assertOk()
            ->assertJson([
                'change' => $banknote->denomination,
                'filled' => 0,
                'spent'  => 0
            ]);
    }

    /**
     * Не возможно выдать сдачу
     */
    public function testNotGetChange()
    {
        $this->seed();

        /** @var Operation $operation */
        $operation = $this->operationRepo->getBySessionId($this->sessionId);

        /** @var Banknote $banknote */
        $banknote = Banknote::query()->first();

        for ($i = 0; $i < 1000; $i++) {
            $this->operationRepo->insertBanknote($operation, $banknote);
        }

        $this->post("/api/vending-machine/get-change")->assertStatus(400);
    }
}
