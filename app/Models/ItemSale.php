<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    use HasFactory;

    protected $table = 'items_sales';

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function sale() {
        return $this->belongsTo('App\Models\Sale');
    }
}
