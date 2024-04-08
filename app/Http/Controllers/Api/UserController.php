<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $userLogged = Auth::user()->id;
        $users = User::where('id', '<>', $userLogged)
        ->orderby('name', 'ASC')
        ->get();
        return response()->json([
            'users' => $users
        ], Response::HTTP_OK);
    }

    public function show(User $user){
        return response()->json([
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function me(){
        $userLogged = Auth::user();
        return response()->json([
            'user' => $userLogged
        ], Response::HTTP_OK);
    }
}
