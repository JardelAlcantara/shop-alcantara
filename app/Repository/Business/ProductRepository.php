<?php

namespace App\Repository\Business;

use App\Models\Product;
use App\Repository\Contracts\ProductInterface;
use Illuminate\Http\Request;

class ProductRepository extends AbstractRepository implements ProductInterface
{
    private $model = Product::class;
    private $relationships = ['brand'];
    private $dependences = ['userProducts'];
    private $unique = [];
    private $message = null;
    private $order = 'name';
    private $upload = ['picture', 'product'];


    public function __construct()
    {
        $this->model = app($this->model);
        parent::__construct($this->model, $this->relationships, $this->dependences, $this->unique, $this->upload);
    }
    
}

