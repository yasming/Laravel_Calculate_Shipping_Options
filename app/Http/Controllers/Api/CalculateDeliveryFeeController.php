<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateDeliveryFeeRequest;
use App\Http\Resources\CalculateDeliveryFeeResourceCollection;
use App\Services\ShippingOptionsService;
use Illuminate\Support\Collection;

class CalculateDeliveryFeeController extends Controller
{
    public function __invoke(CalculateDeliveryFeeRequest $request, ShippingOptionsService $service)
    {
        $shippingOptions = $service->getShippingOptionsToProduct($request);
        return response()->json(new CalculateDeliveryFeeResourceCollection(
            $this->formatResponseToApi($shippingOptions,$request)
        ));
    }

    private function formatResponseToApi($shippingOptions,$datasOfProduct) : Collection
    {
        $formattedResponseToApi = collect();
        foreach($shippingOptions as $shippingOption)
        {
            $formattedResponseToApi->push([
                'nome'        => $shippingOption->name,
                'valor_frete' => round(($datasOfProduct->peso * $shippingOption->constant_for_delivery_fee) / 10.0,2),
                'prazo_dias'  => $shippingOption->deadline
            ]);
        }
        return $formattedResponseToApi;
    }
}
