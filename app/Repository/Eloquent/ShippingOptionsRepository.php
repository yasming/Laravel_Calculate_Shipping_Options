<?php

namespace App\Repository\Eloquent;

use App\Repository\ShippingOptionsRepositoryInterface;
use App\Models\ShippingOptions;
use Illuminate\Support\Collection;

class ShippingOptionsRepository extends BaseRepository implements ShippingOptionsRepositoryInterface
{
   public function __construct(ShippingOptions $model)
   {
       parent::__construct($model);
   }

    public function calculate($datasOfProduct) : Collection
    {
        $this->all();
        return $this->repository->calculate($datasOfProduct);
    }

    public function all(): Collection
    {
        return $this->model->all();    
    }

}