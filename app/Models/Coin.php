<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Coin
 * @package App\Models
 *
 * @property int    $id
 * @property double $denomination
 * @property int    $amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Coin extends Model
{
    protected $table = 'coins';

    protected $fillable = ['denomination', 'amount'];
}
