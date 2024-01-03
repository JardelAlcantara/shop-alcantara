<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Repository\Contracts\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(
        Request          $request,
        UserInterface $userInterface
    ) {
        $models = $userInterface->findPaginate($request);
        return response()->view('admin.model.user.index', [
            'models' => $models,
            'filter' => $request,
        ]);
    }

    public function create(Request $request, UserInterface $userInterface)
    {
        $userModels = $userInterface->findAll($request);
        return response()->view('admin.model.user.create', ["users" => $userModels]);
    }

    public function store(UserRequest $request, UserInterface $userInterface)
    {
        $userInterface->save($request);
        toastr($userInterface->getMessage()->text, $userInterface->getMessage()->type);
        if ($userInterface->getMessage()->type === "success") {
            return redirect()->route('admin.user.index');
        } else {
            return back();
        }
    }

    public function show($id, UserInterface $interface)
    {
        return $interface->findById($id);
    }

    public function edit($id, Request $request, UserInterface $interface)
    {
        $model =  $interface->findByid($id);

        if (!empty($model)) {
            return response()->view('admin.model.user.edit', ["model" => $model]);
        } else {
            toastr($interface->getMessage()->text, $interface->getMessage()->type);
            return back();
        }
    }

    public function update(UserRequest $request, $id, UserInterface $interface)
    {
        $model =  $interface->update($id, $request);
        toastr($interface->getMessage()->text, $interface->getMessage()->type);
        if ($interface->getMessage()->type == "success") {
            return redirect()->route('admin.user.index');
        } else {
            return response()->view('admin.model.user.edit', ["model" => $model]);
        }
    }

    public function updateMe(ProfileRequest $request,  UserInterface $interface)
    {
        $interface->updateMe($request);
        toastr($interface->getMessage()->text, $interface->getMessage()->type);
        return redirect()->route('admin');
    }

    public function destroy($id, UserInterface $userInterface)
    {
        $userInterface->deleteById($id);
        toastr($userInterface->getMessage()->text, $userInterface->getMessage()->type);
        return back();
    }

    public function me()
    {
        return view('auth.profile');
    }

    public function changePassword($id, UserInterface $interface)
    {
        $model = $interface->findById($id);
        if ($interface->getMessage()->type == "success") {
            return response()->view('auth.password', ["model" => $model]);
        } else {
            return back();
        }
    }

    public function updatePassword($id, UpdatePasswordRequest $request, UserInterface $userInterface)
    {
        $model = $userInterface->findById($id);
        $userInterface->updatePassword($id, $request);
        toastr($userInterface->getMessage()->text, $userInterface->getMessage()->type);
        if ($userInterface->getMessage()->type == "success") {
            return response()->view('admin.dashboard');
        } else {
            return response()->view('auth.password', ["model" => $model]);
        }
    }
}
