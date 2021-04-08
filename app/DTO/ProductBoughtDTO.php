<?php


namespace App\DTO;

use App\Models\Operation;
use App\Models\Product;

/**
 * Проданный товар и текущий счет
 *
 * Class ProductBoughtDTO
 * @package App\DTO
 */
class ProductBoughtDTO extends BaseDTO
{
    public Product   $product;
    public Operation $operation;
}
