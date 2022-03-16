<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/map.png" rel="icon" />
    <title>Buscador CP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
    body{background:#6363FF;margin:0}
    .form{width:380px;
        height:540px;
        background:#F6F6FA;
        border-radius:8px;
        box-shadow:0 0 40px -10px #000;
        margin:calc(50vh - 220px) auto;
        padding:20px 30px;
        max-width:calc(100vw - 40px);
        box-sizing:border-box;
        font-family:'Montserrat',sans-serif;
        position:relative}
    h2{margin:10px 0;
        padding-bottom:10px;
        width:180px;
        color:#17181C;
        border-bottom:3px solid #28292C}
    input{width:100%
        padding:10px;
        box-sizing:border-box;
        background:none;
        outline:none;
        resize:none;
        border:0;
        font-family:'Montserrat',sans-serif;
        transition:all .3s;
        border-bottom:2px solid #bebed2}
    input:focus{border-bottom:2px solid #78788c}
    p:before{content:attr(type);
        display:block;
        margin:28px 0 0;
        font-size:14px;
        color:#5a5a5a}
    button{float:right;
        padding:8px 12px;
        margin:8px 0 0;
        font-family:'Montserrat',sans-serif;
        border:2px solid #78788c;
        background:0;
        color:#5a5a6e;
        cursor:pointer;
        transition:all .3s}
    button:hover{background:#78788c;
        color:#fff}
    select{width:100%;
        padding:10px;
        box-sizing:border-box;
        background:none;
        outline:none;
        resize:none;
        border:0;
        font-family:'Montserrat',sans-serif;
        transition:all .3s;
        border-bottom:2px solid #bebed2}
    span{margin:0 5px 0 15px}
    </style>
</head>
<body>
    <form class="form">
        <h2>CodigosPostales</h2>
        <input type="text" name="codigo" id="search">
        <input type="button" id="action-button" value="BUSCAR">
        <select id="asentamiento" style="margin-top: 10%;">
            <option value="">Colonia</option>
        </select>
        <select id="tipo-col" style="margin-top: 10%;">
            <option value="">Tipo Colonia</option>
        </select>
        <select id="ciudad" style="margin-top: 10%;">
            <option value="">Ciudad</option>
        </select>
        <select id="municipios" style="margin-top: 10%;">
            <option value="">Municipio</option>
        </select>
        <br>

    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script type="text/javascript">


    $(document).ready(function(){
        $('#action-button').click(function(){
            let codigo = $('#search').val();
            // -- Ajax a show
            $.ajax({
                url: '{{route('codigos.show')}}'+'/'+codigo,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    let codigos = response.codigos;
                    // -- Vaciar select
                    $('#asentamiento').empty();
                    // -- Agregar opciones
                    for(let i = 0; i < codigos.length; i++){
                        $('#asentamiento').append('<option value="'+codigos[i].asentamiento+'">'+codigos[i].asentamiento+'</option>');
                    }
                }
            });
        });

        $("#asentamiento").change(function(){
            let codigo = $('#search').val();
            let asentamiento = $('#asentamiento').val();
            //-- Ajax a show
            $.ajax({
                url: '{{route('codigos.asentamientos')}}'+'/'+codigo+'/'+asentamiento,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    let codigos = response.codigos;
                    console.log(codigos);
                    // -- Vaciar select
                    $('#municipios').empty();
                    $('#ciudad').empty();
                    $('#tipo-col').empty();
                    // -- Agregar opciones
                    for(let i = 0; i < codigos.length; i++){
                        $('#municipios').append('<option value="'+codigos[i].municipio+'">'+codigos[i].municipio+'</option>');
                        $('#ciudad').append('<option value="'+codigos[i].ciudad+'">'+codigos[i].ciudad+'</option>');
                        $('#tipo-col').append('<option value="'+codigos[i].tipo_asenta+'">'+codigos[i].tipo_asenta+'</option>');
                    }
                }
            });
        });
    });
</script>
</html>
