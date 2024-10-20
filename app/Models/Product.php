<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = ['subcategory_id', 'product_type', 'condition', 'seller_type', 'location', 'radius', 'price'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
