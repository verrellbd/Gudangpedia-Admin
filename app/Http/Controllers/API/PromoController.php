<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Promo;
use Illuminate\Http\Request;
use Throwable;

class PromoController extends Controller
{
    //
    public function list()
    {
        $list = Promo::where('promo_id', '!=', 0)->get();
        return response()->json(['success' => $list]);
    }

    public function detail($promo_id)
    {
        try {
            $detail = Promo::where('promo_id', $promo_id)->get();
            return response()->json(['success' => $detail]);
        } catch (Throwable $e) {
            return response()->json(['error' => 'Promo Detail Error']);
        }
    }

    public function search($code)
    {
        $promo = Promo::where('code', $code)->first();
        if ($promo) {
            return response()->json(['success' => $promo]);
        } else {
            return response()->json(['error' => 'Not Found Promo']);
        }
    }
}
