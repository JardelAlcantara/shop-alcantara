<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request;

interface UserInterface
{
    public function findPaginate(Request $request);
    public function findAll(Request $request);
    public function findById($id);
    public function updatePassword($id,Request $request);

    public function save(Request $request);
    public function update($id, Request $request);
    public function deleteById($id);
    public function updateMe(Request $request);

    public function getMessage();
}
