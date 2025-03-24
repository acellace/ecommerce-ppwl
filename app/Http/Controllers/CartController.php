<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    // Tampilkan isi keranjang user
    public function index(): View
    {
        $cartItems = Cart::with('product')
                 ->where('user_id', Auth::user()?->id)
                 ->get();
        return view('carts.index', compact('cartItems'));
    }

    // Tambahkan produk ke keranjang
   public function add(Request $request, Product $product): RedirectResponse
{
    $cart = Cart::where('user_id', Auth::user()?->id)
        ->where('product_id', $product->id)
        ->first();

    if ($cart) {
        $cart->increment('quantity');
    } else {
        Cart::create([
            'user_id' =>Auth::user()?->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
}


    // Update quantity produk di keranjang
    public function update(Request $request, Cart $cart): RedirectResponse
    {
        // Pastikan cart milik user yang sedang login
        if ($cart->user_id != Auth::user()?->id) {
            abort(403);
        }
        $cart->update(['quantity' => $request->input('quantity')]);
        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    // Hapus produk dari keranjang
    public function remove(Cart $cart): RedirectResponse
    {
        if ($cart->user_id != Auth::user()?->id) {
            abort(403);
        }
        $cart->delete();
        return redirect()->back()->with('success', 'Produk di keranjang berhasil dihapus.');
    }
}
