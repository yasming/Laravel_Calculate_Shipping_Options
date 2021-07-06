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
            'dimensao'         => new CheckIfSizeIsInAnyShippingOptionsRule
        ];
    }
}
