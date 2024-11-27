<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderItems')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        return view('orders.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',   
            'status' => 'required|in:pending,processed,shipped,delivered,canceled',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|integer|min:1',
            'order_items.*.price' => 'required|numeric',
        ]);

        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);

        foreach ($request->order_items as $item) {
            $order->orderItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
        
        return redirect()->route('orders.index')->with('success', 'Order beserta item berhasil ditambahkan!');
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }
    

    public function edit($id)
    {
        // Mencari order berdasarkan ID
        $order = Order::findOrFail($id);

        // Mengambil semua pengguna untuk form edit
        $users = User::all();
        
        return view('orders.edit', compact('order', 'users'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari pengguna
        $request->validate([
            'user_id' => 'required|exists:users,id',  // Pastikan pengguna ada di database
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,completed,canceled',
        ]);

        // Mencari order yang akan diupdate
        $order = Order::findOrFail($id);

        // Memperbarui data order
        $order->update([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Mencari order berdasarkan ID
        $order = Order::findOrFail($id);
        
        // Menghapus order beserta item-item terkait
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus!');
    }

    public function userOrders($userId)
    {
        // Mengambil semua order yang dimiliki oleh pengguna tertentu
        $orders = Order::where('user_id', $userId)->with('orderItems')->paginate(10);
        return view('orders.userOrders', compact('orders'));
    }

    public function addItem(Request $request, $orderId)
    {
        // Mencari order berdasarkan ID
        $order = Order::findOrFail($orderId);
        
        // Validasi item order
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        // Menambah item ke dalam order
        $order->orderItems()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect()->route('orders.show', $orderId)->with('success', 'Item berhasil ditambahkan ke order!');
    }
}
