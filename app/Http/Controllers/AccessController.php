<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;


class AccessController extends Controller{
    
    public function login(): View
    {
        return view('auth.login', ['no_categories' => true]);
    }
    
    public function getLogin(){

        $categories = Category::all();

        $mainNews = News::orderBy('created_at', 'desc')->limit(1)->get()->first();

    	$news = News::orderBy('created_at', 'desc')->limit(10)->offset(1)->get();

        return view('login', [
            'mainNews' => $mainNews,
            'news' => $news,
            'categories' => $categories
        ]);
    }

    public function getRegister(){

        $categories = Category::all();

        $mainNews = News::orderBy('created_at', 'desc')->limit(1)->get()->first();

    	$news = News::orderBy('created_at', 'desc')->limit(10)->offset(1)->get();

        return view('register', [
            'mainNews' => $mainNews,
            'news' => $news,
            'categories' => $categories
        ]);
    }

    public function doRegister(Request $request): RedirectResponse{

        $validate = $request -> validate ([
            "name" => "required|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|min:6|max:255|confirmed",
            "password_confirmation" => "required|min:6|max:255"
        ]);

        $input = $request->only(['name','email', 'password']);
        $input['password'] = bcrypt($input['password']);

        $user = User::where('email', $input['email'])->get();

        if(!$user->isEmpty()){
            //error
            return redirect()->route('login');
        }

        $input['remember_token'] = Str::random(40);     //random remember token

        $createdUser = User::create($input);

        if($createdUser){
            $msg = "Thank you o r your registration, we have sent you an e-mail";

            $emailLink = $this->sendEmail($createdUser);

            $msg .= "</br> $emailLink";

            return view('auth.register-success')->with('msg', $msg);
        }
    }

    public function doLogin(Request $request): RedirectResponse{
        $validate = $request -> validate ([
            "email" => "required|email",
            "password" => "required|min:6|max:255"
        ]);

        $input = $request->only(['email', 'password']);

        $input['password'] = bcrypt($input['password']);

        $user = User::where(['email' => $input['email']])->first();
    }

    private function sendEmail($user)
    {
        return route('auth.register-confirm', ['id' => $user->id, 'token' => $user->remember_token]);
    }



}