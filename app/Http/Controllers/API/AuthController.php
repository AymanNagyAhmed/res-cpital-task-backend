<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Resources\LoginAuthResource;
use App\Http\Resources\RegisterAuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(RegisterAuthRequest $request)
    {
        $validated = $request->validated();
        $validated["password"] = Hash::make($validated["password"]);
        $user = User::create($validated);
        $token = $user->createToken('auth_token')->plainTextToken;
        $request["token"]=$token;
        return new RegisterAuthResource($user);
    }

    public function login(LoginAuthRequest
     $request)
    {
        $validated = $request->validated();
        if (!Auth::attempt($validated))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        $user = User::where('email', $validated['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $request["token"]= $token;
        return new LoginAuthResource($user);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
