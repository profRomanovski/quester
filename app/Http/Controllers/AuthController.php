<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('layouts.login');
    }

    public function loginAction(Request $request){
        try{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
        }catch (\Exception $ex){
            return $this->viewWithMessage('layouts.login','Warning!','Fill all fields');
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($data)) {
            /**
             * @var User $user
             */
            $user = auth()->user();
            $user->createToken('Quester')->accessToken;
            //return redirect()
        }else{
            return $this->viewWithMessage('layouts.login','Warning!','Login or password is incorrect');
        }
    }
}
