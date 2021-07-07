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

    public function getShippingOptionsForProduct($datasOfProduct) : Collection
    {
        return $this->repository->getShippingOptionsForProduct($datasOfProduct);
    }

}