@extends('layouts.sidebar')

@section('content')
{{-- User data From database --}}
<div class="content-wrapper">
    <!-- Main content -->
        <div class="container-fluid">
            <!-- left column -->
            <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
                <div class="card-header border-0">
                    <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-6"><h6 class="card-title"><b>PRODUCT</b></h6></div>
                        <div class="col-md-5"></div>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div  class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <h3 class="card-title">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#add"><i class="fa fa-plus"> Add Product</i> </button>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                            <input type="text" class="form-control" >
                                            <button class="btn btn-outline-success" type="button">Search</button>
                                            </div>
                                        </div>
                                </h3>
                                </div>
                                <div class="card-body">
                                        <table class="table bg-white rounded shadow-sm  table-hover">
                                            <thead class="table-success">
                                                <tr>
                                                    <th scope="col" >#</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Selling Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Alert_stock</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td>{{$product->product_name}}</td>
                                                    <td>{{$product->description}}</td>
                                                    <td>{{number_format($product->price,2)}}</td>
                                                    <td>{{$product->quantity}}</td>
                                                    <td>@if($product->alert_stock >= $product->quantity) <span class="badge bg-danger">Low Stock > {{$product->alert_stock}}</span>
                                                    @else <span class="badge bg-success">{{$product->alert_stock}}</span> @endif </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $product->id }}"><i class="fas fa-edit" > Edit</i></a>
                                                            <a href="#" class="btn btn-danger btn-sm" ata-bs-toggle="modal" data-bs-target="#delete{{ $product->id }}"><i class="fas fa-trash" d> Delete</i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                {{-- Edit User Modal --}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="edit{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('products.update',$product->id)}}" method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <div class="form-group">
                                                                <label  class="form-label">Product Name</label>
                                                                <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label  class="form-label">Description</label>
                                                                    <input type="text" class="form-control" name="description" value="{{$product->description}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label  class="form-label">Brand</label>
                                                                    <input type="text" class="form-control" name="brand"  value="{{$product->brand}}">
                                                                <div class="form-group">
                                                                    <label  class="form-label">Price</label>
                                                                    <input type="number" class="form-control" name="price"  value="{{$product->price}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label  class="form-label">Quantity</label>
                                                                    <input type="number" class="form-control" name="quantity"  value="{{$product->quantity}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label  class="form-label">Alert Stock</label>
                                                                    <input type="number" class="form-control" name="alert_stock"  value="{{$product->alert_stock}}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button class="btn btn-primary btn-block">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    </div>
                                                </div>
                                                 {{-- Delete User Modal --}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('products.destroy',$product->id)}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <div>
                                                                <p>Are You Sure you want to delete this {{ $product->product_name}}</p>
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button class="btn btn-danger btn-block">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    </div>
                                                </div>

                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{$products->links()}}
                                    </div>
                                </div><!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
                    <!-- /.card -->
        </div>
                <!--/.col (right) -->
    </div>

    {{-- Add product Modal --}}
  <!-- Modal -->
  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('products.store')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label  class="form-label">Product Name</label>
                  <input type="text" class="form-control" name="product_name">
                </div>
                <div class="form-group">
                    <label  class="form-label">Description</label>
                    <textarea type="text" class="form-control" name="description" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <label  class="form-label">Brand</label>
                    <input type="text" class="form-control" name="brand">
                  </div>
                  <div class="form-group">
                    <label  class="form-label">Price</label>
                    <input type="number" class="form-control" name="price">
                  </div>
                  <div class="form-group">
                    <label  class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity">
                  </div>
                  <div class="form-group">
                    <label  class="form-label">Alert Stock</label>
                    <input type="number" class="form-control" name="alert_stock">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary btn-block">Save</button>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>

  {{-- Edit User Modal --}}
  <!-- Modal -->



@endsection
