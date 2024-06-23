<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $list_cart = session('carts', []);
        $total_price = 0;
    
        foreach ($list_cart as $item) {
            $total_price += $item['price'] * $item['qty'];
        }
    
        return view('frontend.cart', compact('list_cart', 'total_price'));
    }
    

    public function addcart(Request $request)
    {
        $productid = $request->input('productid');
        $qty = $request->input('qty');
        $product = Product::find($productid);
        $cartitem = array(
            'id' => $productid,
            'image' => $product->image,
            'name' => $product->name,
            'price' => ($product->pricesale > 0) ? $product->pricesale : $product->price,
            'qty' => $qty
        );

        // Lưu vào session dạng mảng 2 chiều
        $carts = session('carts', []);
        $message = 'Đã thêm sản phẩm vào giỏ hàng';

        if (is_array($carts) && count($carts) == 0) {
            array_push($carts, $cartitem);
            session(['carts' => $carts]);
        } else {
            $check = true;
            foreach ($carts as $key => $item) {
                if (in_array($productid, $item)) {
                    $carts[$key]['qty'] += $qty;
                    $message = 'Đã cập nhật số lượng sản phẩm trong giỏ hàng';
                    $check = false;
                    break;
                }
            }

            if ($check == true) {
                array_push($carts, $cartitem);
            }
            session(['carts' => $carts]);
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'total_items' => count($carts)
            ]);
        }

        return count($carts);
    }

    
}
