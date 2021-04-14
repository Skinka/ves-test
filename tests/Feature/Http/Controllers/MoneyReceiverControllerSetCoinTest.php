<?php

namespace Tests\Feature\Http\Controllers;


use App\Models\Coin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoneyReceiverControllerSetCoinTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * Метод добавления монеты в автомат
     *
     * @return void
     */
    public function testSetBanknote200()
    {
        $this->refreshInMemoryDatabase();
        $this->seed();
        /** @var Coin $coin */
        $coin = Coin::query()->first();
        $response = $this->put("/api/money-receiver/coin/insert/{$coin->id}")
            ->assertStatus(200)
            ->assertJson([
                'filled' => $coin->denomination,
                'spent'  => null,
                'change' => null
            ]);
    }

    /**
     * Метод добавления монеты в автомат
     *
     * @return void
     */
    public function testSetBanknote404()
    {
        $this->put("/api/money-receiver/banknote/insert/100500")
            ->assertNotFound();
    }
}
