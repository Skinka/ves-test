<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class OperationProduct
 * @package App\Models
 *
 * @property int    $id
 * @property string $operation_id
 * @property int    $product_id
 * @property string $name
 * @property double $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class OperationProduct extends Model
{
    protected $table = 'operation_products';

    protected $fillable = ['operation_id', 'product_id', 'name', 'price'];
}
