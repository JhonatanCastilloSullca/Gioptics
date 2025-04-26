<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
        *{
            padding:2px;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: auto; /* Ajusta automáticamente la altura según el contenido */
        }

        body {
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            width: 68mm;
            font-size: 12px;
            text-align:center;
        }
        .text-right{
            text-align:right !important;
        }
        .text-left{
            text-align:left !important;
        }
        .text-center{
            text-align:center;
        }
        .header {
            border-bottom: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        .header img {
            width: 150px;
        }
        .header-details {
            padding:0;
            margin:0;
            margin-bottom:5px;
            padding-left: 5px;
            text-align: center;
        }
        .header-details-factura
        {
            padding:0;
            margin:0;
        }
        .header-details > p{
            padding:0;
            margin:0;
        }
        .header-details-tittles
        {
            font-size:12px;
            font-weight:bold;
        }
        .header-details-factura .header-details-text
        {
            font-size:18px;
            font-weight:normal;
            text-align:center;
            padding:0;
            margin:0;
        }
        .header-details-text
        {
            font-size:12px;
            font-weight:normal;
            text-align:center;
        }
        .direccion{
            font-size: 8px
        }
        body:first-child .header {
            display: block;
        }
        .content {
            flex: 1;
            padding: 5px 0px;
            border-bottom: 1px solid #000;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: none;
            border-collapse: collapse;
            text-align:center;
            font-size:10px;
        }

        thead th {
            border-bottom: 2px solid black;
        }

        .td-description{
            font-size:8px !important;
        }

        .footer {
            margin-top: auto;
        }

        thead th {
            border-bottom: 2px solid black;
        }

        .tr-odd:nth-child(odd) {
            background-color: #efefef;
        }

        /* Estilos para filas pares */
        .tr-odd:nth-child(even) {
            background-color: #f6f6f6;
        }
        .division{
            border-top: solid 1px #000;
        }
        .text-light{
            font-size:11px;
            font-weight:normal;
        }
        .w-50{
            width:40px !important;
            font-size:10px !important;
            font-weight:bold;
        }
        .border-all
        {
            border: solid 1px #000;
        }
        .table-info tr td
        {
            border: solid 1px #000;
        }
        .de-details td
        {
            font-size: 9px !important;
            font-weight:bold;
            padding-right: 20px !important;
        }
        .enlace-consulta
        {
            font-size: 8px !important;
        }

        .w-85{
            width:85px !important;
        }

        .border-table-content{
            border: 1px solid;
        }
        .h-5{
            height:5px;
        }

        .img-logo{
            width:100px !important;
        }



    </style>
</head>
<body style="min-height: auto;">
    <div class="header">

    <img src="{{asset('img/logo-gstore.png')}}" class="img-logo" alt="logo">
        <div class="header-details">
            @foreach($medidas as $medida)
                <div class="h-5"></div>
                <p class="header-details-text direccion">{{$medida->direccionsuc}}</p>
                <p class="header-details-text direccion">{{$medida->sucursalcel}}</p>
                <p class="header-details-text direccion">Web: https://www.facebook.com/GOeyewearstore</p>
            @endforeach
        </div>
        <div class="division"></div>
        <div class="header-details-factura">
            <p class="header-details-text text-center"> </p>
            <p class="header-details-text text-center"> </p>
        </div>
        <div class="division"></div>

        <table class="">
            <tbody class="">
                @foreach($medidas as $medida)
                <tr class="">
                    <td class="w-50 text-left" >Nombre:</td>
                    <td class="text-left" ><span class="text-light ">{{$medida->paciente}}</span></td>
                </tr>
                <tr class="">
                    <td class="w-50 text-left" >Ocupacion:</td>
                    <td class="text-left" ><span class="text-light ">{{$medida->pacienteocupacion}}</span></td>
                </tr>
                <tr class="">
                    <td class="w-50 text-left" >Edad:</td>
                    <td class="text-left" ><span class="text-light ">{{$medida->pacienteedad}}</span></td>
                </tr>
                <tr class="">
                    <td class="w-50 text-left" >Teléfono:</td>
                    <td class="text-left" ><span class="text-light ">{{$medida->pacientecelular}}</span></td>
                </tr>
                <tr class="">
                    <td class="w-50 text-left" >Mail:</td>
                    <td class="text-left" ><span class="text-light ">{{$medida->pacienteemail}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="content" style="width: 100%">
        <table style="width: 100%">
            <tbody>
                @foreach($medidas as $medida)
                <tr>
                    <td  ></td>
                    <td  id="ojos" colspan="3">Ojo Derecho</td>
                    <td  id="ojos" colspan="3">Ojo Izquierdo</td>
                </tr>
                <tr  class="estilotabla">

                    <td ></td>
                    <td >Esf.</td>
                    <td >Cil.</td>
                    <td >Eje</td>
                    <td >Esf.</td>
                    <td >Cel.</td>
                    <td >Eje</td>
                </tr>
                <tr class="filaalta">
                    <td style="" class="">Vision de Lejos</td>
                    <td class="border-table-content">{{$medida->odvle}}</td>
                    <td class="border-table-content">{{$medida->odvlc}}</td>
                    <td class="border-table-content">{{$medida->odvleje}}</td>
                    <td class="border-table-content">{{$medida->oivle}}</td>
                    <td class="border-table-content">{{$medida->oivlc}}</td>
                    <td class="border-table-content">{{$medida->oivleje}}</td>
                </tr>
                <tr class="filaalta">
                    <td style="" class="">Vision de Cerca</td>
                    <td class="border-table-content">{{$medida->odvce}}</td>
                    <td class="border-table-content">{{$medida->odvcc}}</td>
                    <td class="border-table-content">{{$medida->odvceje}}</td>
                    <td class="border-table-content">{{$medida->oivce}}</td>
                    <td class="border-table-content">{{$medida->oivcc}}</td>
                    <td class="border-table-content">{{$medida->oivceje}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <table id="datospaciente2">
                <tbody>
                    @foreach($medidas as $medida)
                    <tr>
                        <td class="border-table-content" colspan="2">Indicaciones: {{$medida->indicaciones}}</td>
                    </tr>
                    <tr>
                        <td class="border-table-content">DIP: {{$medida->dip}}</td>
                        <td class="border-table-content" rowspan="3">Especialista: {{$medida->especialista}}</td>
                    </tr>
                    <tr>
                        <td class="border-table-content">ADD: {{$medida->add}}</td>
                    </tr>
                    <tr>
                        <td class="border-table-content">Fecha: {{$medida->fecha}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <p class="enlace-consulta">
            Descarte de miopía, hipermetropia, estrabismo, astigmatismo, presbicia, ambliopía,<br>Evaluación garantizada por profesionales
        </p>
    </div>

</body>
</html>
