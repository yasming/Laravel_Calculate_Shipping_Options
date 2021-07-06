<?php

namespace App\Http\Requests;

use App\Rules\CheckIfSizeIsInAnyShippingOptionsRule;
use App\Traits\FormatResponseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class CalculateDeliveryFeeRequest extends FormRequest
{
    use FormatResponseFormRequest;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'peso'             => 'required|numeric|gt:0',
            'dimensao.altura'  => 'required|numeric|gt:0',
            'dimensao.largura' => 'required|numeric|gt:0',
            'dimensao'         => ['required', new CheckIfSizeIsInAnyShippingOptionsRule]
        ];
    }

    public function messages()
    {
        return [
            'peso.required'             => __('The product weight is required'),
            'dimensao.altura.required'  => __('The height of the product is required'),
            'dimensao.largura.required' => __('The width of the product is required'),
            'dimensao.required'         => __('The dimension of the product is required')
        ];
    }
}
