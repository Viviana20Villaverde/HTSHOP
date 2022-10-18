<div class="contenedor_pagina_administrador">
    <div class="titulo_pagina">
        <h2>Productos</h2>
    </div>
    <!--Contenedor tabla-->
    @if ($productos->count())
        <div class="py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Imagen</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nombre</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Ruta</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Categoría</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Estado</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Precio</th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        @if ($producto->imagenes->count())
                                            <img class="w-full h-full"
                                                src="{{ Storage::url($producto->imagenes->first()->imagen_ruta) }}"
                                                alt="" />
                                        @else
                                            <img src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $producto->nombre }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $producto->slug }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $producto->subcategoria->categoria->nombre }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @switch($producto->estado)
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Borrador
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Publicado
                                            </span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $producto->precio }} USD
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm tabla_controles">
                                    <a href="#">
                                        <span><i class="fa-solid fa-eye" style="color: #009eff;"></i></span>
                                        Ver
                                    </a>
                                    |
                                    <a href="{{ route('administrador.producto.editar', $producto) }}">
                                        <span><i class="fa-solid fa-pencil" style="color: green;"></i></span>
                                        Editar</a> |
                                    <a>
                                        <span><i class="fa-solid fa-trash" style="color: red;"></i></span>
                                        Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div>
            <p>No hay productos</p>
        </div>
    @endif
    @if ($productos->hasPages())
        <div class="px-6 py-4">
            {{ $productos->links() }}
        </div>
    @endif
</div>
