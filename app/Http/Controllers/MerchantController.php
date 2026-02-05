<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{
    public function index()
    {

        $merchant = Auth::user()->merchant;
        
        $menus = $merchant->menus;

        $orders = Order::whereIn('menu_id', $menus->pluck('id'))
                        ->with(['user', 'menu']) 
                        ->latest()
                        ->get();

        return view('merchant.dashboard', compact('merchant', 'menus', 'orders'));
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('menus', 'public');
        }

        Menu::create([
            'merchant_id' => Auth::user()->merchant->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $path,
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan!');
    }
}