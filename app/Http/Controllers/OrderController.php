<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        
        $query = Menu::with('merchant');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('merchant', function($q) use ($search) {
                      $q->where('address', 'like', "%{$search}%") 
                        ->orWhere('company_name', 'like', "%{$search}%");
                  });
        }

        $menus = $query->get();

        return view('customer.dashboard', compact('menus'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after:today',
        ]);

        $menu = Menu::find($request->menu_id);
        $totalPrice = $menu->price * $request->quantity;

        
        $invoice = 'INV-' . time() . '-' . Auth::id();

        Order::create([
            'invoice_number' => $invoice,
            'user_id' => Auth::id(),
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'delivery_date' => $request->delivery_date,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.orders')->with('success', 'Pesanan berhasil dibuat! Invoice: ' . $invoice);
    }
    
    
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('menu.merchant')->latest()->get();
        return view('customer.orders', compact('orders'));
    }
}