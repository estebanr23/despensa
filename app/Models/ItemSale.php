<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    use HasFactory;

    protected $table = 'items_sales';
    public $timestamps = false;

    // protected $fillable = ['product_id', 'cant_sale_prod', 'total_item', 'sale_id'];
    protected $guarded = [];

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function sale() {
        return $this->belongsTo('App\Models\Sale');
    }
}
