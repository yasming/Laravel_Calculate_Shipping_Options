<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CalculateDeliveryFeeResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($shippingOption) use ($request) {
                return [
                    'nome'        => $shippingOption->name,
                    'valor_frete' => round(($request->peso * $shippingOption->constant_for_delivery_fee) / 10.0,2),
                    'prazo_dias'  => $shippingOption->deadline
                ];
            })
        ];
    }
}
