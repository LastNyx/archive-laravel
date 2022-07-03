<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        $success = true;
        $message = 'User register successfully';

        // response
        $response = [
            'user' => $user,
            'success' => $success,
            'message' => $message,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return response()->json($response);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = [
            'name' => $request->name,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('name', $request->name)->firstOrFail();
        $success = true;
        $message = 'User login successfully';
        $token = $user->createToken('auth_token')->plainTextToken;

        // response
        $response = [
            'user' => $user,
            'success' => $success,
            'message' => $message,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return response()->json($response);
    }

    /**
     * Logout
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'success' => true,
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
