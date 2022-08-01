    <div class="mt-20 md:mt-5 shadow-lg px-5 rounded-xl w-auto">
        <!-- Resources -->
                <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

                <!-- Chart code -->
                <script>
                    am4core.ready(function() {

                        // Themes begin
                        am4core.useTheme(am4themes_animated);
                        // Themes end
        
                        // Create chart
                        var chart = am4core.create("chartdiv", am4charts.PieChart);
                        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
        
                        chart.dataSource.url = "http://issidgs.herokuapp.com/dashboard/admin/graficas";
                        {{--  chart.dataSource.url = "http://127.0.0.1:8000/dashboard/admin/graficas";  --}}
        
                        var series = chart.series.push(new am4charts.PieSeries());
                        series.dataFields.value = "num_pedidos";
                        series.dataFields.radiusValue = "num_pedidos";
                        series.dataFields.category = "nombre";
                        series.slices.template.cornerRadius = 6;
                        series.colors.step = 3;
        
                        series.hiddenState.properties.endAngle = -90;
        
                        chart.legend = new am4charts.Legend();
        
                        });
                </script>
                <header class="text-center bg-gray-300 w-auto rounded-lg">
                    <span class="text-black font-bold">Productos mas </span><span class="text-indigo-600 font-bold">solicitados</span>
                </header>
                <div id="chartdiv" class="h-96 w-auto"></div>
    </div>
    <div class="mt-20 md:mt-5 shadow-lg px-5 rounded-xl w-auto">
        <header class="text-center bg-gray-300 w-auto rounded-lg">
            <span class="text-black font-bold">Informacion de las </span><span class="font-bold text-indigo-600">solicitudes</span>
        </header>
        <div class="h-1/3 flex flex-row justify-between mt-5">
            <div class="text-black font-semibold text-sm mt-10">Solicitudes creadas: </div>
            @foreach ($soliCreadas as $creadas)
                <div class="text-black font-semibold text-sm mt-10">{{ $creadas->cantidad }}</div>
            @endforeach
            <div class="mt-10"><i class="fa-solid fa-xl fa-folder-plus"></i></div>
        </div>
        <hr class="bg-black">
        <div class="h-1/3 flex flex-row justify-between">
            <div class="text-black font-semibold text-sm mt-5">Solicitudes pendientes: </div>
            @foreach ($soliPendientes as $pendientes)
                <div class="text-black font-semibold text-sm mt-5">{{ $pendientes->cantidad }}</div>
            @endforeach
            <div class="mt-5"><i class="fa-solid fa-hourglass fa-xl"></i></div>
        </div>
        <hr class="bg-black">
        <div class="h-1/3 flex flex-row justify-between">
            <div class="text-black font-semibold text-sm">Solicitudes finalizadas: </div>
            @foreach ($soliCompletadas as $finalizadas)
                <div class="text-black font-semibold text-sm">{{ $finalizadas->cantidad }}</div>
            @endforeach
            <div><i class="fa-solid fa-paper-plane"></i></div>
        </div>
    </div>
    
    <div class="mt-20 md:mt-5 shadow-lg px-5 rounded-xl w-auto">
        <header class="text-center bg-gray-300 w-auto rounded-lg">
            <span class="text-black font-bold">Informacion de los </span><span class="text-indigo-600 font-bold">usuarios</span>
        </header>
        <div class="h-1/3 flex flex-row justify-between mt-5">
            <div class="text-black font-semibold text-sm mt-10">Usuarios totales: </div>
            @foreach ($usuarios as $users)
                <div class="text-black font-semibold text-sm mt-10">{{ $users->cantidad }}</div>
            @endforeach
            <div class="mt-10"><i class="fa-solid fa-users fa-xl"></i></div>
        </div>
        <hr class="bg-black">
        <div class="h-1/3 flex flex-row justify-between">
            <div class="text-black font-semibold text-sm mt-5">Usuarios activos: </div>
            @foreach ($ususActivos as $activos)
                <div class="text-black font-semibold text-sm mt-5">{{ $activos->cantidad }}</div>
            @endforeach
            <div class="mt-5"><i class="fa-solid fa-user-plus fa-xl"></i></div>
        </div>
        <hr class="bg-black">

        <div class="h-1/3 flex flex-row justify-between">
            <div class="text-black font-semibold text-sm">Usuarios inactivos: </div>
            @foreach ($ususInactivos as $inactivos)
                <div class="text-black font-semibold text-sm">{{ $inactivos->cantidad }}</div>
            @endforeach
            <div><i class="fa-solid fa-user-xmark fa-xl"></i></div>
        </div>
    </div>
    
    