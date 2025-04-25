<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Currency;

class OfferShowController extends Controller
{
    public function display($offerId)
    {
        $offer = Offer::where("id", $offerId)
                      ->firstOrFail();

        return view('offers.show', compact('offer'));
    }
}
