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
        return response()->json(new CalculateDeliveryFeeResourceCollection(
            $service->getShippingOptionsToProduct($request)
        ));
    }
}
