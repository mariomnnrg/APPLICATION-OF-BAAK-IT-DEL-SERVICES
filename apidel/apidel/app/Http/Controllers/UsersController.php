<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Import the Validator class

class UsersController extends Controller
{
    
public function index()
{
    return response()->json(User::all(), 200);
}
    public function login()
    {
        if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'noktp' => 'required',
            'nim' => 'required',
            'namalengkap' => 'required',
            'nohp' => 'required',
            'username' => 'required',
            'password' => 'required',
            'typed' =>'nullable'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('appToken')->accessToken;
        return response()->json([
            'success' => true,
            'token' => $success,
            'user' => $user
        ]);
    }
    
    
    // Delete User
    public function delete(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }

}
