<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferPhoto extends Model
{

    protected $fillable = [
        'offer_id',
        'path',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
