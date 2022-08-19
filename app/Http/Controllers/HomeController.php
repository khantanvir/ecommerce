<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data['page_title'] = 'Ecommerce | Home';
        return view('userhome/index',$data);
    }
    public function mens(){
        $data['page_title'] = 'Ecommerce | Men';
        $data['mens_item'] = Product::where('category_id',1)->paginate(10);
        return view('userhome/men',$data);
    }
    public function womens(){
        $data['page_title'] = 'Ecommerce | Women';
        $data['womens_item'] = Product::where('category_id',2)->paginate(10);
        return view('userhome/women',$data);
    }
    public function details($url=NULL){
        $data['page_title'] = 'Home | Details';
        $data['details'] = Product::where('url',$url)->first();
        return view('userhome/details',$data);
    }
    //add to cart code
    public function add_to_cart(Request $request){
        //Session::forget('cart');
        //return;
        $quantity = $request->input('quantity');
        $product_url = $request->input('product_url');
        $check = Product::where('url',$product_url)->where('status',0)->where('is_deleted',0)->first();
        if(empty($check)){
            $data['result'] = array(
                'key' =>102,
                'val' => 'Product Data Not Found!'
            );
            return response()->json($data,200);
        }
        //insert first product
        $products[] = array(
            'product_id' => $check->id,
            'quantity' => $quantity,
            'price' => $check->selling_price,
            'sub_total' => $quantity * $check->selling_price
        );
        $getSessionData = Session::get('cart');
        if(!empty($getSessionData)){
            $getUpdateCart = array();
            foreach($getSessionData as $row){
                if($row['product_id']==$check->id){
                    $update_quantity = $row['quantity'] + $quantity;
                    $row1[] = array(
                        'product_id' => $check->id,
                        'quantity' => $update_quantity,
                        'price' => $check->selling_price,
                        'sub_total' => $update_quantity * $check->selling_price
                    );
                    $getUpdateCart = $this->update_cart($row1,$check->id);
                    Session::forget('cart');
                    Session::put('cart',$getUpdateCart);
                    $getSessionData = Session::get('cart');
                    $data['result'] = array(
                        'key' =>200,
                        'count' => count($getSessionData),
                        'val' => Session::get('cart')
                    );
                    return response()->json($data,200);
                }
            }
            $m = array_merge($getSessionData,$products);
            Session::forget('cart');
            Session::put('cart',$m);
            $data['result'] = array(
                'key' =>200,
                'count' => count(Session::get('cart')),
                'val' => Session::get('cart')
            );
            return response()->json($data,200);
        }else{
            Session::forget('cart');
            Session::put('cart',$products);
        }
        $getSessionData = Session::get('cart');
        $data['result'] = array(
            'key' =>200,
            'count' => count($getSessionData),
            'val' => Session::get('cart')
        );
        return response()->json($data,200);

    }
    public function update_cart($arr=array(),$id){
        if(!empty($arr) && !empty($id)){
            $getSessionData = Session::get('cart');
            if(!empty($getSessionData)){
                $values = array();
                foreach($getSessionData as $key => $row){
                    if($row['product_id']==$id){
                        if(false !== $key){
                            unset($getSessionData[$key]);
                        }
                    }else{
                        $values[] = $row;
                    }
                }
                $m = array_merge($values,$arr);
                return $m;
            }
        }
    }
    //this code is for view cart function
    public function view_cart(){
        $data['carts'] = Session::get('cart');
        if(empty($data['carts'])){
            Session::flash('error', 'Product Not I cart!');
            return redirect('mens');
        }
        $data['page_title'] = 'Cart | List';
        return view('userhome/view_cart',$data);
    }
    //this code is for remove product from cart
    public function remove_from_cart_page($id=NULL){
        if(empty($id)){
            return redirect('view-cart');
        }
        $check = Product::where('id',$id)->first();
        if(!empty($check)){
            $getSessionData = Session::get('cart');
            $values = array();
            if(!empty($getSessionData)){
                foreach($getSessionData as $key => $row){
                    if($check->id == $row['product_id']){
                        unset($getSessionData[$key]);
                    }else{
                        $values[] = $row;
                    }
                }
                Session::forget('cart');
                Session::put('cart',$values);
                return redirect('view-cart');
            }else{
                Session::flash('error', 'Product Not In Cart Right Now!');
                return redirect('view-cart');
            }
        }else{
            Session::flash('error', 'Product Data Not Found!');
            return redirect('view-cart');
        }

    }
}
