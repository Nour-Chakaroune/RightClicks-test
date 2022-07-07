@if($errors->has('tkname') || ($errors->has('tkdescp')))
<script>setTimeout(()=>{
  document.getElementById('addtk').click();
  },1000)</script>
@endif
@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h3>
            <a href="" class="nav-link" id="addtk" data-toggle="modal" data-target="#addTask">
                <i class="fas fa-plus-circle"></i> Add New Task   </a>
            </h3>
          </div>
          <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tasks</li>
            </ol>
          </div>
        </div>
      </div>
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
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tfoot style="display: table-header-group">
                    <tr class="filters">
                      <th></th>
                      <th><input type="text" class="form-control" placeholder="Name"></th>
                      <th><input type="text" class="form-control" placeholder="Description"></th>
                      <th></th>
                    </tr>
                    </tfoot>
                  <tbody>
                    <?php $i = 0 ?>
                    @foreach ($tks as $key=>$task)
                    <?php $i++ ?>
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $task->name }}</td>
                      <td>{{ $task->description }}</td>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Tasks</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('editTask') }}" method="POST">
                              {{ csrf_field() }}
                            <label>Name</label>
                                <div class="form-group">
                                    <input type="text"  value="{{$task->name}}"  name="edttkname" class="form-control mr-1" id="tkname">
                                </div>
                            <label>Description</label>
                                <div class="form-group">
                                    <input type="text"  value="{{$task->description}}"  name="edttkdescp" class="form-control mr-1" id="tkdecp">
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" value="{{ $task->id }}" name="id" class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
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
                            Are you sure you want to delete this task ?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                            <a href="/task/delete/{{ $task->id }}" class="btn btn-danger">Yes</a>
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

{{-- add --}}
  <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="addTask" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('addTask') }}" method="POST" autocomplete="off">
            @csrf
            <div class="input-group mb-1">
              <input type="text" placeholder="Enter task name" value="{{old('tkname')}}" name="tkname" class="form-control mr-1">
            </div>
              @error('tkname')
              <span class="text-danger">{{$message}}</span>
              @enderror
              <div class="input-group mb-1">
                <input type="text" placeholder="Enter description" value="{{old('tkdescp')}}" name="tkdescp" class="form-control mr-1">
              </div>
                @error('tkdescp')
                <span class="text-danger">{{$message}}</span>
                @enderror
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>





@endsection
