<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\RatingReview;
use Illuminate\Http\Request;

class RatingReviewController extends Controller
{

    //frontend
    public function storeRatingReview(Request $request)
    {
        if ($request->rating === null && $request->review == null) {
            return redirect()->back()->withToastError('Nothing to review!!');
        }

        RatingReview::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        return redirect()->back()->withToastSuccess('Review added!!');
    }

    //backend
    public function showRatingReview()
    {
        $ratings = RatingReview::with('product','product.images','user')->orderBy('status', 'ASC')->get();

        return view('backend.rating-review', compact('ratings'));
    }

    public function activeRatingReview(RatingReview $rating)
    {
        $rating->status = 1;
        $rating->save();

        return redirect()->back()->withToastSuccess('Status updated successfully!!');
    }

    public function deleteRatingReview(RatingReview $rating)
    {
        $rating->delete();

        return redirect()->back()->withToastSuccess('Review deleted successfully!!');
    }
}
