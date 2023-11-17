<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login(){
        return view('login');
    }

    public function home(){
        return view('home');
    }



}
