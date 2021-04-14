<?php

namespace Tests\Feature\Http\Controllers;


use App\Models\Banknote;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoneyReceiverControllerSetBanknoteTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * Метод добавления банкноты в автомат
     *
     * @return void
     */
    public function testSetBanknote200()
    {
        $this->refreshInMemoryDatabase();
        $this->seed();
        /** @var Banknote $banknote */
        $banknote = Banknote::query()->first();
        $response = $this->put("/api/money-receiver/banknote/insert/{$banknote->id}")
            ->assertStatus(200)
            ->assertJson([
                'filled' => $banknote->denomination,
                'spent'  => null,
                'change' => null
            ]);
    }

    /**
     * Метод добавления банкноты в автомат
     *
     * @return void
     */
    public function testSetBanknote404()
    {
        $this->put("/api/money-receiver/banknote/insert/100500")
            ->assertNotFound();
    }
}
