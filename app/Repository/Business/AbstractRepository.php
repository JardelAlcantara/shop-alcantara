<?php
declare(strict_types=1);

namespace App\Repository\Business;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use stdClass;

abstract class AbstractRepository
{
    private object $model;
    private array $relationships;
    private array $appends;
    private array $dependencies;
    private array $unique;
    private array $upload;
    private stdClass $message;

    public function __construct($model, $relationships, $dependencies, $unique, $upload = [])
    {
        $this->model = $model;
        $this->relationships = $relationships;
        $this->dependencies = $dependencies;
        $this->unique = $unique;
        $this->upload = $upload;
        $this->message = new stdClass();
        $this->appends = [];
    }


    public function findPaginate(Request $request)
    {
        $models = $this->model->query()->with($this->relationships);
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

  

    public function findById($id)
    {
        $model = $this->model->query()->with($this->relationships);
    
        $model = $model->find($id);
        if (empty($model)) {
            $this->setMessage('O registro não exite.', 'danger');
            return null;
        }
        $this->setMessage('O registro foi encontrado com sucesso', 'success');
        return $model;
    }

    public function findAll(Request $request)
    {
        $models = $this->model->query()->with($this->relationships);
        $this->filters($request, $models);
       
        $this->setOrder($request, $models);
        $models = $models->get();
        $this->setMessage('Consulta Finalizada', 'success');
        return $models;
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
        $this->uploadFiles($model);
        $model->destroy($model->id);
        $this->setMessage('O registro foi apagado com sucesso.', 'success');
        return null;
    }

    public function save(Request $request)
    {
        if ($this->isDuplicate($request) == true) {
            $this->setMessage('O registro já existe.', 'warning');
            return null;
        }
        $model = new $this->model();
        $model->fill($request->all());
        $this->uploadFiles($model, $request);
       
        $model->save();

        $this->setMessage('O registro foi salvo com sucesso.', 'success');
        return $model;
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

        $this->setMessage('O registro foi atualizado com sucesso', 'success');
        return $model;
    }


    protected function dependencies($model): bool
    {
        $count = 0;
        if (!empty($model = $this->model->with($this->dependencies)->find($model->id))) {
            foreach ($this->dependencies as $dependence) {
                if (!empty($model->$dependence[0])) {
                    $count++;
                }
            }
        }
        if ($count > 0) {
            return false;
        }
        return true;
    }

    protected function isDuplicate(Request $data, $id = null): bool
    {
        $columns = $this->unique;
        if (empty($this->unique)) {
            return false;
        }
        $models = $this->model->query();
        $count = 0;
        foreach ($columns as $column) {
            if (!empty($data->$column) && Schema::hasColumn($this->model->getTable(), $column)) {
                $models->where($column, $data->$column);
                $count++;
            }
        }
        if ($id != null) {
            $models->where('id', '!=', $id);
        }
        if (count($models->get()) > 0 && count($columns) == $count) {
            return true;
        }
        return false;
    }


    public function setFilterGlobal(Request $request, $search)
    {
        if ($request->exists('search') == true) {
            foreach (Schema::getColumnListing($this->model->getTable()) as $column) {
                $search->orWhere($column, "LIKE", "%" . $request->search . "%");
            }
        }
    }


    public function setFilterByColumn(Request $request, $search)
    {
        $columns = $this->model->getFillable();
        foreach ($columns as $field) {
            if ($request->exists($field) == true) {
                $search->where($field, boolval($request->$field));
            }
        }
    }

    public function setOrder(Request $request, $search)
    {
        $orderBy = $request->order_by;
        $order = $request->order;
        if (empty($orderBy)) {
            $orderBy = 'id';
        }
        if (empty($order)) {
            $order = 'desc';
        }
        if (Schema::hasColumn($this->model->getTable(), $orderBy) == false) {
            $orderBy = 'id';
        }
        return $search->orderBy($orderBy, $order);
    }

    public function uploadFiles($model, Request $request = null)
    {
        if ($this->upload == []) {
            return null;
        }
        $file = $this->upload[0];
        $path = $this->upload[1];
        if ($this->model == User::class) {
            $path = $this->upload[1];
        }
        if (empty($request)) {
            if (Storage::exists($model->$file())) {
                Storage::delete($model->$file());
            }
            return null;
        }

        if ($request->hasFile($file) == true && $model->id) {
            if (Storage::exists($model->$file()) === null) {
                Storage::delete($model->$file());
            }
            $model->$file = $request->file($file)->store($path);
            return $model->$file;
        } elseif ($request->hasFile($file) == true && empty($model->id)) {
            $model->$file = $request->file($file)->store($path);
            return $model->$file;
        }
        return null;
    }


    public function getMessage()
    {
        return $this->message;
    }

    protected function setMessage($text, $type)
    {
        $this->message->text = $text;
        $this->message->type = $type;
    }


    public function filters($request, $query)
    {
    }
}
