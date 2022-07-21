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
                
            }
            .uno{
                border: 1px solid #dddddd;
                padding: 8px;
                height: 10px;
            }
            .ba{
                border: 1px solid #dddddd;
                padding: 8px;
                height: 0px;
            }
            footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
            }  
        </style>
    </head>
    
    <body>
        <table >
       
        <tr class="dos">
                @foreach($encabezados as $encabezado)
                <th class="ba" rowspan="2"><img src="https://i.mkt.lu/dl/thumb/82882342450/80174152020.jpg" width="80px" height="60px"></th>
                <td class="ba" style="width:500px"> <h5 style="text-align: center;"> <FONT FACE="impact" SIZE=3 COLOR="DarkOrange">Grupo Interdisciplinario de Ingeniería y Servicios S.A de C.V </FONT> </h5></td>
                <td class="ba"><FONT FACE="arial" SIZE=2>Código: <br>{{ $encabezado->codigo_solicitud }} </FONT></td>
                @endforeach
            </tr>
            
            <tr>
                <td><h2 style="text-align: center;">Solicitud de papelería</h2></td>
                <td><FONT FACE="arial" SIZE=2>Fecha: <strong><br>{{ $dates }}</strong </FONT>
            </td>
            </tr>
            </tr>
            
        </table>
        <br>
        <table>
            <tr>
                <td class="uno"><FONT FACE="arial" SIZE=2><strong>Solicita: </strong>{{ $encabezado->name }} {{ $encabezado->app }} {{ $encabezado->apm }} </FONT></td>
                <td ><FONT FACE="arial" SIZE=2><strong>Área: </strong>{{ $encabezado->nombre_area }} </FONT></td>
            </tr>
            <tr>
                <td  class="uno"colspan="2">
                <FONT FACE="arial" SIZE=2>Descripcion:</FONT>
                </td>
            </tr>
        </table>
   
        <br>
        <table>
            <tr>
                <th class="uno"><center><FONT FACE="arial" SIZE=2> Producto </FONT></center></th>
                <th><center><FONT FACE="arial" SIZE=2> Cantidad solicitada</FONT></center></th>
            </tr>
            @foreach($solicitud as $soli)
            <tr>
                <td class="uno"> <FONT FACE="arial" SIZE=2>{{ $soli->nombre_producto }}</FONT></td>
                <td class="uno"> <center>{{ $soli->cantidad }}</center></td>
            </tr>
            @endforeach
            <tr>
                <td class="uno" >
                <FONT FACE="arial" SIZE=2> Total:</FONT>
                </td>
                <td class="uno">
                <FONT FACE="arial" SIZE=2> <center> {{ $total }} </center> </FONT>
                </td>
            </tr>
        </table>

        <footer>
            <br>
            <center>
               ____________________ &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  ____________________
            </center>
            <br>
            <center>
            <FONT FACE="arial" SIZE=2>Entrega </FONT>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <FONT FACE="arial" SIZE=2>Recibe</FONT>
            </center>
        </footer>
    </body>
</html>

