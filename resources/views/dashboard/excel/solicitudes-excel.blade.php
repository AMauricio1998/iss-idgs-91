
                <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-gray-900">
                        <tr class="text-white text-left">
                            <th class="font-semibold text-sm uppercase px-6 py-4"> # </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4"> Codigo solicitud </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Status </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Quien Solicita </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Area </th>
                            <th class="font-semibold text-sm uppercase px-2 py-4 text-center"> Producto </th>
                            <th class="font-semibold text-sm uppercase px-2 py-4 text-center"> Num. Productos </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Fecha de creación </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($solicitudes as $solicitud)
                            <tr>
                                <td class="px-6 py-4">{{ $solicitud->id_solicitud }}</td>
                                <td class="px-6 py-4">{{ $solicitud->codigo_solicitud }}</td>
                                <td class="px-6 py-4 text-center"> {{ $solicitud->nombre_status }}</td>
                                <td class="px-6 py-4 text-center"> {{ $solicitud->name }} {{ $solicitud->app }} {{ $solicitud->apm }}</td>
                                <td class="px-6 py-4 text-center"> {{ $solicitud->nombre_area }} </td>
                                <td class="px-6 py-4 text-center"> {{ $solicitud->nombre_producto }} </td>
                                <td class="px-6 py-4 text-center">{{ $solicitud->cantidad }}</td>
                                <td class="px-6 py-4 text-center"> {{ $solicitud->created_at }} </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>