<div>

    <h2>Crear Nueva Categoria</h2>

    <div>
        <form wire:submit.prevent="crearCategoria" enctype="multipart/form-data">
            <label>
                <p>Nombre: </p> <input type="text" wire:model="crearFormulario.nombre">
                @error('crearFormulario.nombre')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>
            <label>
                <p>Ruta: </p> <input type="text" wire:model="crearFormulario.slug">
                @error('crearFormulario.slug')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>
            <label>
                <p>Icono: </p>
                <span>
                    <code>
                        <?php print htmlentities('<i class="fa-brands fa-facebook"></i>'); ?>
                    </code>
                </span>
                <br>
                <input type="text" wire:model="crearFormulario.icono">

                @error('crearFormulario.icono')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>

            <div>
                <strong>Roles</strong>

                @foreach ($marcas as $marca)
                    <div>
                        <label>
                            <input type="checkbox" name="marcas[]" wire:model.defer="crearFormulario.marcas"
                                value="{{ $marca->id }}">
                            {{ $marca->nombre }}
                        </label>
                    </div>
                @endforeach
                @error('crearFormulario.marcas')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label>
                    <p>Imagen: </p>
                </label>
                @if ($crearFormulario['imagen_ruta'])
                    <img style="width: 100px; height: 100px;"
                        src="{{ $crearFormulario['imagen_ruta']->temporaryUrl() }}">
                @else
                    <img style="width: 100px; height: 100px;" src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}">
                @endif
                <input type="file" wire:model="crearFormulario.imagen_ruta">

                @error('crearFormulario.imagen_ruta')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <br>

            <button style="border: 1px solid #000; padding: 5px" type="submit">Crear</button>


        </form>
    </div>
    <h2>Todas las Categorias</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>
                        <span>
                            {!! $categoria->icono !!}
                        </span>

                        <a href="#">
                            {{ $categoria->nombre }}
                        </a>
                    </td>
                    <td>
                        <div>
                            <a wire:click="editarCategoria('{{ $categoria->slug }}')">Editar</a>
                            <a wire:click="$emit('eliminarCategoriaModal', '{{ $categoria->slug }}')">Eliminar</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!--Modal editar categoria -->
    <x-jet-dialog-modal wire:model="editarFormulario.abierto">

        <x-slot name="title">
            Editar categoría

            <button wire:click="$set('editarFormulario.abierto', false)" wire:loading.attr="disabled">
                x
            </button>
        </x-slot>

        <x-slot name="content">
            <div>
                <label>
                    <p>Imagen: </p>
                </label>
                @if ($editarImagen)
                    <img class="w-full h-64 object-cover object-center" src="{{ $editarImagen->temporaryUrl() }}"
                        alt="">
                @else
                    <img style="width: 100px; height: 100px;"
                        src="{{ $editarFormulario['imagen_ruta'] ? Storage::url($editarFormulario['imagen_ruta']) : '' }}">
                @endif
                <input type="file" wire:model="editarImagen">

                @error('editarFormulario.imagen_ruta')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <label>
                <p>Nombre: </p> <input type="text" wire:model="editarFormulario.nombre">
                @error('editarFormulario.nombre')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>

            <label>
                <p>Ruta: </p> <input type="text" wire:model="editarFormulario.slug">
                @error('editarFormulario.slug')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>

            <label>
                <p>Icono: </p>
                <span>
                    <code>
                        <?php print htmlentities('<i class="fa-brands fa-facebook"></i>'); ?>
                    </code>
                </span>
                <br>
                <input type="text" wire:model="editarFormulario.icono">

                @error('editarFormulario.icono')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>

            <div>
                <strong>Roles</strong>

                @foreach ($marcas as $marca)
                    <div>
                        <label>
                            <input type="checkbox" name="marcas[]" wire:model.defer="editarFormulario.marcas"
                                value="{{ $marca->id }}">
                            {{ $marca->nombre }}
                        </label>
                    </div>
                @endforeach
                @error('editarFormulario.marcas')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </x-slot>
        <x-slot name="footer">

            <button wire:click="actualizarCategoria" wire:loading.attr="disabled"
                wire:target="editarImagen, actualizarCategoria" style="border: 1px solid #000; padding: 5px"
                type="submit">Editar</button>



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
                        'eliminarCategoria', categoriaRuta)

                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    )
                }
            })

        });
    </script>
@endpush
