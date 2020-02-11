<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['name'];

    public function shoppingListProducts()
    {
        return $this->belongsToMany(ShoppingList::class);
    }
}
