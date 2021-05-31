@extends('plantilla')
@section('content')
    <div class="row">
        @csrf
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div style="text-align: center">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-subtitle">Colores</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <input type="text" id="tipoU" hidden value="{{Session::get('tipo')}}">
    <input type="text" id="mailU" value="{{Session::get('userMail')}}" hidden>
    <input type="text" id="passU" value="{{Session::get('password')}}" hidden>
    <div id="contenedores">

    </div>
    <br>
    <p style="text-align: center">
        <div id="controles-paginado">
            {{ $colores->render() }}
        </div>
    </p>
    <p style="text-align: right;">
            <a href="{{route('nuevo')}}" class="btn btn-success btn-sm">Nuevo</a>
    </p>

    @push('script')
    <script>
        let api = '{{asset('')}}'
        let usuario = $('#tipoU').val()
        let email = $('#mailU').val()
        let pass = $('#passU').val()


        $("#tipoU").remove()
        $('#mailU').remove()
        $('#passU').remove()

        $(document).ready(function(){
            listColors(api+'api/colores/index');
            paginado()
        });
        /*$(document).on('click', '.pagination a', function(e){
            
            listColors(api+'api/colores/index?page='+page)
            });*/
        function listColors(addr){
            $('#colores').remove();
            $.get(addr,{},function(data){
                let datos = data.data.data
                let addr = '{{asset('')}}'
                $('#contenedores').append("<div class='row' id='colores'></div>")
                $.each(datos, function(index, value){
                    let botones = "<p style='text-align:center;'>"+
                    "<a href='"+addr+"editar/"+value.id+"' class='btn btn-info btn-sm'>Editar</a>"+
                    "<button class='btn btn-warning btn-sm' onclick='borrar("+value.id+")' >Eliminar</button></p>"
                    let card = "<div class='card rounded'>"+
                    "<div class='card-body'>"+
                    "<p class='card-text'>"+value.year+"</p>"+
                    "<p class='card-text' style='text-align:center;'>"+value.name+"<br>"+value.color+"</p>"+
                    "<p class='card-text' style='text-align:right;'>"+value.pantone+"</p>"+
                    "<div class='card-footer text-muted'>"+botones+"</div>"
                    +"</div></div>"
                    let cols = "<div class='const col-sm-12 col-md-4 col-lg-4' id='cont_"+value.id+"'>"+card+"</div>"
                    $('#colores').append(cols)
                })
            })
        }
        
        function borrar(id){
            $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    }
                });
            let respuesta = confirm('¿Esta seguro de eliminar el registro?')
            if(respuesta && usuario == "Administrador"){
                $.ajax({
                    type:'DELETE',
                    url:api+'api/colores/delete/'+id+'?mail='+email+"&?pass="+pass,
                    success:function(data){
                        $('#cont_'+id).remove();
                    },
                    error:function(data){
                        console.log(erros)
                    }
                });
            }else{
                alert('Operación cancelada')
            }
        }

        function paginado(){
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $.ajax({
                url:"{{route('inicio')}}",
                data:{page: page},
                type:'GET',
                dataType:'json',
                success:function(data){
                    listColors(api+'api/colores/index?page='+page)
                    $('#controles-paginado').html(data)
                    }
                })
            });
        }
    </script>

    @if(Session::has('error'))
    <script type="text/javascript">
      alert("{{Session::get('error')}}");
    </script>
    @endif
    @endpush
@endsection


