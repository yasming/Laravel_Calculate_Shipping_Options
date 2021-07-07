<?php

namespace App\Repository;
use Illuminate\Support\Collection;

interface ShippingOptionsRepositoryInterface
{
    public function calculate($datasOfProduct): Collection;
    public function all(): Collection;

}