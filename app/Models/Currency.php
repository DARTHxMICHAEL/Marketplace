<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    protected $fillable = [
        'code',
        'name',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
