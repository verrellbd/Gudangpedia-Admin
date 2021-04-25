<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Review;
use App\Transaction;
use Illuminate\Http\Request;
use Throwable;

class ReviewController extends Controller
{
    //
    public function create(Request $request)
    {
        try {
            $review = new Review;
            $review->storage_id = $request->storage_id;
            $review->description = $request->description;
            $review->rate = $request->rate;
            $review->save();

            $transaction = Transaction::where('transaction_id', $request->transaction_id);
            $transaction->review_state = 1;
            $transaction->save();
            return response()->json(['success' => 'Review Successs']);
        } catch (Throwable $e) {
            return response()->json(['error' => 'You cannot write review']);
        }
    }

    public function list($storage_id)
    {
        $list =  Review::where('storage_id', $storage_id)->get();
        if ($list) {
            return response()->json(['success' => $list]);
        } else {
            return response()->json(['error' => 'No Review for This Storage']);
        }
    }
}
