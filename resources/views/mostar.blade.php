@extends('plantilla')
@section('content')
<hr>
    <div class="container">
        <input type="text" id="tipoU" value="{{Session::get('tipo')}}" hidden>
        <input type="text" id="mailU" value="{{Session::get('userMail')}}" hidden>
        <input type="text" id="passU" value="{{Session::get('password')}}" hidden>
        <form>
            @csrf
            <div class="row">
                <input type="text" id="id" hidden>
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
                <button class="btn btn-success" id="cambios">Guardar</button>
            </p>
        </form>
    </div>
@push('script')
    <script>
        let api = '{{asset('')}}'
        let tipo = $('#tipoU').val()
        let email = $('#mailU').val()
        let pass = $('#passU').val()

        $('#tipoU').remove()
        $('#mailU').remove()
        $('#passU').remove()

        function getId(){
            let paths = window.location.pathname.split('/');
            let id = paths[paths.length-1];
            return id;
        }

        function getItem(id){
            $.get(api+"api/colores/show/"+id,{},function(data){
                $("#name").val(data.data.name)
                $('#color').val(data.data.color)
                $('#pantone').val(data.data.pantone)
                $('#yer').val(data.data.year)
                $('#id').val(data.data.id)
            })
        }
        $(document).ready(function(){
            getItem(getId());
            $('#cambios').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    }
                });
                let color ={
                    name:$("#name").val(),
                    color:$('#color').val(),
                    pantone:$('#pantone').val(),
                    year:$('#yer').val(),
                    userMail:email,
                    passwd:pass
                }
                $.ajax({
                    type:"PUT",
                    url: api+'api/colores/changes/'+$('#id').val(),
                    data:color,
                    dataType:'json',
                    success: function(data, textStatus, xhr){

                        $("#name").val(data.data.name)
                        $('#color').val(data.data.color)
                        $('#pantone').val(data.data.pantone)
                        $('#yer').val(data.data.year)
                    },
                    error: function (data) {
                        console.log('Error:', data);}
                })
            });
        });
    </script>
@endpush
@endsection