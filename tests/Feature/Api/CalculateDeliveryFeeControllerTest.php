<?php

namespace Tests\Feature\Api;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CalculateDeliveryFeeControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @dataProvider getRequiredFields
     * @param $field
     * @param $fieldValidationMessage
     */
    public function test_required_fields($field, $fieldValidationMessage)
    {
        $this->post(route('api.calculate-delivery-fee'), [])
            ->assertJson([
                $field => [$fieldValidationMessage]
            ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function getRequiredFields() : array
    {
        parent::setup();
        return [
            ['peso'             , __('The product weight is required')],
            ['dimensao.altura'  , __('The height of the product is required')],
            ['dimensao.largura' , __('The width of the product is required')],
            ['dimensao'         , __('The dimension of the product is required')],
        ];
    }

    public function test_numeric_fields()
    {
        $this->post(route('api.calculate-delivery-fee'), [
            'peso' => 'xxx'
        ])->assertJson([
            'peso' => [__('validation.numeric', ['attribute' => 'peso'])]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->post(route('api.calculate-delivery-fee'), [
            'dimensao' => [
                'largura' => 'xxx'
            ]
        ])->assertJson([
            'dimensao.largura' => [__('validation.numeric', ['attribute' => 'largura'])]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);


        $this->post(route('api.calculate-delivery-fee'), [
            'dimensao' => [
                'altura' => 'xxx'
            ]
        ])->assertJson([
            'dimensao.altura' => [__('validation.numeric', ['attribute' => 'altura'])]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_greater_than_zero_fields()
    {
        $this->post(route('api.calculate-delivery-fee'), [
            'peso' => -1
        ])->assertJson([
            'peso' => [__('validation.gt.numeric', ['attribute' => 'peso', 'value'  => 0])]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->post(route('api.calculate-delivery-fee'), [
            'dimensao' => [
                'largura' => -1
            ]
        ])->assertJson([
            'dimensao.largura' => [__('validation.gt.numeric', ['attribute' => 'largura', 'value'  => 0])]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->post(route('api.calculate-delivery-fee'), [
            'dimensao' => [
                'altura' => 0
            ]
        ])->assertJson([
            'dimensao.altura' => [__('validation.gt.numeric', ['attribute' => 'altura', 'value' => 0])]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_dimension_withou_shipping_rule_options()
    {
        $this->post(route('api.calculate-delivery-fee'), [
            'dimensao' => [
                'altura' => 0,
                'largura' => 0
            ]
        ])->assertJson([
            'dimensao' => [__('The size of the product is not supported for none of our shipping options')]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->post(route('api.calculate-delivery-fee'), [
            'dimensao' => [
                'altura' => 1000000000000000000,
                'largura' => 1000000000000000000
            ]
        ])->assertJson([
            'dimensao' => [__('The size of the product is not supported for none of our shipping options')]
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_it_should_be_able_to_return_shipping_options()
    {
        $this->post(route('api.calculate-delivery-fee'), [
            'dimensao' => [
                'altura'  => 102,
                'largura' => 40
            ],
            'peso' => 400
        ])->assertJson([
            'data' => [
                [
                    "nome"        => "Entrega Ninja",
                    "valor_frete" => 12,
                    "prazo_dias"  => 6
                ],
                [
                    "nome"        => "Entrega KaBuM",
                    "valor_frete" => 8,
                    "prazo_dias"  => 4
                ]
            ]
        ])->assertStatus(Response::HTTP_OK);

        $this->post(route('api.calculate-delivery-fee'), [
            'dimensao' => [
                'altura'  => 152,
                'largura' => 50
            ],
            'peso' => 850
        ])->assertJson([
            'data' => [
                [
                    "nome"        => "Entrega Ninja",
                    "valor_frete" => 25.50,
                    "prazo_dias"  => 6
                ],
            ]
        ])->assertStatus(Response::HTTP_OK);
    }
}
