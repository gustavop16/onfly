<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Header Value']);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
                auth('api')->user()
                ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out'], 200, ['X-Header-One' => 'Header Value']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {         
        $user = auth('api')->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 120,
            'user' => new UserResource($user),
        ]);
    }
    
}

/*
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $user_repository;

    public function userRepository()
    {
        if(!isset($this->user_repository)){
            $this->user_repository = new UserRepository();
        }
        return $this->user_repository;
    }

    public function auth(AuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        
        $user = $this->userRepository()->getByEmail($credentials['email']);

        if(empty($user) || Hash::check($credentials['password'], $user->password)){
            return response()->json(['error' => 'The provided credentials are incorrect'], 403, ['X-Header-One' => 'Header Value']);
        }

        //$user->tokens()->delete();
        $token = $user->createToken($user)->plainTextToken;
        
        return response()->json(['access_token' => $token, 'token_type' => 'bearer','user' => new UserResource($user)], 200, ['X-Header-One' => 'Header Value']);

    }

    public function logout(Request $request)
    {
        dd('aaa');
        dd($request->user());

        $request->user()->tokens()->delete();

        return response()->json(['message' => 'success'],200);

    }

    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json(['user' => $user], 200);
    }
}
/***** */