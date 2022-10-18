<div class="contenedor_pagina_administrador">
    <!--Cotenedor formulario-->
    <div class="titulo_pagina">
        <h2>Crear Marca</h2>
    </div>
    <div class="contenedor_formulario">
        <form wire:submit.prevent="crearMarca">
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
            <!--Enviar-->
            <div class="contenedor_elemento_formulario formulario_boton_enviar">
                <input type="submit" value="Crear Marca">
            </div>
        </form>
    </div>
    <!--Cotenedor tabla-->
    <div class="titulo_pagina">
        <h2>Marcas</h2>
    </div>
    <div class="py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Nombre</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Acción</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($marcas as $marca)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $marca->nombre }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm tabla_controles">
                                <a wire:click="editarMarca('{{$marca->id}}')"><span><i class="fa-solid fa-pencil"
                                            style="color: green;"></i></span>Editar</a> |
                                <a wire:click="$emit('eliminarMarcaModal', '{{$marca->id}}')">
                                    <span><i class="fa-solid fa-trash" style="color: red;"></i></span>Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--Modal editar -->
    <x-jet-dialog-modal wire:model="editarFomulario.abierto">
        <x-slot name="title">
            <div class="contenedor_modal">
                <h2>Editar categoría</h2>
                <button wire:click="$set('editarFormulario.abierto', false)" wire:loading.attr="disabled">
                    x
                </button>
            </div>
        </x-slot>
        <x-slot name="content">
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
        </x-slot>

        <x-slot name="footer">
            <button wire:click="actualizarMarca" wire:loading.attr="disabled"
                wire:target="actualizarMarca" style="border: 1px solid #000; padding: 5px"
                type="submit">Editar</button>
            <button wire:click="$set('editarFormulario.abierto', false)" wire:loading.attr="disabled"
                type="submit">Cancelar</button>
        </x-slot>

    </x-jet-dialog-modal>
</div>

@push('script')
    <script>
        Livewire.on('eliminarMarcaModal', marcaId => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar esta marca.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.marca.pagina-marca-administrador',
                        'eliminarMarca', marcaId);
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    );
                }
            })
        });

        Livewire.on('crearMarcaMensaje', nombreMarca => {
            Swal.fire({
                icon: 'success',
                title: 'Marca ' + nombreMarca + ' creado correctamente.',
                showConfirmButton: false,
                timer: 2500
            })
        })
    </script>
@endpush
