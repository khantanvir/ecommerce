<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $table = "product_attributes";

    public function main_product(){
        return $this->belongsTo(Product::class);
    }
}
