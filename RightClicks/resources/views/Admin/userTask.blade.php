@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pending Tasks</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Tasks</li>
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <!-- /.card-header -->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body filterable">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Description</th>
                    <th>isCompleted</th>

                  </tr>
                  </thead>
                  <tfoot style="display: table-header-group">
                    <tr class="filters">
                      <th></th>
                      <th><input type="text" class="form-control" placeholder="Task"></th>
                      <th><input type="text" class="form-control" placeholder="Description"></th>
                      <th></th>
                    </tr>
                    </tfoot>
                  <tbody>

                    <?php $i = 0 ?>
                    @foreach ($r as $key=>$task)
                    <?php $i++ ?>
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $task->gettaskRequest->name }}</td>
                      <td>{{ $task->gettaskRequest->description }}</td>
                      <td>
                        <button title="click for make task completed" type="button" class="btn btn-outline-success"   data-toggle="modal" data-target="#rslt{{ $task->id }}"><i class="fas fa-check"></i></i></button>
                      </td>
                    {{-- Completed --}}
                    <div class="modal fade" id="rslt{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            Are you sure you have completed this task ?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                            <a href="/task/completed/{{ $task->id }}" class="btn btn-danger">Yes</a>
                            </div>
                        </div>
                        </div>
                    </div>

                    </tr>
                    @endforeach
                  </tbody>

                </table>
                <!-- Button trigger modal -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


<Script>
  setTimeout(function(){
    $('.alert').alert('close');
  },3000)

  window.onload=function(){
    $(".select2").select2();
  };
</script>


@endsection
