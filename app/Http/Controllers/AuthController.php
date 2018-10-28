<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User; 

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->input('name'); 
        $email = $request->input('email'); 
        $password = Hash::make($request->input('password')); 

        $register = User::create ([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
        ]);

        if ($register)
        {
            return response()->json([
                'Success'=>true, 
                'Message'=>'Anda berhasil melakukan registrasi',
                'Data'=> $register,
            ],201); 

        }
        else 
        {
            return response()->json([
                'Success'=>false, 
                'Message'=>'registrasi gagal',
                'Data'=> '',
            ],400); 
        }
    }

    public function login (Request $request)
    {
        $email= $request->input('email'); 
        $password = $request->input('password'); 

        $user = User::where('email', $email)->first(); 

        if (Hash::check($password, $user->password))
        {
            $apitoken = base64_encode(str_random(40)); 
            $user->update([
                'api_token'=> $apitoken, 
            ]); 
            
            return response()->json([
                'Success'=> true, 
                'Message'=> 'Anda Berhasil Login', 
                'Data'=>[
                    'user'=>$user,
                    'Token'=>$apitoken,
                ]
                ], 201); 

        
        }
        else 
        {
            return response()->json([
                'Success'=> false, 
                'Message'=> 'Periksa kembali pass / email anda', 
                'Data'=>''
                ], 400); 
        }
    }
}