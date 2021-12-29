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
                    <div class="col-md-6"><h6 class="card-title"><b>USERS</b></h6></div>
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
                                            <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#add"><i class="fa fa-plus"> Add Customer</i> </button>
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email Address</th>
                                                    <th scope="col">Phone Number</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td>@if($user->is_admin == 1) admin
                                                        @else Cashier
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}"><i class="fas fa-edit" > Edit</i></a>
                                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}"><i class="fas fa-trash" > Delete</i></a>

                                                        </div>
                                                    </td>
                                                </tr>
                                                {{-- Edit User Modal --}}
                                                <!-- Modal -->
                                                <div class="modal fade" id="edit{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('users.update',$user->id)}}" method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <div class="form-group">
                                                                <label  class="form-label">Name</label>
                                                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label  class="form-label">E-mail</label>
                                                                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                                                </div>
                                                                {{-- <div class="form-group">
                                                                    <label  class="form-label">phone Number</label>
                                                                    <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                                                                </div> --}}
                                                                <div class="form-group">
                                                                    <label  class="form-label">Password</label>
                                                                    <input type="password" class="form-control" name="password" readonly value="{{$user->password}}">
                                                                </div>
                                                                {{-- <div class="form-group">
                                                                    <label  class="form-label">Confirm Password</label>
                                                                    <input type="password" class="form-control" name="confirm_password">
                                                                </div> --}}
                                                                <div class="form-group">
                                                                    <label  class="form-label">Role</label>
                                                                    <select name="is_admin" id="" class="form-control">
                                                                        <option value="1" @if($user->is_admin == 1) selected @endif>Admin</option>
                                                                        <option value="2" @if($user->is_admin == 2) selected @endif>Cashier</option>
                                                                    </select>
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
                                                <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('users.destroy',$user->id)}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <div>
                                                                <p>Are You Sure you want to delete {{ $user->name}}</p>
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

    {{-- Add User Modal --}}
  <!-- Modal -->
  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('users.store')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label  class="form-label">Name</label>
                  <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label  class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email">
                  </div>
                  <div class="form-group">
                    <label  class="form-label">phone Number</label>
                    <input type="text" class="form-control" name="phone">
                  </div>
                  <div class="form-group">
                    <label  class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                  <div class="form-group">
                    <label  class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password">
                  </div>
                  <div class="form-group">
                    <label  class="form-label">Role</label>
                    <select name="is_admin" id="" class="form-control">
                        <option value="1">Admin</option>
                        <option value="2">Cashier</option>
                    </select>
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
