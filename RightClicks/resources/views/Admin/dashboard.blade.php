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



@endsection
