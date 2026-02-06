<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Merchant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::with('merchant')->latest()->get();
        return view('landing', compact('menus'));
    }

    public function showMerchantProfile($id)
    {
        $merchant = Merchant::with('menus')->findOrFail($id);
        return view('merchant_profile', compact('merchant'));
    }
}
