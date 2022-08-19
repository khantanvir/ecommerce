<?php

namespace App\Http\Controllers\Product;

use App\Helper\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Attributes\Attribute;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductAttribute;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        //dd($request->all());
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
        $product->category_id = $request->input('category_id');
        $product->status = 0;
        $product->is_deleted = 0;
        $product->stock_price = $request->input('stock_price');
        $product->selling_price = $request->input('selling_price');
        //main image upload
        $image = $request->file('main_image');
        if($request->hasFile('main_image')){
            
            $ext = $image->getClientOriginalExtension();
            $filename = $image->getClientOriginalName();
            $filename = rand(1000,100000).'.'.$ext;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(450,600);
            $image_resize->save(public_path('main/image/' .$filename));
            $product->image = $filename;
        }
        //more images upload
        $more_images = $request->file('more_images');
        if(!empty($more_images)){
            $daaimage = '';
            foreach($more_images as $key=>$more_image){
                $ext = $more_image->getClientOriginalExtension();
                $filename = $more_image->getClientOriginalName();
                $filename = rand(1000,100000).'.'.$ext;
                $image_resize = Image::make($more_image->getRealPath());
                $image_resize->resize(450,678);
                $image_resize->save(public_path('main/moreimages/' .$filename));
                if($key==0){
                    $daaimage .= $filename;
                }else{
                    $daaimage .= ','.$filename;
                }
            }
            $product->more_images = $daaimage;
        }
        $product->save();
        //attributes id //attribute item
        $quantities = $request->input('quantity');
        $stock_prices = $request->input('stock_price');
        $selling_prices = $request->input('selling_price');
        $attribute_size_values = $request->input('attribute_size_values');
        $attribute_color_values = $request->input('attribute_color_values');
        $dataquantity = 0;
        foreach($quantities as $key=>$quantity){
            $dataquantity+= $quantity;
            $product_attribute = new ProductAttribute();
            $product_attribute->quantity = $quantity;
            $product_attribute->product_id = $product->id;
            $product_attribute->size_attributes = $attribute_size_values[$key];
            $product_attribute->color_attributes = $attribute_color_values[$key];
            $product_attribute->stock_price = $stock_prices[$key];
            $product_attribute->selling_price = $selling_prices[$key];
            $product_attribute->save();
        }
        $update_product = Product::where('id',$product->id)->update(['total_stock'=>$dataquantity]);
        Session::flash('success','Product Data Saved Successfully!');
        Session::flash('product_id',$product->id);
        return redirect('products');

    }
    //all product list 
    public function all(){
        $data['products'] = true;
        $data['all_product'] = true;
        $data['list_products'] = Product::where('status',0)->where('is_deleted',0)->orderBy('id','desc')->paginate(10);
        return view('product/all',$data);
    }
}
