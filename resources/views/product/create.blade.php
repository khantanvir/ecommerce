@extends('adminpanel')
@section('admin')
<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Product</h4>
                </div>
                <div>
                    <form method="post" action="{{ URL::to('store-product') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="basic-form">
                                <h4 class="card-title">Title</h4>
                                <div class="mb-3">
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control input-default ">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div><br>
                                <h4 class="card-title">Short Description</h4>
                                <div class="mb-3">
                                    <textarea name="short_description" class="form-control" rows="3" id="comment"></textarea>
                                    @if ($errors->has('short_description'))
                                        <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                    @endif
                                </div><br>
                                <div class="mb-3">
                                    <h4 class="card-title">Select Category</h4>
                                    <select name="category_id" class="default-select form-control wide mb-3">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $key => $row)
                                            <option value="{{ $row->id }}">{{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div><br>
                                <div class="mb-3">
                                    <input type="text" name="stock_price" value="{{ old('stock_price') }}" class="form-control input-default ">
                                    @if ($errors->has('stock_price'))
                                        <span class="text-danger">{{ $errors->first('stock_price') }}</span>
                                    @endif
                                </div><br>
                                <div class="mb-3">
                                    <input type="text" name="selling_price" value="{{ old('selling_price') }}" class="form-control input-default ">
                                    @if ($errors->has('stock_price'))
                                        <span class="text-danger">{{ $errors->first('selling_price') }}</span>
                                    @endif
                                </div><br>
                                <div id="addR">
                                    <span class="input-group-btn">
                                        <button id="addAttributeButton" type="button" class="btn btn-success add-product-div"><i class="glyphicon glyphicon-plus"></i>+</button>
                                    </span>
                                    <div id="select-wrapper">
                                        <div id="element-wrapper" class="row">
                                            @foreach ($all_attribute as $key=>$attributes)
                                            @if($attributes->type=='size')
                                                <div class="mb-3 col-2">
                                                    <div class="align-items-center">
                                                        <div class="col-auto my-1">
                                                            <label class="me-sm-2">{{ $attributes->name }}</label>
                                                            <select name="attribute_size_values[]" class="me-sm-2 default-select form-control wide" id="inlineFormCustomSelect">
                                                                <option selected="">Choose...</option>
                                                                @foreach ($attributes->attribute_value as $attr_value)
                                                                    <option value="{{ $attr_value->name }}">{{ $attr_value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($attributes->type=='color')
                                                <div class="mb-3 col-2">
                                                    <div class="align-items-center">
                                                        <div class="col-auto my-1">
                                                            <label class="me-sm-2">{{ $attributes->name }}</label>
                                                            <select name="attribute_color_values[]" class="me-sm-2 default-select form-control wide" id="inlineFormCustomSelect">
                                                                <option selected="">Choose...</option>
                                                                @foreach ($attributes->attribute_value as $attr_value)
                                                                    <option value="{{ $attr_value->name }}">{{ $attr_value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                            @endif
                                            
                                            @endforeach
                                            <div class="mb-3 col-2">
                                                <div class="align-items-center">
                                                    <div class="col-auto my-1">
                                                        <label class="me-sm-2">Quantity</label>
                                                        <input type="text" name="quantity[]" value="" class="form-control input-default ">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <br><span class="input-group-btn"><button type="button" class="btn btn-danger remove-attribute-element"><i class="glyphicon glyphicon-minus"></i>-</button></span>
                                        </div>
                                    </div>
                                </div><br>
                                <h4 class="card-title">Description</h4>
                                <div class="mb-3">
                                    <div class="card-body custom-ekeditor">
                                        <textarea id="ckeditor" name="description" class="form-control"></textarea>
                                    </div>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div><br>
                                <h4 class="card-title">Main Image</h4>
                                <div class="input-group">
                                    <div class="form-file">
                                        <input type="file" name="main_image" class="form-file-input form-control">
                                    </div>
                                    @if ($errors->has('main_image'))
                                        <span class="text-danger">{{ $errors->first('main_image') }}</span>
                                    @endif
                                </div><br>
                                <div class="mb-3">
                                    <div class="textbox-wrapper-img">
                                        <div class="input-wrapper-img">
                                            <h4 class="card-title">More Images</h4>
                                            <div class="input-group">
                                                <input type="file" name="more_images[]" class="form-file-input form-control" />
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-success add-textbox-img"><i class="glyphicon glyphicon-plus"></i>+</button>
                                                </span>
                                            </div><br>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop