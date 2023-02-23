<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AccessController extends Controller{
    
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
            "email" => "required|email",
            "password" => "required|min:6|max:255|confirmed",
            "confirmPassword" => "required|min:6|max:255"
        ]);
    }

    public function doLogin(Request $request): RedirectResponse{
        $validate = $request -> validate ([
            "email" => "required|email",
            "password" => "required|min:6|max:255"
        ]);
    }
}