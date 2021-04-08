<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Product
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 * @property float  $price
 * @property int    $amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'price', 'amount'];
}
