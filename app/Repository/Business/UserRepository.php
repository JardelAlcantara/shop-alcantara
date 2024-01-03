<?php

namespace App\Repository\Business;


use App\Models\User;
use App\Repository\Contracts\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends AbstractRepository implements UserInterface
{
    private $model = User::class;
    private $relationships = ['userProduct'];
    private $dependences = ['userProduct'];
    private $unique = ['phone'];
    private $message = null;
    private $order = 'name';
    private $upload = ['picture', '/user'];


    public function __construct()
    {
        $this->model = app($this->model);
        parent::__construct($this->model, $this->relationships, $this->dependences, $this->unique, $this->upload);
    }
    
    public function updateMe(Request $request)
    {
        $model = User::find(Auth::user()->id);
        $request->request->remove('password');
        $request->request->remove('created_at');
        $request->request->remove('id');
        $request->request->remove('type');
        $model->fill($request->all());
        $this->uploadFiles($model, $request);

        $model->save();

        $this->setMessage('O Usuário foi atualizado com sucesso', 'success');
        return $model;
    }


    public function resetPassword($id, Request $request)
    {
        if (auth()->user()->type != 'ROOT') {
            $this->setMessage('Você não tem permissão.', 'danger');
            return null;
        }
        $user = User::find($id);
        if (empty($user)) {
            $this->setMessage('O registro não exite.', 'danger');
            return null;
        }
        $user->password = $request['password'];
        $user->save();
        $this->setMessage('A senha foi atualizada com sucesso', 'success');
        return $user;
    }
    public function updatePassword($id, Request $request)
    {
        $user = User::find($id);
        if (empty($user)) {
            $this->setMessage('O registro não exite.', 'danger');
            return null;
        }
        if (Hash::check($request->passwordOld, $user->password) === true) {
            $user->password = $request['password'];
            $user->save();
            $this->setMessage('A senha foi atualizada com sucesso', 'success');
            return $user;
        }
        $this->setMessage('A senha anterior está incorreta.', 'danger');
        return null;
    }
}

