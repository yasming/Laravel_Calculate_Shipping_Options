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
        $shippingOptions = ShippingOptions::select('max_height','min_height','max_width','min_width')->get();
        return $shippingOptions->filter(function ($option) use ($value){
            return $this->checkIfHeightIsValid($option,$value) && $this->checkIWidthIsValid($option,$value);
        })->count() > 0;
    }

    private function checkIfHeightIsValid($option,$value) : bool
    {
        return $value['altura'] < $option->max_height && $option->min_height < $value['altura'];
    }

    private function checkIWidthIsValid($option,$value) : bool
    {
        return $value['largura'] < $option->max_width && $option->min_width < $value['largura']; 
    }

    public function message()
    {
        return __('The size of the product is not supported for none of our shipping options');
    }
}
