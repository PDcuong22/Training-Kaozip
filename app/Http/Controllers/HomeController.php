<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $message = "Welcome to the Home Page!";
        $number = 1;
        return view('home', compact('message', 'number'));
    }

    public function about()
    {
        // DB::table('users')->where('id', 1)->update(['name' => 'John Updated']);
        $users = DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')->get();
        // dd($users); 
        $categories = DB::connection('sqlite')->table('categories')->get();
        return view('about', compact('users', 'categories'));
    }
}
