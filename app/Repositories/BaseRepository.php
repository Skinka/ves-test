<?php
/**
 * Created by CWDLab
 * User: Skinka
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
abstract class BaseRepository
{
    /** @var Model */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }


    /**
     * Return model class name
     *
     * @return string
     */
    abstract protected function getModelClass(): string;


    /**
     * Start query from model
     *
     * @return Model|Builder
     */
    protected function startConditions()
    {
        return clone $this->model;
    }

    /**
     * Get data by id
     *
     * @param $id
     *
     * @return Model|null
     */
    public function getById($id)
    {
        $model = $this->startConditions()->where('id', $id)->first();
        return $model;
    }
}
