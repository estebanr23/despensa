<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function providers() {
        return $this->belongsToMany('App\Models\Provider');
    }

    public function itemsOrder() {
        return $this->hasMany('App\Models\ItemOrder');
    }

    public function itemsSale() {
        return $this->hasMany('App\Models\ItemSale');
    }
}
