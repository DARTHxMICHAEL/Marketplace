<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Currency;

class OfferListController extends Controller
{
    public function display()
    {
        $userOffers = Offer::where("user_id", auth()->user()->id)->get();

        return view('offers.list', compact('userOffers'));
    }

    public function marketplace()
    {
        $offers = Offer::where("visible", true)->get();

        return view('marketplace', compact('offers'));
    }
}
