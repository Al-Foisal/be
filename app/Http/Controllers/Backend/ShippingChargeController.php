<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingChargeController extends Controller
{
    public function showShippingCharge()
    {
        $ship = ShippingCharge::find(1);

        return view('backend.shipping-charge', compact('ship'));
    }

    public function storeShippingCharge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inside' => 'required',
            'outside' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        ShippingCharge::updateOrCreate(
            ['id' => 1],
            [
                'inside' => $request->inside,
                'outside' => $request->outside,
            ]
        );

        return redirect()->route('admin.showShippingCharge')->withToastSuccess('Shipping Added Successfully!!');
    }
}
