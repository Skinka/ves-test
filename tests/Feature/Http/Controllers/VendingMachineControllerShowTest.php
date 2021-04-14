<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class VendingMachineControllerShowTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Проверка отображения главной страницы
     */
    public function testShow()
    {
        $this->get('/')->assertOk();
    }
}
