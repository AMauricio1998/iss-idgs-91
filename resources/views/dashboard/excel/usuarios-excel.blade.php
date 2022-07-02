            <table class='mt-2 mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-900">
                    <tr class="text-white text-left">
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Nombre </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Telefono </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Colonia </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Calle </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Num. calle </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Cod. postal </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Estado </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Municipio </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Email </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Area </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> rol </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Fecha de alta </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> status </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($usuarios as $usu)
                        <tr>
                            <td class="px-6 py-4"> {{ $usu->name }} {{ $usu->app }} {{ $usu->apm }}</td>
                            <td class="px-6 py-4">{{ $usu->telefono }}</td>
                            <td class="px-6 py-4">{{ $usu->colonia }}</td>
                            <td class="px-6 py-4">{{ $usu->calle }}</td>
                            <td class="px-6 py-4">{{ $usu->num_calle }}</td>
                            <td class="px-6 py-4">{{ $usu->cod_postal }}</td>
                            <td class="px-6 py-4">{{ $usu->estado }}</td>
                            <td class="px-6 py-4">{{ $usu->municipio }}</td>
                            <td class="px-6 py-4">{{ $usu->email }}</td>
                            <td class="px-6 py-4"> {{ $usu->areas->nombre_area }} </td>
                            <td class="px-6 py-4"> {{ $usu->roles->nombre_rol }} </td>
                            <td class="px-6 py-4"> {{ $usu->created_at->format('d-m-Y') }} </td>
                            <td class="px-6 py-4"> 
                                <span 
                                    class="text-white text-sm w-1/3 pb-1 bg-{{ $usu->status == '1' ? 'green-600' : 'red-700' }} font-semibold px-2 rounded-full"
                                > 
                                    {{ $usu->status == '1' ? 'Activo' : 'Inactivo' }}
                                </span> 
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>