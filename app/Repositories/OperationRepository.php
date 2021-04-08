<?php


namespace App\Repositories;

use App\Models\Operation as Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class OperationRepository
 * @package App\Repositories
 */
class OperationRepository extends BaseRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Возвращает список продукции
     *
     * @param  string  $sessionId
     *
     * @return Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getBySessionId(string $sessionId)
    {
        return $this->startConditions()
            ->where('operation_id', $sessionId)
            ->firstOrCreate([
                'operation_id' => $sessionId
            ]);
    }
}
