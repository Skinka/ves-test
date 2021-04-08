<?php


namespace App\Tasks;


use App\Models\Coin;
use App\Repositories\CoinRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Возвращает монету по ID
 *
 * Class GetCoinByIdTask
 * @package App\Tasks
 */
class GetCoinByIdTask extends Task
{
    /**
     * @var CoinRepository
     */
    private $repo;

    public function __construct(CoinRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param  int  $coin_id
     *
     * @return Coin|Model
     */
    public function run(int $coin_id): Coin
    {
        $coin = $this->repo->getById($coin_id);
        if (!$coin) {
            throw new NotFoundHttpException('Монета не существует');
        }
        return $coin;
    }
}
