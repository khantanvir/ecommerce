<?php

namespace App\Http\Controllers\Product;

use App\Helper\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Attributes\Attribute;
use App\Models\Category\Category;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Service;
    public function index(){

    }
    //create product 
    public function create_product(){
        $data['products'] = true;
        $data['create_product'] = true;
        $data['categories'] = Category::where('status',0)->where('is_deleted',0)->get();
        $data['all_attribute'] = Attribute::where('status',0)->where('is_deleted',0)->get();
        return view('product/create',$data);
    }
    //all product 
    public function products(){
        $data['products'] = true;
        $data['all_product'] = true;
        return view('product/all',$data);
    }
    //store product 
    public function store(ProductRequest $request){
        dd($request->all());
        $product = new Product();
        $product->title = $request->input('title');
        //make url
        $url_modify = Service::slug_create($request->input('title'));
        $checkSlug = Product::where('url', 'LIKE', '%' . $url_modify . '%')->count();
        if ($checkSlug > 0) {
            $new_number = $checkSlug + 1;
            $new_slug = $url_modify . '-' . $new_number;
            $product->url = $new_slug;
        } else {
            $product->url = $url_modify;
        }
        $product->short_description = $request->input('short_description');
        $product->description = $request->input('description');
        //main image upload

        $product_attribute_ids = $request->input('main_attribute_id');
        if(!empty($product_attribute_ids)){
            foreach($product_attribute_ids as $key=>$val){
                $product_attribute_values = $request->input('attribute_value_name'.$key);
                $value_name = '';
                foreach($product_attribute_values as $value){
                    $value_name .= $value.',';
                }
            }
            dd($value_name);
        }


    }
}
