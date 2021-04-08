<?php


namespace App\Tasks;


use App\Models\Banknote;
use App\Repositories\BanknoteRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Возвращает банкноту по ID
 *
 * Class GetBanknoteTask
 * @package App\Tasks
 */
class GetBanknoteByIdTask extends Task
{
    /**
     * @var BanknoteRepository
     */
    private $repo;

    public function __construct(BanknoteRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param  int  $banknote_id
     *
     * @return Banknote|Model
     */
    public function run(int $banknote_id): Banknote
    {
        $banknote = $this->repo->getById($banknote_id);
        if (!$banknote) {
            throw new NotFoundHttpException('Банкнота не существует');
        }
        return $banknote;
    }
}
