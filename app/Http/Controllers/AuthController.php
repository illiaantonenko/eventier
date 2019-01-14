<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function  showLoginForm(){
        $redirectTo = app('Illuminate\Routing\UrlGenerator')->previous();
        if(Auth::check()){
            return redirect('/dashboard');
        }else{
            return view('auth',['redirect_url' => $redirectTo]);
        }
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return response()->json(['id'=>auth()->user()->id],200);
        }

        return response()->json([
            'errors' => [
                'email'=>['There is no user with this E-mail address or password']
            ]
        ],411);

    }
    public function register(Request $request){
        $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'middlename'=>'required|string',
            'nickname'=>'nullable|string',
            'birthdate'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|confirmed'
        ]);

        $user = User::create([
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role'=>env('DEFAULT_ROLE'),
            'moderated'=>'0'
        ]);

        if($user){
            $profile = Profile::create([
                'user_id'=>$user->id,
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'middlename'=>$request->lastname,
                'nickname'=>$request->lastname,
                'birthdate'=>strtotime($request->lastname),
                'hideyear'=>'0',
            ]);

            if($profile){
                return $this->login($request);
            }else{
                if(User::destroy($user->id)){
                    return response()->json([
                        'errors'=>[
                            'general'=>['Something went wrong. Try again later.']
                        ]
                    ],419);
                }
            }
        }
    }
}
