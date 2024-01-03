<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repository\Contracts\BrandInterface;
use App\Repository\Contracts\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(
        Request          $request,
        ProductInterface $productInterface
    ) {
        $models = $productInterface->findPaginate($request);
        return response()->view('admin.model.product.index', [
            'models' => $models,
            'filter' => $request,
        ]);
    }

    public function create(Request $request, ProductInterface $productInterface, BrandInterface $brandInterface)
    {
        $productModels = $productInterface->findAll($request);
        $brandModels = $brandInterface->findAll($request);
        return response()->view('admin.model.product.create', ["products" => $productModels,"brands" => $brandModels]);
    }

    public function store(ProductRequest $request, ProductInterface $productInterface)
    {
        $productInterface->save($request);
        toastr($productInterface->getMessage()->text, $productInterface->getMessage()->type);
        if ($productInterface->getMessage()->type === "success") {
            return redirect()->route('admin.product.index');
        } else {
            return back();
        }
    }

    public function show($id, ProductInterface $interface)
    {
        $model =  $interface->findByid($id);

        if (!empty($model)) {
            return response()->view('admin.model.product.show', ["model" => $model]);
        } else {
            toastr($interface->getMessage()->text, $interface->getMessage()->type);
            return back();
        }
    }

    public function edit($id, Request $request, ProductInterface $interface, BrandInterface $brandInterface)
    {
        $model =  $interface->findByid($id);
        $brandModels = $brandInterface->findAll($request);

        if (!empty($model)) {
            return response()->view('admin.model.product.edit', ["model" => $model,"brands" => $brandModels]);
        } else {
            toastr($interface->getMessage()->text, $interface->getMessage()->type);
            return back();
        }
    }

    public function update(ProductRequest $request, $id, ProductInterface $interface)
    {
        $model =  $interface->update($id, $request);
        toastr($interface->getMessage()->text, $interface->getMessage()->type);
        if ($interface->getMessage()->type == "success") {
            return redirect()->route('admin.product.index');
        } else {
            return response()->view('admin.model.product.edit', ["model" => $model]);
        }
    }

    public function destroy($id, ProductInterface $productInterface)
    {
        $productInterface->deleteById($id);
        toastr($productInterface->getMessage()->text, $productInterface->getMessage()->type);
        return back();
    }
}
