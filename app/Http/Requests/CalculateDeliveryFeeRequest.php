<?php

namespace App\Http\Requests;

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
            'peso'            => 'required|min:0',
            'dimensao.height' => 'required|min:0',
            'dimensao.width'  => 'required|min:0',
        ];
    }
}
