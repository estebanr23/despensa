<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Provider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products() {
        return $this->BelongsToMany('App\Models\Product');
    }

    public function orders() {
        return $this->hasMany('App\Models\Order');
    }
}
