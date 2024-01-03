<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProductRequest;
use App\Repository\Contracts\UserProductInterface;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
   
    public function index(
        Request          $request,
        UserProductInterface $userProductInterface
    ) {
        $models = $userProductInterface->findPaginate($request);
        return response()->view('admin.model.user_product.index', [
            'models' => $models,
            'filter' => $request,
        ]);
    }

    public function create(Request $request, UserProductInterface $userProductInterface)
    {
        $userPproductModels = $userProductInterface->findAll($request);
        return response()->view('admin.model.user_product.create', ["userProducts" => $userPproductModels]);
    }

    public function store(UserProductRequest $request, UserProductInterface $userProductInterface)
    {
        $userProductInterface->save($request);
        toastr($userProductInterface->getMessage()->text, $userProductInterface->getMessage()->type);
        if ($userProductInterface->getMessage()->type === "success") {
            return redirect()->route('admin.user.product.index');
        } else {
            return back();
        }
    }

    public function show($id, UserProductInterface $interface)
    {
        $model =  $interface->findByid($id);

        if (!empty($model)) {
            return response()->view('admin.model.user_product.show', ["model" => $model]);
        } else {
            toastr($interface->getMessage()->text, $interface->getMessage()->type);
            return back();
        }
    }

    public function edit($id, Request $request, UserProductInterface $interface)
    {
        $model =  $interface->findByid($id);

        if (!empty($model)) {
            return response()->view('admin.model.user_product.edit', ["model" => $model]);
        } else {
            toastr($interface->getMessage()->text, $interface->getMessage()->type);
            return back();
        }
    }

    public function update(UserProductRequest $request, $id, UserProductInterface $interface)
    {
        $model =  $interface->update($id, $request);
        toastr($interface->getMessage()->text, $interface->getMessage()->type);
        if ($interface->getMessage()->type == "success") {
            return redirect()->route('admin.user.product.index');
        } else {
            return response()->view('admin.model.user_product.edit', ["model" => $model]);
        }
    }

    public function destroy($id, UserProductInterface $userProductInterface)
    {
        $userProductInterface->deleteById($id);
        toastr($userProductInterface->getMessage()->text, $userProductInterface->getMessage()->type);
        return back();
    }
}
