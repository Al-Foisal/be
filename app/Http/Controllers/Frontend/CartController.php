<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Voucher;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {
    public function cart() {

        if (Cart::count() == 0) {
            return redirect()->back();
        }

        $data                  = [];
        $data['second_header'] = true;

        $data['carts'] = $carts = Cart::content();

        $additional_charge = 0;
        $total             = 0;

//calculating total price without discount and additional charge
        foreach ($carts as $charge) {
            $total += $charge->options->oreginal_price * $charge->qty;
            if ($charge->options->additional_charge) {
                $additional_charge += $charge->options->additional_charge * $charge->qty;
            }

        }

        $data['total']             = $total;
        $data['additional_charge'] = $additional_charge;
        $data['subtotal']          = $subtotal          = Cart::subtotal();
        $data['discount']          = $discount          = $total - $subtotal;
        $data['paid_amount']       = ($subtotal + $additional_charge);

        Session::put(['paid_amount' => $data['paid_amount']]);

        if (session()->has('coupon')) {

            // $data['subtotal'] = $subtotal - Session::get('coupon')['discount'];

            $data['paid_amount'] = ($subtotal + $additional_charge) - (Session::get('coupon')['discount']);

            Session::put(['paid_amount' => $data['paid_amount']]);

        }

// dd($data);

        return view('frontend.cart', $data);
    }

    public function addToCart(Request $request) {
        $data         = [];
        $product      = Product::where('id', $request->id)->with('images')->first();
        $data['id']   = $product->id;
        $data['name'] = $product->name;
        $data['qty']  = $request->quantity;

        if ($product->discount == null) {
            $data['price'] = $product->selling;
        } else {
            $data['price'] = $product->discount_price;
        }

        $data['weight']                       = 1;
        $data['options']['image']             = $product->images->first()->image;
        $data['options']['size']              = $request->size;
        $data['options']['color']             = $request->color;
        $data['options']['additional_charge'] = $product->additional_charge;
        $data['options']['oreginal_price']    = $product->selling;

        Cart::add($data);

        return response()->json([
            'status'       => 'success',
            'cart_count'   => Cart::count(),
            'cart_content' => Cart::content(),
        ]);
    }

    public function updateCart(Request $request) {
        $row = [];

        foreach ($request->row_id as $key => $row) {
            $rowId = $row;
            $qty   = $request->quantity[$key];
            Cart::update($rowId, $qty);
        }

        return redirect()->back()->withToastSuccess('Cart updated successfully!!');
    }

    public function removeFromCart($rowId) {
        Cart::remove($rowId);

        return redirect()->back()->withToastSuccess('product remove from cart successfully!!');
    }

    public function destroyCart() {
        Cart::destroy();

        return redirect()->back()->withToastSuccess('Cart destroyed successfully!!');
    }

//coupon

    public function applyCoupon(Request $request) {

        $coupon_code = $request->coupon_code;

        $check = Coupon::where('coupon_code', $coupon_code)->first();

        if (!$check) {
            return redirect()->back()->withToastInfo('No coupon find for this code!!');
        }

        if ($check->coupon_date <= today()) {

            return redirect()->back()->withToastError('Coupon Date Has Been Expaired!!');

        }

        if ($check->coupon_type == 1) {

            Session::put('coupon', [

                'code'     => $check->coupon_code,

                'discount' => ceil((Cart::subtotal() * $check->coupon_discount) / 100),

            ]);

        } else

        if ($check->coupon_type == 2) {

            Session::put('coupon', [

                'code'     => $check->coupon_code,

                'discount' => $check->coupon_discount,

            ]);

        }

        return redirect()->back()->withToastSuccess('Coupon Applied Successfully!!');

    }

    public function removeCoupon() {

        Session::forget('coupon');

        return redirect()->back()->withToastSuccess('Coupon Removed Successfully!!');
    }

    public function addshippingCharge(Request $request) {
        Session::put(['ship' => $request->ship]);
        $total = Session::get('paid_amount') + $request->ship;

        return response()->json(['status' => 'success', 'total' => $total]);
    }

    public function applyVoucher(Request $request) {
        $voucher = Voucher::find($request->id);

        Session::put('voucher', [
            'offer'       => $voucher->offer_amount,
            'min_amount'  => $voucher->min_amount,
        ]);

        return response()->json(['status' => 2]);

    }

}
