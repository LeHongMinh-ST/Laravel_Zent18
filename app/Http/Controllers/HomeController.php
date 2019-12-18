<?php

namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function page($page)
    {
        return 'Page: ' . $page;
    }
}
