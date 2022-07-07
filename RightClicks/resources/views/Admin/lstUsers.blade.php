@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Users</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Users</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
    </section>
    @if(Session::get('err'))
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
      <script>
          var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
      Toast.fire({
            icon: 'success',
            title: '{{ Session::get('err') }}',
            background: '#20c997',
          })
      </script>
        @endif
        @if(Session::get('cannotdelete'))
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script>
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
        Toast.fire({
              icon: 'error',
              title: '{{ Session::get('cannotdelete') }}',
              background: '#FF9494',
            })
        </script>
        @endif
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body filterable">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tfoot style="display: table-header-group">
                    <tr class="filters">
                      <th></th>
                      <th><input type="text" class="form-control" placeholder="Name"></th>
                      <th><input type="text" class="form-control" placeholder="Email"></th>
                      <th><input type="text" class="form-control" placeholder="Phone"></th>
                      <th><input type="text" class="form-control" placeholder="Role"></th>
                      <th><input type="text" class="form-control" placeholder="Department"></th>
                      <th></th>
                    </tr>
                    </tfoot>
                  <tbody>
                    <?php $i = 0 ?>
                    @foreach ($us as $key=>$task)
                    <?php $i++ ?>
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $task->name }}</td>
                      <td>{{ $task->email }}</td>
                      <td>{{ $task->phone }}</td>
                      <td>{{ $task->role }}</td>
                      <td>{{$task->getdepUser->name}}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <button title="Edit" type="button" class="btn btn-outline-warning"  data-toggle="modal" data-target="#edt{{ $task->id }}"><i class="far fa-edit"></i></button>
                        <button title="Delete task" type="button" class="btn btn-outline-danger"  data-toggle="modal" data-target="#dlt{{ $task->id }}"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </td>


                    {{-- edit --}}
                    <div class="modal fade" id="edt{{ $task->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('edituser') }}" method="POST">
                              {{ csrf_field() }}
                            <label>Name</label>
                                <div class="form-group">
                                    <input type="text"  value="{{$task->name}}"  name="edtUname" class="form-control mr-1">
                                </div>
                            <label>Email</label>
                                <div class="form-group">
                                    <input type="text"  value="{{$task->email}}"  name="edtUemail" class="form-control mr-1">
                                </div>
                            <label>Phone</label>
                                <div class="form-group">
                                    <input type="text"  value="{{$task->phone}}"  name="edtUphone" class="form-control mr-1">
                                </div>
                            <label>Role</label>
                                <div class="input-group mb-1">
                                    <select name="edtUrole" class="form-control">
                                      <option @if($task->role=="Admin") style="background-color: #E0E0E0;" selected @endif value="Admin">Admin</option>
                                      <option @if($task->role=="User") style="background-color: #E0E0E0;" selected @endif value="User">User</option>
                                     </select>
                                </div>

                            <label>Department</label>
                                <div class="form-group">
                                    <select class="form-control select2 form" name="edtUdep" style="width: 100%;">
                                        @foreach ($dep as $key)
                                        <option value="{{ $key->id }}" @if($key->id==$task->name) selected @endif>{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <label>Encrypted Password</label>
                                <div class="form-group">
                                    <input type="text"  value="{{$task->password}}"  name="edtUpswd" class="form-control mr-1">
                                </div>

                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" value="{{ $task->id }}" name="id" class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
                        </div>
                        </div>
                        </div>
                    </div>

                    {{-- Delete --}}
                    <div class="modal fade" id="dlt{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            Are you sure you want to delete this user ?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                            <a href="/user/delete/{{ $task->id }}" class="btn btn-danger">Yes</a>
                            </div>
                        </div>
                        </div>
                    </div>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
