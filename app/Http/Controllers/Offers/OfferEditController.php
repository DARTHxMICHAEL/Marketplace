<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Category;
use App\Models\OfferPhoto;
use App\Models\CategoryOffer;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OfferEditController extends Controller
{

    use AuthorizesRequests;
    
    public function edit(Offer $offer)
    {
        $this->authorize('update', $offer);
        
        $currencies = Currency::all();
        $categories = Category::all();

        return view('offers.edit', compact('offer', 'currencies', 'categories'));
    }

    public function update(Request $request, Offer $offer)
    {
        //$this->authorize('update', $offer); // Add authorization if needed

        $validated = $request->validate([
            'title' => 'required|string|max:91',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'currency_id' => 'nullable|exists:currencies,id',
            'show_phone' => 'nullable|boolean',
            'visible' => 'nullable|boolean',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photos' => 'nullable|array|max:5',
            'existing_photos' => 'nullable|array',
            'existing_photos.*' => 'exists:offer_photos,id,offer_id,'.$offer->id,
        ]);

        DB::transaction(function () use ($validated, $request, $offer) {
            // Update offer
            $offer->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'currency_id' => $validated['currency_id'],
                'show_phone' => $request->has('show_phone'),
                'visible' => $request->has('visible'),
            ]);

            // Sync categories
            $offer->categories()->sync($validated['categories']);

            // Handle existing photos (delete unchecked ones)
            if ($request->has('existing_photos')) {
                $offer->photos()->whereNotIn('id', $validated['existing_photos'])->delete();
            } else {
                $offer->photos()->delete();
            }

            // Add new photos
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    $path = $photo->store('offers/photos', 'public');
                    $offer->photos()->create(['path' => $path]);
                }
            }
        });

        return redirect()->route('offers.list')->with('success', 'Offer updated successfully!');
    }
}
