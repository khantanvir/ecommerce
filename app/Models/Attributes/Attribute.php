<?php

namespace App\Models\Attributes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attributes\AttributeValue;

class Attribute extends Model
{
    use HasFactory;
    protected $table = "attributes";
    public $timestamps = false;

    public function attribute_value(){
        return $this->hasMany(AttributeValue::class);
    }
}
