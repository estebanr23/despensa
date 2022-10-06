<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    use HasFactory;

    protected $table = 'items_status'; 
    public $timestamps = false;

    public function itemsOrder() {
        return $this->hasMany('App\Models\ItemOrder');
    }
}
