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
                                <h4 class="card-title">Description</h4>
                                <div class="mb-3">
                                    <div class="card-body custom-ekeditor">
                                        <textarea id="ckeditor" name="short_description" class="form-control"></textarea>
                                    </div>
                                    @if ($errors->has('short_description'))
                                        <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                    @endif
                                </div><br>
                                <div id="addR">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success add-product-div"><i class="glyphicon glyphicon-plus"></i>+</button>
                                    </span>
                                    <div class="row">
                                        <div class="mb-3 col-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto my-1">
                                                    <label class="me-sm-2">Preference</label>
                                                    <select class="me-sm-2 default-select form-control wide" id="inlineFormCustomSelect">
                                                        <option selected="">Choose...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop