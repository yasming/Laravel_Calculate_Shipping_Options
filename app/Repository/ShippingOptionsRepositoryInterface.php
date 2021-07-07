<?php

namespace App\Repository;
use Illuminate\Support\Collection;

interface ShippingOptionsRepositoryInterface
{
    public function getShippingOptionsToProduct($datasOfProduct): Collection;
    public function all(): Collection;

}