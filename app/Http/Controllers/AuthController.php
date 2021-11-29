<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        auth()->logout();
        return view('layouts.login');
    }

    public function register()
    {
        return view('layouts.register');
    }

    public function registerAction(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        /**
         * @var User $user
         */
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->createToken('Quester')->accessToken;
        return redirect()->route('home');
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
            return redirect("home");
        }else{
            return $this->viewWithMessage('layouts.login','Warning!','Login or password is incorrect');
        }
    }
}
