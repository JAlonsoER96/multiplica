@extends('plantilla')
@section('content')

<div class="container" >

    <input type="text" id="mailU" value="{{Session::get('userMail')}}" hidden>
    <input type="text" id="passU" value="{{Session::get('password')}}" hidden>
    <form method="POST">
        @csrf
        {{ method_field('POST') }}

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <label>Nombre</label>
                <input type="text" id="name" class="form-control">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <label>Color</label>
                <input type="text" id="color" class="form-control">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <label>Pantone</label>
                <input type="text" id="pantone" class="form-control">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <label>Año</label>
                <input type="text" id="yer" class="form-control" pattern="[0-9]{4}" title="Por favor ingrese solo números">
            </div>
        </div>
        <br>
        <p style="text-align: center">
            <button class="btn btn-success" id="nuevo">Guardar</button>
        </p>
    </form>
    <p style="text-align: left">
        <a href="{{ route('inicio') }}"><button class="btn btn-info btn-sm">Listado</button></a>
    </p>
</div>
    
@push('script')
<script>
    let api = '{{asset('')}}'
    let email = $('#mailU').val()
    let pass = $('#passU').val()

    $('#mailU').remove()
    $('#passU').remove()

    $(document).ready(function(){
        $('#nuevo').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$("input[name='_token']").val()
                }
            });
            let color={
                name:$("#name").val(),
                color:$('#color').val(),
                pantone:$('#pantone').val(),
                year:$('#yer').val(),
                userMail:email,
                passwd:pass
                }
            $.post("{{route('store')}}",color).done(function(){
                alert('Registro guardado con exito');
                $("#name").val("")
                $('#color').val("")
                $('#pantone').val("")
                $('#yer').val("")
            }).fail(function(error){
                console.log
            })
            });
    });
</script>
@endpush
@endsection