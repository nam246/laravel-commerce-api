<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;

class UsersController extends Controller
{
    public function getById($id) {
        $user = User::get()->where('id', $id);

        return response()->json($user, 200);
    }
}
