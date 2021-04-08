<?php


namespace App\Tasks;


use App\Models\Operation;
use App\Repositories\OperationRepository;
use Illuminate\Database\Eloquent\Builder;

/**
 * Возвращает или создает новую операцию
 * Ищет по php sessionID
 *
 * Class GetOrCreateOperationTask
 * @package App\Tasks
 */
class GetOrCreateOperationTask extends Task
{
    /**
     * @var OperationRepository
     */
    private $repo;

    public function __construct(OperationRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return Operation|Builder
     */
    public function run(): Operation
    {
        $sId = request()->session()->getId();
        return $this->repo->getBySessionId($sId);
    }
}
