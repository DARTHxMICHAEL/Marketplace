<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'currency_id',
        'show_phone',
    ];

    protected $casts = [
        'show_phone' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function photos()
    {
        return $this->hasMany(OfferPhoto::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)
        ->using(CategoryOffer::class)
        ->withTimestamps();
    }
}
