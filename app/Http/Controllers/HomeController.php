<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::with('merchant')->latest()->get();
        return view('landing', compact('menus'));
    }
}
