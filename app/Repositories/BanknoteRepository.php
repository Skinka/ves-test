<?php


namespace App\Repositories;

use App\Models\Banknote as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BanknoteRepository
 * @package App\Repositories
 */
class BanknoteRepository extends BaseRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Возвращает список банкнот
     *
     * @return Builder[]|Collection|Model[]
     */
    public function getList()
    {
        return $this->startConditions()->get();
    }
}
