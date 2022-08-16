<?php

namespace Database\Seeders\Attribute;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attributes\Attribute;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = "size(s/m/l),color,size(xl/xs),design,weight,size(30/32/34)";
        $array = explode(",",$str);
        foreach($array as $row){
            Attribute::create([
                'name'=>$row
            ]);
        }
        
    }
}
