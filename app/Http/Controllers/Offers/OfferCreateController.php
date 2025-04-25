<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Currency;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferPhoto;
use App\Models\CategoryOffer;

class OfferCreateController extends Controller
{
    public function create()
    {
        $currencies = Currency::all();
        $categories = Category::all();

        return view('offers.create', compact(['currencies','categories']));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:91',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'currency_id' => 'nullable|exists:currencies,id',
            'show_phone' => 'nullable|boolean',
            'visible' => 'nullable|boolean',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB per file
            'photos' => 'nullable|array|max:5',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $offer = Offer::create([
                'user_id' => auth()->id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'currency_id' => $validated['currency_id'],
                'show_phone' => $request->has('show_phone'),
                'visible' => $request->has('visible'),
            ]);

            foreach($validated['categories'] as $categoryId)
            {
                CategoryOffer::create([
                    'offer_id' => $offer->id,
                    'category_id' => $categoryId,
                ]);
            }

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('offers/photos', 'public');
    
                    OfferPhoto::create([
                        'offer_id' => $offer->id,
                        'path' => $path,
                    ]);
                }
            }
        });

        return redirect()->route('offers.list')->with('success', 'Offer created successfully!');
    }
}
