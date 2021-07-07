<?php

namespace App\Repository;
use Illuminate\Support\Collection;

interface ShippingOptionsRepositoryInterface
{
    public function getShippingOptionsForProduct($datasOfProduct): Collection;
    public function all(): Collection;

}