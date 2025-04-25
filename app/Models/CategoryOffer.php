<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class CategoryOffer extends Pivot 
{
    protected $table = 'category_offer';

    // If you need to add timestamps to the pivot table
    public $timestamps = true;

    // If you need to add fillable fields
    protected $fillable = [
        'offer_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
