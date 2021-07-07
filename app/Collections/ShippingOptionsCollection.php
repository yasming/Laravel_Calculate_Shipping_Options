<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class ShippingOptionsCollection extends Collection
{
    public function getShippingOptionsToProduct($dimensions)
    {
        return $this->filter(function ($option) use ($dimensions) {
            return $this->checkIfHeightIsValid($option,$dimensions) && $this->checkIWidthIsValid($option,$dimensions);
        });
    }

    private function checkIfHeightIsValid($option,$dimensions) : bool
    {
        return $dimensions['altura'] < $option->max_height && $option->min_height < $dimensions['altura'];
    }

    private function checkIWidthIsValid($option,$dimensions) : bool
    {
        return $dimensions['largura'] < $option->max_width && $option->min_width < $dimensions['largura']; 
    }

}