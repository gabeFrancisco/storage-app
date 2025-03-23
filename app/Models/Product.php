<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'quantity',
        'price'
    ];
    public function category()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }
}
