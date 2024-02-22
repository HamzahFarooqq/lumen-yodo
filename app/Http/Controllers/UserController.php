<?php 

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{



    public function signup(Request $request)
    {

            // $data = $request->all();

            // DB::table('users')->insert($data);

            User::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([

                'message' => 'user signup complete'

            ],200);
    }




    public function login()
    {
        $credentials = request(['email', 'password']);

   

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }




    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }




}






?>