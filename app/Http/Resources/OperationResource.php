<?php


namespace App\Http\Resources;


use App\Models\Operation;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OperationResource
 * @package App\Http\Resources
 *
 * @mixin Operation
 */
class OperationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'filled' => $this->filled,
            'spent'  => $this->spent,
            'change' => $this->change
        ];
    }
}
