<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    public function marketplace(Request $request)
{
    $query = Offer::with(['photos', 'currency', 'categories'])
        ->where('visible', true);

    // Search by title
    if ($search = $request->input('search')) {
        $query->where('title', 'like', '%' . $search . '%');
    }

    // Filter by category
    if ($categoryId = $request->input('category')) {
        $query->whereHas('categories', function ($q) use ($categoryId) {
            $q->where('categories.id', $categoryId);
        });
    }

    $offers = $query->paginate(9)->withQueryString(); // Keep filters across pages
    $categories = Category::all();

    return view('marketplace', compact('offers', 'categories'));
}
}
