@extends('adminpanel')
@section('admin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Product</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Id</strong></th>
                                    <th><strong>Title</strong></th>
                                    <th><strong>Discription</strong></th>
                                    <th><strong>Image</strong></th>
                                    <th><strong>Quantity</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list_products as $row)
                                <tr class="{{ (!empty(Session::get('product_id')) && Session::get('product_id')==$row->id)?'table-primary':'' }}">
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->short_description }}</td>
                                    <td><img src="{{ URL::to('public/main/image/'.$row->image) }}" height="100px" width="70px"/></td>
                                    <td>{{ $row->total_stock }}</td>
                                    
                                </tr>
                                @empty
                                <p class="bg-danger text-white p-1">No Item Found</p>
                                @endforelse
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination pagination-xs pagination-gutter  pagination-warning">
                                {!! $list_products->links() !!}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop