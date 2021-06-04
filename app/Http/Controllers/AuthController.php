<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Http\Traits\ResponseTrait;

class AuthController extends Controller
{ 
    use ResponseTrait; 

    /**
     * Sign up.
     */
    public function register(Request $request) {
        $req = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($req->fails()){
            return $this->error(400, ['errors' => $req->errors()], 'bad_input');
        }

        $user = User::create(array_merge(
                    $req->validated(),
                    ['password' => bcrypt($request->password)]
                ));
		
		$token = $user->createToken('API Token')->plainTextToken;
        return $this->success(201, ['token' => $token], 'User account created successfully.');
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $req = Validator::make($request->all(), [
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);
        
        if($req->fails()){
            return $this->error(400, ['errors' => $req->errors()], 'bad_input');
        }

        if (!Auth::attempt($req->validated())) {
            return $this->error(401, [], 'unauthorized');
        }
		
		$token = auth()->user()->createToken('API Token')->plainTextToken;
		return $this->success(200, ['token' => $token]);
    }

    /**
     * Get the authenticated User
     */
    public function me(Request $request)
    {
        return $this->success(200, ['user' => $request->user()]);
    }

    /**
     * Log the user out (Invalidate the token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success(200, null, 'Successfully logged out');
    }
}
