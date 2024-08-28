<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\UserAddress;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller {
    public function cancelOrder() {
        $orders = Order::where('status', 0)->orderBy('id', 'DESC')->get();

        return view('backend.order.cancel-order', compact('orders'));
    }

    public function pendingOrder() {
        $orders = Order::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('backend.order.pending-order', compact('orders'));
    }

    public function orderConfirmForCustomer(Request $request, $id) {
        $order = Order::find($id);
        $order->update(['status' => 2]);

        return redirect()->back()->withToastSuccess('Order Confirmed!!');
    }

    public function confirmOrder() {
        $orders = Order::where('status', 2)->orderBy('id', 'DESC')->get();

        return view('backend.order.confirm-order', compact('orders'));
    }

    public function orderShippedForCustomer(Request $request, $id) {
        $order = Order::find($id);
        $order->update(['status' => 3]);

        return redirect()->back()->withToastSuccess('Order Shipped!!');
    }

    public function shippedOrder() {
        $orders = Order::where('status', 3)->orderBy('id', 'DESC')->get();

        return view('backend.order.shipped-order', compact('orders'));
    }

    //invoice
    public function invoice($id) {
        $data          = [];
        $data['order'] = $check = Order::with('orderProducts')->where('id', $id)->where('status', '!=', 0)->first();

        if (!$check) {
            return redirect()->back()->withToastError('Invalid Order Invoice!!');
        }

        $data['subtotal'] = ($check->total_price + $check->discount) - ($check->shipping_charge + $check->additional_charge);

        return view('backend.invoice', $data);
    }

    //frontend
    public function placeOrder(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required',
            'city'     => 'required',
            'area'     => 'required',
            'address'  => 'required',
            'shipping' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

// $address = UserAddress::where('user_id', Auth::id())->first();
        // $ship = Shipping::find(1);
        $carts = Cart::content();

        UserAddress::updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => auth()->user()->email,
            'city'     => $request->city,
            'area'     => $request->area,
            'zip_code' => $request->zip_code,
            'address'  => $request->address,
            'user_id'  => auth()->user()->id,
        ]);

        if ($request->payment_number_bkash !== null && $request->trx_id_bkash !== null) {
            $payment_type   = $request->payment_type;
            $payment_number = $request->payment_number_bkash;
            $trx_id         = $request->trx_id_bkash;
        } elseif ($request->payment_number_rocket !== null && $request->trx_id_rocket !== null) {
            $payment_type   = $request->payment_type;
            $payment_number = $request->payment_number_rocket;
            $trx_id         = $request->trx_id_rocket;
        } elseif ($request->payment_number_nagad !== null && $request->trx_id_nagad !== null) {
            $payment_type   = $request->payment_type;
            $payment_number = $request->payment_number_nagad;
            $trx_id         = $request->trx_id_nagad;
        } else {
            $payment_type   = $request->payment_type;
            $payment_number = null;
            $trx_id         = null;
        }

        $order = Order::create([
            'shipping_charge'   => $request->shipping,
            'additional_charge' => $request->additional_charge,
            'coupon_code'       => $request->coupon_code,
            'coupon_discount'   => $request->coupon_discount,

            'discount_price'    => $request->discount_price,
            'total_price'       => $request->total_price,
            'subtotal_price'    => $request->subtotal_price,
            'paid_amount'       => $request->paid_amount,

            'payment_type'      => $payment_type,
            'payment_number'    => $payment_number,
            'trx_id'            => $trx_id,

            'name'              => $request->name,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'city'              => $request->city,
            'area'              => $request->area,
            'zip_code'          => $request->zip_code,
            'address'           => $request->address,

            'user_id'           => auth()->user()->id,
            'status'            => 1,
        ]);

        foreach ($carts as $cart) {
            OrderProduct::create([
                'order_id'   => $order->id,
                'product_id' => $cart->id,
                'qty'        => $cart->qty,
                'unit_price' => $cart->price,
            ]);

            $product          = Product::find($cart->id);
            $updated_quantity = $product->quantity - $cart->qty;
            $product->update([
                'quantity' => $updated_quantity <= 0 ? 0 : $updated_quantity,
            ]);

        }

        Cart::destroy();
        Session::forget('coupon');
        Session::forget('voucher');
        Session::forget('paid_amount');
        Session::forget('ship');

        return redirect()->route('home')->withToastSuccess('Your order has been placed successfully!!');
    }

    public function customerOrderHistory() {
        $second_header = true;
        $orders  = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('frontend.user.order-history', compact('orders', 'second_header'));
    }

    public function customerCancelOrder(Request $request, $id) {
        $order = Order::find($id);

        if ($order->status == 1) {
            $order->update(['status' => 0]);

            return redirect()->back()->withToastSuccess('Order Canceled Successfully!!');
        }

        return redirect()->back()->withToastError('Order Cancelation is not Possible!!');
    }

    public function customerInvoice($id) {
        $data            = [];
        $data['second_header'] = true;
        $data['order']   = $check   = Order::with('orderProducts')->where('id', $id)->where('user_id', auth()->user()->id)->where('status', '!=', 0)->first();

        if (!$check) {

// auth()->logout();
            // return redirect()->route('shop')->withToastError('Invalid Access!!');
        }

        $data['subtotal'] = ($check->total_price + $check->discount) - ($check->shipping_charge + $check->additional_charge);

        return view('frontend.user.invoice', $data);
    }

}
