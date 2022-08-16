@extends('adminpanel')
@section('admin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deleted Attribute Value List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Id</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Main Attribute</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attribute_values as $attribute)
                                <tr>
                                    <td>{{ $attribute->id }}</td>
                                    <td>{{ $attribute->attribute->name }}</td>
                                    <td>{{ $attribute->name }}</td>
                                    <td>
                                        <input class="roll-back-attribute-value" type="checkbox" data-id="{{ $attribute->id }}" data-toggle="toggle" {{ ($attribute->is_deleted==0)?'checked':'' }} data-on="Active" data-off="Roll Back" data-onstyle="success" data-offstyle="danger">
                                    </td>
                                </tr>
                                @empty
                                <p class="bg-danger text-white p-1">No Item Found</p>
                                @endforelse
                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination pagination-xs pagination-gutter  pagination-warning">
                                {!! $attribute_values->links() !!}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deleted Subcategory Item</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Title</strong></th>
                                    <th><strong>Id</strong></th>
                                    <th><strong>Discription</strong></th>
                                    <th><strong>Main Category</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $row)
                                <tr class="{{ (!empty(Session::get('subcategory_id')) && Session::get('subcategory_id')==$row->id)?'table-primary':'' }}">
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->description }}	</td>
                                    <td>{{ $row->get_category->title }}</td>
                                    <td>{{ date('M/d/Y',strtotime($row->created_at)) }}</td>
                                    <td>
                                        <input class="roll-back-subcategory-status" type="checkbox" data-id="{{ $row->id }}" data-toggle="toggle" {{ ($row->is_deleted==0)?'checked':'' }} data-on="Active" data-off="Rollback" data-onstyle="success" data-offstyle="danger">
                                    </td>
                                </tr>
                                @empty
                                <p class="bg-danger text-white p-1">No Item Found</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deleted Category Item</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Id</strong></th>
                                    <th><strong>Title</strong></th>
                                    <th><strong>Discription</strong></th>
                                    <th><strong>Create Date</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ date('M/d/y',strtotime($row->created_at)) }}</td>
                                    <td>
                                        <input class="roll-back-category-status" type="checkbox" data-id="{{ $row->id }}" data-toggle="toggle" {{ ($row->is_deleted==0)?'checked':'' }} data-on="Active" data-off="Rollback" data-onstyle="success" data-offstyle="danger">
                                    </td>
                                </tr>
                                @empty
                                <p class="bg-danger text-white p-1">No Item Found</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop