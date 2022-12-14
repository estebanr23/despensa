<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    use HasFactory;

    protected $table = 'items_orders';
    public $timestamps = false;
    protected $guarded = [];

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function status() {
        return $this->belongsTo('App\Models\ItemStatus');
    }
}
