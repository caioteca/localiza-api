<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['bloqueio','logout','login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $number = request()->input('telefone');
        $email = request()->input('email');

    	$validator = Validator::make($request->all(), [
            'telefone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Dados incorrectos'], 401);
        }
        
        
        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'telefone' => 'required|string|min:9',
           // 'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json(['message' =>$validator->errors()->toJson()], 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'Registrado com sucesso',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
    $user = Auth::guard('api')->user();
    if($user==''){
    return response()->json(['message' => 'Nenhum usuário logado']);   
    }else{
        auth()->logout();

        return response()->json(['message' => 'Desconectado com sucesso']);
    }
        
    }


    public function bloqueio(Request $request) {
        $status_admin=1;//Auth::role(); // admin role 1
        $bloqueio_user=$request->input('bloqueio_user');

         $result = DB::table('users')->where('id', $bloqueio_user)->pluck('id');
         $result1 = DB::table('users')->where('id', $bloqueio_user)->pluck('status');
         $id_user1 = str_replace("[",'',$result);//remover matriz
         $id_user2 = str_replace("]",'',$id_user1);//remover matriz
         $status_user1 = str_replace("[",'',$result1);//remover matriz
         $status_user2 = str_replace("]",'',$status_user1);//remover matriz
           if($bloqueio_user!='' && $status_admin==1){ 
         if($id_user2==$bloqueio_user){
            $db_status=$status_user2;
            $block=$db_status==1?0:1;
            $block_text=$db_status==1?'Conta de usuário bloqueada':'Conta de usuário desbloqueada';
            $Atm_bombas = DB::update(DB::raw('UPDATE users SET status='.$block.' WHERE id ='.$bloqueio_user.'  '));
            return response()->json(['message' => $block_text]);
        }else{
        return response()->json(['message' =>'Selecionar o usuário a ser bloqueado!']);
        }
    }else{
        return response()->json(['message' =>'Usuário não existe!']);
    }
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}
