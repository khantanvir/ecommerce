<?php

namespace App\Models\Attributes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attributes\Attribute;

class AttributeValue extends Model
{
    use HasFactory;
    protected $table = "attribute_values";

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
