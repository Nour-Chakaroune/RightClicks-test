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
      <h3 class="card-title">Registration</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body" data-select2-id="36">
        <form action="{{ route('addNewUser') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="Name" id="name" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="form-group">
                <input type="text" placeholder="Email" id="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="form-group">
                <input type="text" placeholder="Phone" id="phone" class="form-control" name="phone" value="{{ old('phone') }}">
            </div>
            @error('phone')
                <span class="text-danger">{{$message}}</span>
            @enderror

            <div class="form-group">
                <select name="role" class="form-control select2 form" data-placeholder="Select Role">
                    <option value="" selected disabled>Select Role</option>
                    <option @if(old('role')=="Admin") style="background-color: #E0E0E0;" selected @endif value="Admin">Admin</option>
                    <option @if(old('role')=="User") style="background-color: #E0E0E0;" selected @endif value="User">User</option>
                  </select>
            </div>
            @error('role')
                <span class="text-danger">{{$message}}</span>
            @enderror


            <div class="form-group">
                <select class="form-control select2 form" name="department" data-placeholder="Select Department" style="width: 100%;">
                    <option value="" @if (old('dep')==null) selected @endif  disabled>Select Department</option>
                    @foreach ($dep as $key)
                      <option value="{{ $key->id }}" {{ (collect(old('department'))->contains($key->id)) ? 'selected':'' }}>{{ $key->name }}</option>
                    @endforeach
                </select>
            </div>
                @error('department')
                <span class="text-danger">{{$message}}</span>
                @enderror

            <div class="form-group">
                <input type="text" placeholder="Password" id="password" class="form-control" name="password" value="{{ old('password') }}">
            </div>
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div>
                <button type="submit" class="btn btn-primary">Sign up</button>
            </div>
        </form>
    </div>

  </div>
</div>
</div>
@endsection
