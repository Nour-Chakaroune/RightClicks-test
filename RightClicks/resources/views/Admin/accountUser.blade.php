@extends('layouts.master')
@section('content')
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
<div class="content-wrapper"  style="background-color: white !important;margin-bottom:5%">
<div align="center" class="">
<div class="card card-default" data-select2-id="33" style="width: 50%">
    <div class="card-header">
      <h3 class="card-title">Edit Account</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body" data-select2-id="36">
        <form action="{{route('accountedit')}}" method="POST">
            @csrf
            <label>Name</label>
            <div class="form-group">
                <input type="text"  class="form-control" name="name" value="{{ Auth::User()->name }}">
            </div>
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <label>Email</label>
            <div class="form-group">
                <input type="text" class="form-control" name="email" value="{{ Auth::User()->email}}">
            </div>
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <label>Phone</label>
            <div class="form-group">
                <input type="text" class="form-control" name="phone" value="{{ Auth::User()->phone }}">
            </div>
            @error('phone')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <label>Encrypted Password </label>
            <div class="form-group">
                <input type="text"  class="form-control" name="password" value="{{ Auth::User()->password }}">
            </div>
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div>
                <button type="submit" value="{{Auth::User()->id}}" class="btn btn-primary">Save Change</button>
            </div>
        </form>
    </div>

  </div>
</div>
</div>
@endsection
