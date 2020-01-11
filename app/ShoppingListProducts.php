<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingListProducts extends Model
{
    protected $fillable = ['shopping_list_id', 'product_id', 'amount'];
}
