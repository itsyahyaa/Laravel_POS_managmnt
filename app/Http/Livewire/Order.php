<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class Order extends Component
{

    public $orders;
    public $products = [];
    public $productInCart;
    public $product_code;
    public $pay_money = '';
    public $balance = '';

    public function mount()
    {
        $this->products = Product::all();
        $this->productInCart = Cart::all();
    }

    public function InsertIntoCart()
    {

        $countProduct = Product::where('id', $this->product_code)->first();
        if (!$countProduct) {
            return session()->flash('error', 'Product Not found');
        }

        $countCartProduct = Cart::where('product_id', $this->product_code)->count();
        if ($countCartProduct > 0) {
            return session()->flash('error', 'Product ' . $countProduct->product_name . ' Already Exist in the Cart Place please add quantity');
        }

        $add_to_cart = new Cart;
        $add_to_cart->product_id = $countProduct->id;
        $add_to_cart->product_qty = 1;
        $add_to_cart->product_price = $countProduct->price;
        $add_to_cart->product_total = $countProduct->price;
        $add_to_cart->user_id = Auth()->user()->id;
        $add_to_cart->save();

        $this->product_code = '';

        $this->productInCart->prepend($add_to_cart); // push will add from the back and prepend at the frnon of the list

        // dd($countProduct);

        return session()->flash('success', 'Product Added successfully');
    }

    public function removeProduct($cart_id)
    {
        $deletecart = Cart::find($cart_id);
        $deletecart->delete();
        // $this->message = "Product Deleted Successfully";
        session()->flash('error', 'Product Deleted from Cart Successfully');
        $this->productInCart = $this->productInCart->except($cart_id); // delete element from table without refresh

    }

    public function InrementQty($cart_id)
    {
        // dd(222);
        $carts = Cart::find($cart_id);
        $carts->increment('product_qty', 1);
        $updatePrice = $carts->product_qty * $carts->product_price;
        $carts->update(['product_total' => $updatePrice]);
        $this->mount();
    }

    public function DecrementQty($cart_id)
    {
        // dd(333);
        $carts = Cart::find($cart_id);
        if ($carts->product_qty == 1) {
            return session()->flash('info', 'Product ' . $carts->product->product_name . ' Quantity can not be less than 1 add or remove from the product in cart');
        }
        $carts->decrement('product_qty', 1);
        $updatePrice = $carts->product_qty * $carts->product_price;
        $carts->update(['product_total' => $updatePrice]);
        $this->mount();
    }

    public function render()
    {
        if ($this->pay_money != '') {
            $totalamount = (int) $this->pay_money - $this->productInCart->sum('product_total');
            $this->balance = $totalamount;
        }

        return view('livewire.order');
    }

    public function GetBarCode()
    {
        # code...
        $productBarCode = Product::select('barcode', 'product_code')->get();
        return view('products.barcode', compact('productBarCode'));
    }
}