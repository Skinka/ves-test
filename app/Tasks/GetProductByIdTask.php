<?php


namespace App\Tasks;


use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Возвращает продукт по ID
 *
 * Class GetProductByIdTask
 * @package App\Tasks
 */
class GetProductByIdTask extends Task
{
    /**
     * @var ProductRepository
     */
    private $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param  int  $product_id
     *
     * @return Product|Model
     * @throws NotFoundHttpException
     */
    public function run(int $product_id): Product
    {
        $product = $this->repo->getById($product_id);
        if (!$product) {
            throw new NotFoundHttpException('Продукт не существует');
        }
        return $product;
    }
}
