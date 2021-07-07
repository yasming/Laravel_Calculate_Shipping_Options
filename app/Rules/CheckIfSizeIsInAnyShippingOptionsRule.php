<?php

namespace App\Rules;

use App\Models\ShippingOptions;
use Illuminate\Contracts\Validation\Rule;

class CheckIfSizeIsInAnyShippingOptionsRule implements Rule
{

    public function __construct()
    {
        
    }

    public function passes($attribute, $value)
    {
        if(!isset($value['altura']) || !isset($value['largura'])) return false;
        return $this->checkIfValueIsValidForAnyShippingOption($value);
    }

    private function checkIfValueIsValidForAnyShippingOption($value) : bool
    {
        $shippingOptions = ShippingOptions::all();
        return $shippingOptions->getShippingOptionsToProduct($value)->count() > 0;
    }

    public function message()
    {
        return __('The size of the product is not supported for none of our shipping options');
    }
}
