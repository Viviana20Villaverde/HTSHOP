<div class="contenedor_pagina_administrador">
    <!--Cotenedor formulario-->
    <div class="titulo_pagina">
        <h2>Crear Categoria</h2>
    </div>
    <div class="contenedor_formulario">
        <form wire:submit.prevent="crearCategoria" enctype="multipart/form-data">
            <!--Nombre-->
            <div class="contenedor_elemento_formulario">
                <label for="crearFormulario.nombre">Nombre:</label>
                <input type="text" wire:model="crearFormulario.nombre" id="crearFormulario.nombre">
                @error('crearFormulario.nombre')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Ruta-->
            <div class="contenedor_elemento_formulario">
                <label for="crearFormulario.slug">Ruta:</label>
                <input type="text" wire:model="crearFormulario.slug" id="crearFormulario.slug">
                @error('crearFormulario.slug')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Icono-->
            <div class="contenedor_elemento_formulario">
                <label for="crearFormulario.icono">Icono:</label>
                <code>
                    <?php print htmlentities('<i class="fa-brands fa-facebook"></i>'); ?>
                </code>
                <input type="text" wire:model="crearFormulario.icono" id="crearFormulario.icono">
                @error('crearFormulario.icono')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Marcas-->
            <div class="contenedor_elemento_formulario">
                <label for="crearFormulario.marcas">Marcas:</label>
                <div class="contenedor_formulario_checkbox">
                    @foreach ($marcas as $marca)
                        <label>
                            <input type="checkbox" name="marcas[]" wire:model.defer="crearFormulario.marcas"
                                value="{{ $marca->id }}" id="crearFormulario.marcas">
                            <span> {{ $marca->nombre }}</span>
                        </label>
                    @endforeach
                </div>
                @error('crearFormulario.marcas')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Imagen-->
            <div class="contenedor_elemento_formulario">
                <label for="crearFormulario.imagen_ruta">Imagen:</label>
                <div class="contenedor_formulario_imagen">
                    @if ($crearFormulario['imagen_ruta'])
                        <img src="{{ $crearFormulario['imagen_ruta']->temporaryUrl() }}">
                    @else
                        <img src="{{ asset('imagenes/producto/sin_foto_producto.png') }}">
                    @endif
                    <label class="formulario_boton_imagen">
                        <input type="file" wire:model="crearFormulario.imagen_ruta" style="display: none"
                            id="crearFormulario.imagen_ruta">
                        <a>Subir Imagen</a>
                    </label>
                </div>

                @error('crearFormulario.imagen_ruta')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Enviar-->
            <div class="contenedor_elemento_formulario formulario_boton_enviar">
                <input type="submit" value="Crear Categoria">
            </div>
        </form>
    </div>
    <!--Cotenedor tabla-->
    <div class="titulo_pagina">
        <h2>Categorias</h2>
    </div>
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
                            Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <img class="w-full h-full" src="{{ Storage::url($categoria['imagen_ruta']) }}"
                                        alt="" />
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span>
                                    {!! $categoria->icono !!}
                                </span>
                                {{ $categoria->nombre }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $categoria->slug }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm tabla_controles">
                                <a href="{{ route('administrador.subcategoria', $categoria) }}">
                                    <span><i class="fa-solid fa-eye" style="color: #009eff;"></i></span>
                                    Ver
                                </a>
                                |
                                <a wire:click="editarCategoria('{{ $categoria->slug }}')">
                                    <span><i class="fa-solid fa-pencil" style="color: green;"></i></span>
                                    Editar</a> |
                                <a wire:click="$emit('eliminarCategoriaModal', '{{ $categoria->slug }}')">
                                    <span><i class="fa-solid fa-trash" style="color: red;"></i></span>
                                    Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--Modal editar categoria -->
    <x-jet-dialog-modal wire:model="editarFormulario.abierto">
        <!--Titulo Modal-->
        <x-slot name="title">
            <div class="contenedor_modal">
                <h2>Editar categoría</h2>
                <button wire:click="$set('editarFormulario.abierto', false)" wire:loading.attr="disabled">
                    x
                </button>
            </div>
        </x-slot>
        <!--Contenido Modal-->
        <x-slot name="content">
            <div class="contenedor_formulario_modal">
                <!--Imagen-->
                <div>
                    <label for="editarFormulario.imagen_ruta">Imagen:</label>
                    <div>
                        @if ($editarImagen)
                            <img class="w-full h-64 object-cover object-center"
                                src="{{ $editarImagen->temporaryUrl() }}" alt="">
                        @else
                            <img style="width: 100px; height: 100px;"
                                src="{{ $editarFormulario['imagen_ruta'] ? Storage::url($editarFormulario['imagen_ruta']) : '' }}">
                        @endif
                    </div>
                    <input type="file" wire:model="editarImagen" id="editarFormulario.imagen_ruta">
                    @error('editarFormulario.imagen_ruta')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--Nombre-->
                <div>
                    <label for="editarFormulario.nombre">Nombre:</label>
                    <input type="text" wire:model="editarFormulario.nombre" id="editarFormulario.nombre">
                    @error('editarFormulario.nombre')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--Ruta-->
                <div>
                    <label for="editarFormulario.slug">Ruta:</label>
                    <input type="text" wire:model="editarFormulario.slug" id="editarFormulario.slug">
                    @error('editarFormulario.slug')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--Icono-->
                <div>
                    <label for="editarFormulario.icono">Icono:</label>
                    <code>
                        <?php print htmlentities('<i class="fa-brands fa-facebook"></i>'); ?>
                    </code>
                    <input type="text" wire:model="editarFormulario.icono" id="editarFormulario.icono">
                    @error('editarFormulario.icono')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!--Marcas-->
                <div>
                    <label for="editarFormulario.marcas">Marcas:</label>
                    @foreach ($marcas as $marca)
                        <div>
                            <input type="checkbox" name="marcas[]" wire:model.defer="editarFormulario.marcas"
                                value="{{ $marca->id }}" id="editarFormulario.marcas">
                            {{ $marca->nombre }}
                        </div>
                    @endforeach
                    @error('editarFormulario.marcas')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="actualizarCategoria" wire:loading.attr="disabled"
                wire:target="editarImagen, actualizarCategoria" style="border: 1px solid #000; padding: 5px"
                type="submit">Editar</button>
            <button wire:click="$set('editarFormulario.abierto', false)" wire:loading.attr="disabled"
                type="submit">Cancelar</button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

@push('script')
    <script>
        Livewire.on('eliminarCategoriaModal', categoriaRuta => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar esta categoria.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.categoria.pagina-categoria-administrador',
                        'eliminarCategoria', categoriaRuta);
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    );
                }
            })
        });

        Livewire.on('crearCategoriaMensaje', nombreCategoria => {
            Swal.fire({
                icon: 'success',
                title: 'Categoria ' + nombreCategoria + ' creado correctamente.',
                showConfirmButton: false,
                timer: 2500
            })
        })
    </script>
@endpush
