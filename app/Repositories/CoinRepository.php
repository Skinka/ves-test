<?php


namespace App\Repositories;

use App\Models\Coin as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CoinRepository
 * @package App\Repositories
 */
class CoinRepository extends BaseRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Возвращает список монет
     *
     * @return Builder[]|Collection|Model[]
     */
    public function getList()
    {
        return $this->startConditions()->get();
    }
}
