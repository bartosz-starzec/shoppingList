<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name'];

    /**
     * @var string
     */
    private $name;

    public function shoppingListProducts()
    {
        return $this->belongsToMany(ShoppingList::class);
    }
}
