@extends('plantilla')
@section('content')
<br>
<div class="row">
    <div class="col-md-3 col-lg-3"></div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header" style="text-align: center">
                Login
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sesion') }}" method="POST" >
                @csrf
                <div class="row">
                    @if($errors->first('email')) 
                    <i> {{ $errors->first('email') }} </i> 
                    @endif
                    <label>Email</label>
                    <input type="text" name="email" class="form-control form-control-sm" value="{{old('email')}}">
                    @if($errors->first('password')) 
                    <i> {{ $errors->first('password') }} </i> 
                    @endif
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-sm">
                </div>
                <p style="text-align: center">
                    <br>
                    <button class="btn btn-success btn-sm" id="login">Ingresar</button>
                </p>
            </form>
        </div>
    </div>
    <div class="col-md-3 col-lg-3"></div>
</div>
    
@push('script')
    @if(Session::has('error'))
    <script type="text/javascript">
      alert("{{Session::get('error')}}");
    </script>
    @endif
@endpush
@endsection