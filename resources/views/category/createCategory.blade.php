@extends('adminpanel')
@section('admin')
<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create table</h4>
                </div>
                <div class="">
                           <div>
                            <form method="post" action="{{ URL::to('category-store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="basic-form">
                                        <input type="hidden" name="category_id" value="{{ (!empty($category->id))?$category->id:'' }}" class="form-control input-default ">
                                        <h4 class="card-title">Title</h4>
                                        <div class="mb-3">
                                            <input type="text" name="title" value="{{ (!empty($category->title))?$category->title:old('title') }}" class="form-control input-default ">
                                            @if ($errors->has('title'))
                                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div><br>
                                        <h4 class="card-title">Discription</h4>
                                        <div class="mb-3">
                                            <textarea name="description" class="form-control" rows="4" id="comment">{{ (!empty($category->description))?$category->description:old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>

                            </form>
                        </div>
                       
                    <div>

        </div>
    </div>
</div>
@stop