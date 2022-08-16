<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category\Category;
use App\Helper\Service;
use App\Http\Requests\Attribute\AttributeRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Attributes\Attribute;
use App\Models\Attributes\AttributeValue;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\Category\SubcategoryRequest;
use App\Models\Category\Subcategory;

class CategoryController extends Controller{
    use Service;
    public function index(){
        
    }
    public function add_category($id=NULL){
        $data['page_title'] = 'Category | Crate Category';
        $data['categories'] = true;
        $data['create_category'] = true;
        if(!empty($id)){
            $data['category'] = Category::where('id',$id)->first();
            if(empty($data['category'])){
                Session::flash('error','Catagory Data Not Found!');
                return redirect('all-category');
            }
        }
        return view('category/createCategory',$data);
    }
    //all category list
    public function all_category(){
        $data['page_title'] = 'Category | All Category';
        $data['categories'] = true;
        $data['all_category'] = true;
        $data['categories'] = Category::where('is_deleted',0)->orderBy('id','desc')->paginate(1);
        return view('category/allCategory',$data);
    }
    //add subcategory
    public function add_subcategory($id=NULL){
        $data['page_title'] = 'Category | Create Subcategory';
        $data['categories'] = true;
        $data['create_subcategory'] = true;
        $data['sub_category'] = Subcategory::find($id);
        $data['all_categories'] = Category::where('status',0)->where('is_deleted',0)->get();
        return view('category/createSubcategory',$data);
    }
    //store subcategry
    public function store_subcategory(SubcategoryRequest $request){
        $subcatagory_id = $request->input('subcategory_id');
        if(!empty($subcatagory_id)){
            $subcatagory = Subcategory::where('id',$subcatagory_id)->first();
        }else{
            $subcatagory = new Subcategory();
        }
        $subcatagory->title = $request->input('title');
        $subcatagory->description = $request->input('description');
        $subcatagory->category_id = $request->input('category_id');
        //url modify
        if(empty($subcatagory_id)){
            $url_modify = Service::slug_create($request->input('title'));
            $checkSlug = Subcategory::where('url', 'LIKE', '%' . $url_modify . '%')->count();
            if ($checkSlug > 0) {
                $new_number = $checkSlug + 1;
                $new_slug = $url_modify . '-' . $new_number;
                $subcatagory->url = $new_slug;
            } else {
                $subcatagory->url = $url_modify;
            }
        }
        $subcatagory->save();
        Session::flash('subcategory_id',$subcatagory->id);
        Session::flash('success',(!empty($subcatagory_id))?'Subcatagory data Updated successfully':'Subcatagory data Saved Successfully');
        return redirect('all-subcategory');
    }
    //all subcategory
    public function all_subcategory(){
        $data['page_title'] = 'Category | All Subcategory';
        $data['categories'] = true;
        $data['all_subcategory'] = true;
        $data['current'] = URL::full();
        Session::put('current_url',$data['current']);
        $data['subcategories'] = Subcategory::where('is_deleted',0)->orderBy('id','desc')->paginate(1);
        return view('category/allSubcategory',$data);
    }
    //subcategory status change 
    public function subcategory_status_change(Request $request){
        $subcategory_id = $request->input('subcategory_id');
        $subcategory = Subcategory::find($subcategory_id);
        if(empty($subcategory)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Subcategory Data Not Found!'
            );
            return response()->json($data,200);
        }
        $update = Subcategory::where('id',$subcategory->id)->update(['status'=>$request->input('status')]);
        $data['result'] = array(
            'key'=>200,
            'val'=>'Subcategory Updated!'
        );
        return response()->json($data,200);
    }
    //rollback subcategory data
    public function roll_back_subcategory_status(Request $request){
        $subcategoryValue = Subcategory::find($request->input('subcategory_id'));
        if(empty($subcategoryValue)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Subcategory Data Not Found'
            );
            return response()->json($data,200);
        }
        $delete = Subcategory::where('id',$subcategoryValue->id)->update(['is_deleted'=>$request->input('is_deleted')]);
        $data['result'] = array(
            'key'=>200,
            'val'=>'Subcategory Value Roll Back Successfully'
        );
        return response()->json($data,200);
    }
    //roll back category data
    public function roll_back_category_status(Request $request){
        $categoryValue = Category::find($request->input('category_id'));
        if(empty($categoryValue)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Category Data Not Found'
            );
            return response()->json($data,200);
        }
        $delete = Category::where('id',$categoryValue->id)->update(['is_deleted'=>$request->input('is_deleted')]);
        $data['result'] = array(
            'key'=>200,
            'val'=>'Category Value Roll Back Successfully'
        );
        return response()->json($data,200);
    }
    //subcategory value delete 
    public function subcategory_value_delete($id=NULL){
        if(empty($id)){
            Session::flash('warning','Subcategory Id Not Found!');
            return redirect()->back();
        }
        $subcategoryValue = Subcategory::find($id);
        if(empty($subcategoryValue)){
            Session::flash('error','Subcategory Data Not Found!');
            return redirect()->back();
        }
        $delete = Subcategory::where('id',$subcategoryValue->id)->update(['is_deleted'=>1]);
        Session::flash('success','Subcategory Data Deleted Successfully!');
        if(!empty(Session::get('current_url'))){
            return redirect(Session::get('current_url'));
        }else{
            return redirect('all-subcategory');
        }
    }
    //category store 
    public function category_store(CategoryRequest $request){
        $catagory_id = $request->input('category_id');
        if(!empty($catagory_id)){
            $catagory = Category::where('id',$catagory_id)->first();
        }else{
            $catagory = new Category();
        }
        $catagory->title = $request->input('title');
        $catagory->description = $request->input('description');
        $catagory->is_deleted = 0;
        //url modify
        if(empty($catagory_id)){
            $url_modify = Service::slug_create($request->input('title'));
            $checkSlug = Category::where('url', 'LIKE', '%' . $url_modify . '%')->count();
            if ($checkSlug > 0) {
                $new_number = $checkSlug + 1;
                $new_slug = $url_modify . '-' . $new_number;
                $catagory->url = $new_slug;
            } else {
                $catagory->url = $url_modify;
            }
        }
        $catagory->save();
        Session::flash('category_id',$catagory->id);
        Session::flash('success',(!empty($catagory_id))?'Catagory data Updated successfully':'Catagory data Saved Successfully');
        return redirect('all-category');
    }
    //category status change 
    public function category_status_change(Request $request){
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        if(empty($category)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Category Data Not Found!'
            );
            return response()->json($data,200);
        }
        $update = Category::where('id',$category->id)->update(['status'=>$request->input('status')]);
        $data['result'] = array(
            'key'=>200,
            'val'=>'Category Updated!'
        );
        return response()->json($data,200);
    }
    //category value delete 
    public function category_value_delete($id=NULL){
        if(empty($id)){
            Session::flash('warning','Category Id Not Found!');
            return redirect()->back();
        }
        $categoryValue = Category::find($id);
        if(empty($categoryValue)){
            Session::flash('error','Category Data Not Found!');
            return redirect()->back();
        }
        $delete = Category::where('id',$categoryValue->id)->update(['is_deleted'=>1]);
        Session::flash('success','Category Data Deleted Successfully!');
        return redirect('all-category');
    }
    //all deleted item of category, subcategory, attribute
    public function deleted_items(){
        $data['page_title'] = 'Category | All Deleted Items';
        $data['categories'] = true;
        $data['deleted_items'] = true;
        $data['attribute_values'] = AttributeValue::where('is_deleted',1)->paginate(3);
        $data['subcategories'] = Subcategory::where('is_deleted',1)->paginate(3);
        $data['categories'] = Category::where('is_deleted',1)->orderBy('id','desc')->paginate(1);
        return view('category/deletedItem',$data);
    }
    //attribute list 
    public function attributes(){
        $data['page_title'] = 'Category | All Attributes';
        $data['categories'] = true;
        $data['attributes'] = true;
        $data['current'] = URL::full();
        Session::put('current_url',$data['current']);
        $data['attribute_list'] = Attribute::all();
        $data['attribute_values'] = AttributeValue::where('is_deleted',0)->paginate(2);
        return view('category/attributes',$data);
    }
    //store attribute
    public function store_attribute(AttributeRequest $request){
        $attribute_array = $request->input('attribute_arr');
        $main_attribute = $request->input('main_attribute');
        foreach($attribute_array as $row){
            if(empty($row)){
                Session::flash('warning','Please Full Up Attribute Data Properly!');
                return redirect('attributes');
            }
            $arrtibute_val = new AttributeValue();
            $arrtibute_val->attribute_id = $main_attribute;
            $arrtibute_val->name = $row;
            $arrtibute_val->save();
        }
        Session::flash('success','Attribute data saved successfully!');
        return redirect('attributes');
    }
    //attribute value status change 
    public function attribute_value_status_change(Request $request){
        $attribute_value_id = $request->input('attribute_value_id');
        $attribute_value = AttributeValue::find($attribute_value_id);
        if(empty($attribute_value)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Attribute Value Data Not Found!'
            );
            return response()->json($data,200);
        }
        $update = AttributeValue::where('id',$attribute_value->id)->update(['status'=>$request->input('status')]);
        $data['result'] = array(
            'key'=>200,
            'val'=>'Attribute Value Updated!'
        );
        return response()->json($data,200);
    }
    //delete attribute 
    public function attribute_value_delete($id=NULL){
        if(empty($id)){
            Session::flash('warning','Attribute Id Not Found!');
            return redirect()->back();
        }
        $attributeValue = AttributeValue::find($id);
        if(empty($attributeValue)){
            Session::flash('error','Attribute Data Not Found!');
            return redirect()->back();
        }
        $delete = AttributeValue::where('id',$attributeValue->id)->update(['is_deleted'=>1]);
        Session::flash('success','Attribute Data Deleted Successfully!');
        if(!empty(Session::get('current_url'))){
            return redirect(Session::get('current_url'));
        }else{
            return redirect('attributes');
        }
    }
    //roll back attribute data 
    public function roll_back_attribute_value(Request $request){
        
        $attributeValue = AttributeValue::find($request->input('attribute_id'));
        if(empty($attributeValue)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'Attribute Data Not Found'
            );
            return response()->json($data,200);
        }
        $delete = AttributeValue::where('id',$attributeValue->id)->update(['is_deleted'=>$request->input('is_deleted')]);
        $data['result'] = array(
            'key'=>200,
            'val'=>'Attribute Value Roll Back Successfully'
        );
        return response()->json($data,200);
    }
    //get attribute data for edit
    public function get_attribute_for_edit($id=NULL){
        $getAttributeValue = AttributeValue::find($id);
        if(empty($getAttributeValue)){
            $data['result'] = array(
                'key'=>101,
                'val'=>'attribute value not found!'
            );
            return response()->json($data,200);
        }
        $attributes = Attribute::all();
        $select = "";
        $select .= '<input type="hidden" id="attribute_value_id" name="attribute_value_id" value="'.$getAttributeValue->id.'">';
        $select .= '<h4 class="card-title">Select Main Attribute</h4>';
        $select .= '<select id="main_attribute" name="main_attribute" class="default-select form-control wide mb-3">';
        foreach($attributes as $attribute){
            if($attribute->id==$getAttributeValue->attribute_id){
                $select .= '<option selected value="'.$attribute->id.'">'.$attribute->name.'</option>';
            }else{
                $select .= '<option value="'.$attribute->id.'">'.$attribute->name.'</option>';
            }
        }
        $select .= '</select><br>';
        $select .= '<h4 class="card-title">Attribute Value</h4>';
        $select .= '<input value="'.$getAttributeValue->name.'" name="attribute_value_name" id="attribute_value_name" class="form-control" type="text">';
        $data['result'] = array(
            'key'=>200,
            'val'=>$select
        );
        return response()->json($data,200);
    }
    //edit attribute post 
    public function get_attribute_for_edit_post(Request $request){
        $attribute_value_id = $request->input('attribute_value_id');
        $attribute_value = AttributeValue::find($attribute_value_id);
        if(empty($attribute_value)){
            Session::flash('error','Attribute Value Data Not Found!');
            return redirect('attributes');
        }
        $attribute_value->attribute_id = $request->input('main_attribute');
        $attribute_value->name = $request->input('attribute_value_name');
        $attribute_value->save();
        Session::flash('success','Attribute Data Updated Successfully!');
        Session::flash('attribue_value_id',$attribute_value->id);
        if(!empty(Session::get('current_url'))){
            return redirect(Session::get('current_url'));
        }else{
            return redirect('attributes');
        }
    }
    
}
