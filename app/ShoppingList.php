<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingList extends Model
{
    protected $fillable = ['name'];
    protected $with = ['products'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
