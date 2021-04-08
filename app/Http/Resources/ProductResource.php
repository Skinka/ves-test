<?php


namespace App\Http\Resources;


use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductResource
 * @package App\Http\Resources
 *
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name'   => $this->name,
            'price'  => $this->price,
            'amount' => $this->amount
        ];
    }
}
