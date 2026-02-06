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

    public function showProfile()
    {
        $merchant = Auth::user()->merchant;
        return view('merchant.profile', compact('merchant'));
    }

    public function updateProfile(Request $request)
    {
        $merchant = Auth::user()->merchant;

        $request->validate([
            'company_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'description' => 'nullable',
        ]);

        $merchant->update($request->only(['company_name', 'contact', 'address', 'description']));

        return redirect()->route('merchant.dashboard')->with('success', 'Profil katering berhasil disimpan!');
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
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
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $path,
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan!');
    }

    public function editMenu($id)
    {
        $menu = Menu::where('id', $id)
                    ->where('merchant_id', Auth::user()->merchant->id)
                    ->firstOrFail();

        return view('merchant.edit_menu', compact('menu'));
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::where('id', $id)
                    ->where('merchant_id', Auth::user()->merchant->id)
                    ->firstOrFail();

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'price', 'description']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($menu->photo) {
                Storage::disk('public')->delete($menu->photo);
            }
            $data['photo'] = $request->file('photo')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('merchant.dashboard')->with('success', 'Menu berhasil diperbarui!');
    }

    public function deleteMenu($id)
    {
        $menu = Menu::where('id', $id)
                    ->where('merchant_id', Auth::user()->merchant->id)
                    ->firstOrFail();

        if ($menu->photo) {
            Storage::disk('public')->delete($menu->photo);
        }

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus!');
    }

    public function acceptOrder($id)
    {
        $order = Order::where('id', $id)
                    ->whereHas('menu', function($q) {
                        $q->where('merchant_id', Auth::user()->merchant->id);
                    })
                    ->where('status', 'pending')
                    ->firstOrFail();

        $order->update(['status' => 'accepted']);

        return back()->with('success', 'Pesanan telah diterima.');
    }

    public function completeOrder($id)
    {
        $order = Order::where('id', $id)
                    ->whereHas('menu', function($q) {
                        $q->where('merchant_id', Auth::user()->merchant->id);
                    })
                    ->whereIn('status', ['accepted', 'paid'])
                    ->firstOrFail();

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Pesanan telah diselesaikan.');
    }
}