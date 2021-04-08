<?php


namespace App\Tasks;


use App\Models\Operation;
use App\Repositories\CoinRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Выдает сдачу
 *
 * Class GetChangeTask
 * @package App\Tasks
 */
class GetChangeTask extends Task
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
     * @param  Operation  $operation
     *
     * @return Operation|Model
     * @throws \Exception
     */
    public function run(Operation $operation): Operation
    {
        DB::beginTransaction();
        try {
            $operation->change = $operation->filled ?? 0;
            $operation->filled = 0;

            $change = $operation->change;

            $coins = $this->repo->getList()->sortByDesc('denomination');
            foreach ($coins as $coin) {
                if ($change == 0) {
                    break;
                }
                $count = $change / $coin->denomination;
                if ($count > $coin->amount) {
                    $count = $coin->amount;
                }
                $change -= $count * $coin->denomination;

                $coin->amount -= $count;
                $coin->save();
            }
            if ($change > 0) {
                throw new BadRequestHttpException('Не возможно выдать сдачу');
            }
            $operation->save();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $operation;
    }
}
