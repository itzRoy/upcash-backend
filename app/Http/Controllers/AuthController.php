<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;




class AuthController extends Controller
{
    public function login(Request $request){
      try{
        
        if(Auth::attempt($request->only('username', 'password'))){

          /** @var Admin $admin */
          $admin = Auth::user();
          $token = $admin -> createToken(name: 'app')->accessToken;
  
          return response([
            'message' => 'success',
            'token' => $token,
            'admin' => $admin
          ]);
        }
       
      }catch(\Exepion $exeption){
       return response([
         'message' => $exeption->getMessage()
       ], status: 400);
        
      }

      return response([
        'message' => 'invalid username/password'
    ], status: 401);
  }

  public function authAdmin(){
    return Auth::user();
  }


  public function addAdmin(Request $request){
    try{
      $admin = Admin::create([
        'username'=> $request->input(key: 'username' ),
        'password'=> Hash::make($request->input(key: 'password'))
      ]);
  
      return $admin;
    }
    catch(\Excepion $exeption){
      return response([
        'message' => $exeption->getMessage()
      ], status: 400);
       
     }  
    
  }

}
