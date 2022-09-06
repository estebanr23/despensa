<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function itemsOrder() {
        return $this->hasMany('App\Models\ItemOrder');
    }

    public function provider() {
        return $this->belongsTo('App\Models\Provider');
    }
}
