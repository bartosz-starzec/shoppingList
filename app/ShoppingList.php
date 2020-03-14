<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShoppingList extends Model
{
    protected $fillable = ['name'];
    protected $with = ['products'];

    /**
     * @var string
     */
    private $name;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
