<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Repository\Contracts\BrandInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(
        Request          $request,
        BrandInterface $brandInterface
    ) {
        $models = $brandInterface->findPaginate($request);
        return response()->view('admin.model.brand.index', [
            'models' => $models,
            'filter' => $request,
        ]);
    }

    public function create(Request $request, BrandInterface $brandInterface)
    {
        $brandModels = $brandInterface->findAll($request);
        return response()->view('admin.model.brand.create', ["brands" => $brandModels]);
    }

    public function store(BrandRequest $request, BrandInterface $brandInterface)
    {
        $brandInterface->save($request);
        toastr($brandInterface->getMessage()->text, $brandInterface->getMessage()->type);
        if ($brandInterface->getMessage()->type === "success") {
            return redirect()->route('admin.brand.index');
        } else {
            return back();
        }
    }

    public function show($id, BrandInterface $interface)
    {
        return $interface->findById($id);
    }

    public function edit($id, Request $request, BrandInterface $interface)
    {
        $model =  $interface->findByid($id);

        if (!empty($model)) {
            return response()->view('admin.model.brand.edit', ["model" => $model]);
        } else {
            toastr($interface->getMessage()->text, $interface->getMessage()->type);
            return back();
        }
    }

    public function update(BrandRequest $request, $id, BrandInterface $interface)
    {
        $model =  $interface->update($id, $request);
        toastr($interface->getMessage()->text, $interface->getMessage()->type);
        if ($interface->getMessage()->type == "success") {
            return redirect()->route('admin.brand.index');
        } else {
            return response()->view('admin.model.brand.edit', ["model" => $model]);
        }
    }

    public function destroy($id, BrandInterface $brandInterface)
    {
        $brandInterface->deleteById($id);
        toastr($brandInterface->getMessage()->text, $brandInterface->getMessage()->type);
        return back();
    }
}