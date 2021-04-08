<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Operation
 * @package App\Models
 *
 * @property string             $operation_id
 * @property double             $filled
 * @property double             $spent
 * @property double             $change
 * @property Carbon             $created_at
 * @property Carbon             $updated_at
 *
 * @property OperationProduct[] $products
 */
class Operation extends Model
{
    public $incrementing = false;

    protected $table = 'operations';

    protected $primaryKey = 'operation_id';

    protected $fillable = ['operation_id', 'filled', 'spent', 'change'];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(OperationProduct::class, 'operation_id', 'operation_id');
    }
}
