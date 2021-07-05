<?php

use App\Models\ShippingOptions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatasToShippingOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ShippingOptions::create([
            'name'                      => 'Entrega Ninja',
            'constant_for_delivery_fee' => 0.3,
            'max_height'                => 200,
            'min_height'                => 10,
            'max_width'                 => 140,
            'min_width'                 => 6,
            'deadline'                  => 6
        ]);

        ShippingOptions::create([
            'name'                      => 'Entrega KaBuM',
            'constant_for_delivery_fee' => 0.2,
            'max_height'                => 140,
            'min_height'                => 5,
            'max_width'                 => 125,
            'min_width'                 => 13,
            'deadline'                  => 4
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ShippingOptions::where('name', 'Entrega Ninja')->delete();
        ShippingOptions::where('name', 'Entrega KaBuM')->delete();
    }
}
