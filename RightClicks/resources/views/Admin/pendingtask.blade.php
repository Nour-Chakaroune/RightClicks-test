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
              <li class="breadcrumb-item active">Pending Tasks</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(Session::get('err'))
    {{-- <div  align="center">
    <div class="alert alert-success bg-gradient-success alert-dismissible fade show" role="alert"style="width: 50%">
      {{ Session::get('err') }}
    </div>
  </div> --}}
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
                    <th>Department</th>
                    <th>User</th>

                  </tr>
                  </thead>
                  <tfoot style="display: table-header-group">
                    <tr class="filters">
                      <th></th>
                      <th><input type="text" class="form-control" placeholder="Task"></th>
                      <th><input type="text" class="form-control" placeholder="Department"></th>
                      <th><input type="text" class="form-control" placeholder="User"></th>
                    </tr>
                    </tfoot>
                  <tbody>

                    <?php $i = 0 ?>
                    @foreach ($task as $key=>$task)
                    <?php $i++ ?>
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $task->gettaskRequest->name }}</td>
                      <td>{{ $task->getdepRequest->name }}</td>
                      <td>{{ $task->getUserRequest->name }}</td>
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
