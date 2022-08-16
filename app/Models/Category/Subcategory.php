<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category\Category;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = "subcategories";

    public function get_category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
