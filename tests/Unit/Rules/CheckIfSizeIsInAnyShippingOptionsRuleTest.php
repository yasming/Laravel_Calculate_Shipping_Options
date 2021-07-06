<?php

namespace Tests\Unit\Rules;

use App\Rules\CheckIfSizeIsInAnyShippingOptionsRule;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class CheckIfSizeIsInAnyShippingOptionsRuleTest extends TestCase
{
    use DatabaseMigrations;

    public function testPassesTrue()
    {
        $value = [
            'altura'  => 102,
            'largura' => 40
        ];

        $rule    = new CheckIfSizeIsInAnyShippingOptionsRule;
        $retorno = $rule->passes('dimensao', $value);

        $this->assertTrue($retorno);
    }

    public function testPassesFalse()
    {
        $value = [
            'altura'  => 0,
            'largura' => 0
        ];

        $rule    = new CheckIfSizeIsInAnyShippingOptionsRule;
        $retorno = $rule->passes('dimensao', $value);

        $this->assertFalse($retorno);
    }

    public function testMessage()
    {
        $request = new Request();
        $rule    = new CheckIfSizeIsInAnyShippingOptionsRule($request);
        $retorno = $rule->message();

        $this->assertEquals(__('The size of the product is not supported for none of our shipping options'), $retorno);
    }
}
