<?php

namespace App\Services;

use App\Repository\Eloquent\ShippingOptionsRepository;
use Illuminate\Support\Collection;

class ShippingOptionsService
{
    private $repository;

    public function __construct(ShippingOptionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getShippingOptionsToProduct($datasOfProduct) : Collection
    {
        return $this->repository->getShippingOptionsToProduct($datasOfProduct);
    }

}