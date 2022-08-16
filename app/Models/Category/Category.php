<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $tabe = "categories";

    public function all_subcategory(){
        return $this->hasMany(Subcategory::class);
    }
}
