<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class FlashSaleController extends Controller {
    public function flashSaleTimer() {
        $flash = FlashSale::find(1);

        return view('backend.flash-sale-timer', compact('flash'));
    }

    public function storeFlashSaleTimer(Request $request) {
        FlashSale::updateOrCreate(
            ['id' => 1],
            [
                'end' => $request->end,
            ]
        );

        return redirect()->back();
    }
}
