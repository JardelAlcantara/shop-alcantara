<?php

namespace App\Repository\Business;

use App\Models\Product;
use App\Models\UserProduct;
use App\Repository\Contracts\UserProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProductRepository extends AbstractRepository implements UserProductInterface
{
    private $model = UserProduct::class;
    private $relationships = ['product', 'user'];
    private $dependences = [];
    private $unique = [];
    private $message = null;
    private $order = 'name';
    private $upload = [];


    public function __construct()
    {
        $this->model = app($this->model);
        parent::__construct($this->model, $this->relationships, $this->dependences, $this->unique, $this->upload);
    }

    public function findPaginate(Request $request)
    {
        $models = $this->model->query()->with($this->relationships);

        if (auth()->user()->type != "ADMIN") {
            $models = $this->model->query()->with($this->relationships)->where('user_id', auth()->user()->id);
        }

        if ($request->exists('search')) {
            $this->setFilterGlobal($request, $models);
        } else {
            $this->setFilterByColumn($request, $models);
        }
        $this->setOrder($request, $models);
        $models = $models->paginate(8);
        $this->setMessage('Consulta Finalizada', 'success');
        return $models;
    }


    public function save(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($product->quantyty >= 1) {
            $model = new $this->model();
            $model->product_id = $request->product_id;
            $model->status = "NOVO";
            $model->user_id = Auth::user()->id;

            $product->quantyty = $product->quantyty - 1;
            $product->save();
            $model->save();
            $this->setMessage('Compra efetuada com sucesso.', 'success');
            return $model;
        }
        $this->setMessage('O produto não está disponível.', 'error');
        return null;
    }

    public function deleteById($id)
    {
        $model = $this->model->query()->with($this->relationships);
      
        $model = $model->find($id);
        if (empty($model)) {
            $this->setMessage('O registro não exite.', 'danger');
            return null;
        }
        if ($this->dependencies($model) == false) {
            $this->setMessage('O registro não pode ser apagado, o mesmo está vinculado em outro lugar.', 'error');
            return null;
        }
        $product = Product::find($model->product_id);
        $product->quantyty += 1;
        $product->save();
        $model->destroy($model->id);
        $this->setMessage('Compra apadada', 'success');
        return null;
    }

    
    public function update($id, Request $request)
    {
        $model = $this->model->query()->with($this->relationships);
       
        $model = $model->find($id);
        if (empty($model)) {
            $this->setMessage('O registro não exite.', 'danger');
            return null;
        }

        if ($this->isDuplicate($request, $id) == true) {
            $this->setMessage('O registro já existe.', 'warning');
            return null;
        }
        $request->request->remove('_token');
        $request->request->remove('_method');
        $request->request->remove('created_at');
        
        $data = $model->getAttributes();
        $array_diff = array_diff($request->all(), $data);

        $model->fill($array_diff);
        $this->uploadFiles($model, $request);
        $model->save();

        $product = Product::find($model->product_id);
        $product->quantyty += 1;
        $product->save();

        $this->setMessage('Compra recusada', 'success');
        return $model;
    }

}
