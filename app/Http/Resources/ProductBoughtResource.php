<?php


namespace App\Http\Resources;


use App\DTO\ProductBoughtDTO;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductBoughtResource
 * @package App\Http\Resources
 *
 * @mixin ProductBoughtDTO
 */
class ProductBoughtResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'product'   => new ProductResource($this->product),
            'operation' => new OperationResource($this->operation),
        ];
    }
}
