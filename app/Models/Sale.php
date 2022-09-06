<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function itemsSale() {
        return $this->hasMany('App\Models\ItemSale');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
