<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller {
    public function wishlist() {

        if (!Auth::check()) {
            return redirect()->back()->withToastError('Please login first!');
        }

        $second_header = true;
        $wishlists     = Wishlist::where('user_id', auth()->user()->id)->get();

        return view('frontend.user.wishlist', compact('wishlists', 'second_header'));
    }

    public function addToWishlist(Request $request) {

        if (Auth::check()) {
            $check = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $request->id)->first();

            if ($check) {
                return response()->json(['status' => 1]);
            } else {
                Wishlist::create([
                    'user_id'    => auth()->user()->id,
                    'product_id' => $request->id,
                ]);
                $count = Wishlist::where('user_id', auth()->user()->id)->count();

                return response()->json(['status' => 2, 'wishlist_count' => $count]);
            }

        } else {
            return response()->json(['status' => '3']);
        }

    }

    public function removeFromWishlist($id) {
        $wishlist = Wishlist::where('id', $id)->where('user_id', auth()->user()->id)->first();

        if (!$wishlist) {
            return redirect()->back()->withToastError('Invalid attempt!!');
        }

        $wishlist->delete();

        return redirect()->back()->withToastSuccess('Product removed form wishlist!!');
    }

}
