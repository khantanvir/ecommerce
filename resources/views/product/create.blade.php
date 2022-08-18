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
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="basic-form">
                                <h4 class="card-title">Title</h4>
                                <div class="mb-3">
                                    <input type="text" name="title" value="{{ (!empty($category->title))?$category->title:old('title') }}" class="form-control input-default ">
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
                                <div id="addR">
                                    <span class="input-group-btn">
                                        <button id="addAttributeButton" type="button" class="btn btn-success add-product-div"><i class="glyphicon glyphicon-plus"></i>+</button>
                                    </span>
                                    <div id="select-wrapper">
                                        <div id="element-wrapper" class="row">
                                            @foreach ($all_attribute as $attributes)
                                            <div class="mb-3 col-2">
                                                <div class="align-items-center">
                                                    <div class="col-auto my-1">
                                                        <label class="me-sm-2">{{ $attributes->name }}</label>
                                                        <input type="hidden" name="main_attribute_id[]" value="{{ $attributes->id }}">
                                                        <select name="attribute_value_name[]" class="me-sm-2 default-select form-control wide" id="inlineFormCustomSelect">
                                                            <option selected="">Choose...</option>
                                                            @foreach ($attributes->attribute_value as $attr_value)
                                                                <option value="{{ $attr_value->id }}">{{ $attr_value->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="mb-3 col-2">
                                                <div class="align-items-center">
                                                    <div class="col-auto my-1">
                                                        <label class="me-sm-2">Quantity</label>
                                                        <input type="text" name="quantity[]" value="" class="form-control input-default ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-2">
                                                <div class="align-items-center">
                                                    <div class="col-auto my-1">
                                                        <label class="me-sm-2">Stock Price</label>
                                                        <input type="text" name="stock_price[]" value="" class="form-control input-default ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-2">
                                                <div class="align-items-center">
                                                    <div class="col-auto my-1">
                                                        <label class="me-sm-2">Selling Price</label>
                                                        <input type="text" name="selling_price[]" value="" class="form-control input-default ">
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
                                        <textarea id="ckeditor" name="short_description" class="form-control"></textarea>
                                    </div>
                                    @if ($errors->has('short_description'))
                                        <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                    @endif
                                </div><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop