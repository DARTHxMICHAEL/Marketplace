<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryOffer extends Model
{
    protected $table = 'category_offer';

    // If you need to add timestamps to the pivot table
    public $timestamps = true;

    // If you need to add fillable fields
    protected $fillable = [
        'offer_id',
        'category_id',
    ];
}
