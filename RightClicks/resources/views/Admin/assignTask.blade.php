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
      <h3 class="card-title">Assign Task</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body" data-select2-id="32">
        <form method="POST" action="{{ route('check') }}">
            @csrf

            @csrf
            <div class="form-group">
                <select class="form-control select2 form" name="task" data-placeholder="Select task" style="width: 100%;">
                    <option value="" @if (old('tks')==null) selected @endif  disabled>Select Task</option>
                    @foreach ($tks as $key)
                      <option value="{{ $key->id }}" {{ (collect(old('task'))->contains($key->id)) ? 'selected':'' }}>{{ $key->name }}</option>
                    @endforeach
                </select>
            </div>
                @error('task')
                <span class="text-danger">{{$message}}</span>
                @enderror
            <div class="input-group-outline mb-3">
                <select class="form-control mr-1 select2 form" id="department" name="department" data-placeholder="Select Department" style="width: 100%;">
                    <option value="" @if (old('dep')==null) selected @endif  disabled>Select Department</option>
                    @foreach ($dep as $key)
                      <option value="{{ $key->id }}" {{ (collect(old('department'))->contains($key->id)) ? 'selected':'' }}>{{ $key->name }}</option>
                    @endforeach
                </select><br>
                @error('department')
                <span class="text-danger">{{$message}}</span><br>
            @enderror
            <button class="btn btn-outline-success"  type="submit">Check users available in this department </button>

            </div>


        </form>
        <form action="{{ route('setassigntask') }}" method="POST">
            @csrf
        <input type="hidden" name="department" value="{{ old('department') }}">
        <input type="hidden" name="task" value="{{ old('task') }}">
        <div class="form-group">
            <select class="form-control select2 form " name="user[]" disabled multiple data-placeholder="Select Users" style="width: 100%;">
                @foreach (App\Models\User::where('depId',old('department'))->orderBy('name')->get() as $key1=>$req1)
                    <option value="{{ $req1->id }}" {{ (collect(old('user'))->contains($req1->id)) ? 'selected':'' }}>{{ $req1->name }}</option>
                @endforeach
            </select>

        </div>
            @error('user')
            <span class="text-danger">{{$message}}</span>
            @enderror
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

  </div>
</div>
</div>
<script>
  window.onload = function() {
    if(document.getElementById('department').value!=""){
      $(".form").prop('disabled',false);
    }
  };

  window.onload=function(){
    if(document.getElementById('department').value!=""){
        $(".form").prop('disabled',false);
        $("select").select2();
    }
  };
  </script>
@endsection
