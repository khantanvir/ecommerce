<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Attributes\Attribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

    }
    //create product 
    public function create_product(){
        $data['products'] = true;
        $data['create_product'] = true;
        $data['all_attribute'] = Attribute::where('status',0)->where('is_deleted',0)->get();
        return view('product/create',$data);
    }
    //all product 
    public function products(){
        $data['products'] = true;
        $data['all_product'] = true;
        return view('product/all',$data);
    }
}
