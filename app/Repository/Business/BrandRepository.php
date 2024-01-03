<?php

namespace App\Repository\Business;

use App\Models\Brand;
use App\Repository\Contracts\BrandInterface;

class BrandRepository extends AbstractRepository implements BrandInterface
{
    private $model = Brand::class;
    private $relationships = ['products'];
    private $dependences = ['products'];
    private $unique = [];
    private $message = null;
    private $order = 'name';
    private $upload = [];


    public function __construct()
    {
        $this->model = app($this->model);
        parent::__construct($this->model, $this->relationships, $this->dependences, $this->unique, $this->upload);
    }
    
}

