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
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhereHas('merchant', function($mq) use ($search) {
                      $mq->where('address', 'like', "%{$search}%") 
                         ->orWhere('company_name', 'like', "%{$search}%");
                  });
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
            'delivery_address' => 'required|string',
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
            'delivery_address' => $request->delivery_address,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.orders')->with('success', 'Pesanan berhasil dibuat! Invoice: ' . $invoice);
    }
    
    
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('menu.merchant')->latest()->get();
        return view('customer.orders', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->firstOrFail();

        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function showInvoice($invoice_number)
    {
        $order = Order::where('invoice_number', $invoice_number)
                      ->with(['user', 'menu.merchant'])
                      ->firstOrFail();

        // Security check
        if (Auth::user()->role === 'customer' && $order->user_id !== Auth::id()) {
            abort(403);
        }
        if (Auth::user()->role === 'merchant' && $order->menu->merchant->id !== Auth::user()->merchant->id) {
            abort(403);
        }

        return view('invoice', compact('order'));
    }
}