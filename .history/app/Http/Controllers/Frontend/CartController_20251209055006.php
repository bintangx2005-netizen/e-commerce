<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\FlareClient\Http\Response;

class CartController extends Controller
{
    public function view_cart()
    {
        if (Auth::check()) {
            $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            $carts = [];
            $cart_session = session()->get('carts', []);
            if (!empty($cart_session)) {
                $product_ids = array_keys($cart_session);
                $products = Product::whereIn('id', $product_ids)->get();
                foreach ($products as $product) {
                    $carts[] = (object)[
                        'product_id' => $product->id,
                        'qty' => 1,
                        'product' => $product
                    ];
                }
            }
        }
        $total_amount = 0;
        foreach ($carts as $cart) {
            $total_amount += $cart->product->selling_price;
        }
        
        return view('frontend.cart', compact('carts', 'total_amount'));
    }

    public function get_carts_data()
    {
        $products_id = [];
        if (Auth::check()) {
            $products_id =  Cart::pluck('product_id')->toArray();
        } else {
            $carts =  session()->get('carts', []);
            foreach ($carts as $cart) {
                $product_id = (int)$cart['product_id'];
                $products_id[] = $product_id;
            }
        }
        $all_cart_products = Product::select('id', 'thumbnail', 'product_name', 'selling_price')->whereIn('id', $products_id)->latest('id')->limit(3)->get();
        $total_count = count($products_id);
        $total_amount =  $all_cart_products->sum('selling_price');
        $public_path = url('uploaded/product');
        return response()->json(['allProducts' => $all_cart_products, 'totalCount' => $total_count, 'totalAmount' => $total_amount, 'url' => $public_path], 200);
    }

    public function add_to_cart($id)
    {
        if (Auth::check()) {
            Cart::updateOrCreate(
                ['product_id' => $id],
                [
                    'product_id' => $id,
                    'user_id' => Auth::id()
                ]
            );

            return response()->json(['message' => 'Successfully Adeed!'], 200);
        }
        $carts = session()->get('carts', []);
        if (isset($carts[$id])) {
            return response()->json(['message' => 'Item alread added in cart'], 200);
        }
        $carts[$id] = ['product_id' => $id];
        session()->put('carts', $carts);
        return response()->json(['message' => 'Successfully Added to The Cart'], 200);
    }


    public function remove_from_cart($id)
    {
        if (Auth::check()) {
            $cart_item = Cart::where('product_id', $id)->first();
            $cart_item->delete();
            return response()->json(['message' => "Deleted Successfully!"], 200);
        }
        $carts = session()->get('carts');
        if (isset($carts[$id])) {
            unset($carts[$id]);
            session()->put('carts', $carts);
            return response()->json(['message' => "Deleted Successfully!"], 200);
        }
    }
}
