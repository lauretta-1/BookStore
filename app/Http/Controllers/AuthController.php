<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Resource\UserResource;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except'=>['login','register']]);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'username'=>'required|email',
            'password'=>'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $token_validity = 24 * 60;
        $this->guard()->factory()->setTTL($token_validity);
        if(!$token = $this->guard()->attempt($validator->validated())){
            return response()->json(['error'=>'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(UsersRequest $request){
        
        $user = User::create(array_merge(
            $request->validated(),
            ['password'=>bcrypt($request->password)]
        ));

        return new UserResource($user);
    }

    public function logout(){
        $this->guard()->logout();

        return response()->json(['message'=>'User successfully logged out']);
    }

    
    protected function respondWithToken($token){
        return response()->json([
            'token'=>$token,
            'token_type'=>'Bearer',
            'token_validity'=>$this->guard()->factory()->getTTL()*60
        ]);
    }
    protected function guard(){
        return Auth::guard();
    }
}
