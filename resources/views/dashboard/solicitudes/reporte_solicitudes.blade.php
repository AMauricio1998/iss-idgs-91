<html>
    <title>Reporte de Solicitudes</title>
    <head>
        <style>
            table{
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                height: 10px;
            }
            td,th{
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
                height: 1px;
            }
            th.lugar{
            height: 100px;
            }
            table.primera{
                width: 700px;
                height: -10px;
            }
            tr.dos{
                height: 10px; 
            }
            header.class{
                height: 100px;
            }
            td.one{
                height: 1px;
            }
        </style>
    </head>
    
    <body>
        <table class="primera">
        <tr class="dos">
                <th rowspan="2"><center><img src="https://i.mkt.lu/dl/thumb/82882342450/80174152020.jpg" width="90px" height="70px"></center></th>
                <td style="width:455px "> <h5 style="text-align: center;"> <FONT FACE="impact" SIZE=3 COLOR="DarkOrange">Grupo Interdisciplinario de Ingeniería y Servicios S.A de C.V </FONT> </h5></td>
                <td>Fecha: <br>{{ $date }}</td>
            </tr>
            <tr>
                <td><h2 style="text-align: center;">Reporte de solicitudes</h2></td>
                <td></td>
            </tr>
            
        </table>
        <br>
        <table>
            <tr>
                <th>ID</th>
                <th>Código de solicitud</th>
                <th>Usuario</th>
                <th>Estatus</th>
                <th>Fecha de creación</th>
            </tr>
            @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->id_solicitud }}</td>
                <td>{{ $solicitud->codigo_solicitud }}</td>
                <td>{{ $solicitud->name }}</td>
                <td>{{ $solicitud->nombre_status }}</td>
                <td>{{ $solicitud->created_at }}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>


