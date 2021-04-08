<?php


namespace App\Repositories;

use App\Models\Product as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
class ProductRepository extends BaseRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Возвращает список продукции
     *
     * @param  false  $withEmpty
     *
     * @return Builder[]|Collection|Model[]
     */
    public function getList($withEmpty = false)
    {
        $query = $this->startConditions();
        if (!$withEmpty) {
            $query->where('amount', '>', 0);
        }
        return $query->get();
    }
}
