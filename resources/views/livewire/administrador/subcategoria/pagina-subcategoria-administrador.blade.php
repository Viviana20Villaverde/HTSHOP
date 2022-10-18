<div class="contenedor_pagina_administrador">
    <!--Cotenedor formulario-->
    <div class="titulo_pagina">
        <h2>Crear Subcategoria</h2>
    </div>
    <div class="contenedor_formulario">
        <form wire:submit.prevent="crearSubcategoria">
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
            <!--Color-->
            <div class="contenedor_elemento_formulario">
                <label for="crearFormulario.slug">¿Tiene color?:</label>
                <div class="contenedor_formulario_checkbox">
                    <label>
                        <input type="radio" value="1" name="tiene_color"
                            wire:model.defer="crearFormulario.tiene_color">
                        Si
                    </label>

                    <label>
                        <input type="radio" value="0" name="tiene_color"
                            wire:model.defer="crearFormulario.tiene_color">
                        No
                    </label>
                </div>
                @error('crearFormulario.tiene_color')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Medida-->
            <div class="contenedor_elemento_formulario">
                <label for="crearFormulario.slug">¿Tiene medida?:</label>
                <div class="contenedor_formulario_checkbox">
                    <label>
                        <input type="radio" value="1" name="tiene_medida"
                            wire:model.defer="crearFormulario.tiene_medida">
                        Si
                    </label>

                    <label>
                        <input type="radio" value="0" name="tiene_medida"
                            wire:model.defer="crearFormulario.tiene_medida">
                        No
                    </label>
                </div>
                @error('crearFormulario.tiene_medida')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Enviar-->
            <div class="contenedor_elemento_formulario formulario_boton_enviar">
                <input type="submit" value="Crear Subcategoria">
            </div>
        </form>
    </div>
    <!--Cotenedor tabla-->
    <div class="titulo_pagina">
        <h2>Subcategorias</h2>
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
                    @foreach ($subcategorias as $subcategoria)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $subcategoria->nombre }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm tabla_controles">
                                <a wire:click="editarSubcategoria('{{ $subcategoria->id }}')"><span><i
                                            class="fa-solid fa-pencil" style="color: green;"></i></span>Editar</a> |
                                <a wire:click="$emit('eliminarSubcategoriaModal', '{{ $subcategoria->id }}')">
                                    <span><i class="fa-solid fa-trash" style="color: red;"></i></span>Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--Modal editar categoria -->
    <x-jet-dialog-modal wire:model="editarFormulario.abierto">
        <x-slot name="title">
            Editar subcategoría

            <button wire:click="$set('editarFormulario.abierto', false)" wire:loading.attr="disabled">
                x
            </button>
        </x-slot>
        <x-slot name="content">
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

            <div>
                <div>
                    <p>¿Está subcategoría necesita especifiquemos color?</p>

                    <div>
                        <label>
                            <input type="radio" value="1" name="tiene_color"
                                wire:model.defer="editarFormulario.tiene_color">
                            Si
                        </label>

                        <label>
                            <input type="radio" value="0" name="tiene_color"
                                wire:model.defer="editarFormulario.tiene_color">
                            No
                        </label>
                    </div>
                </div>

                @error('editarFormulario.tiene_color')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <div>
                    <p>¿Está subcategoría necesita especifiquemos medida?</p>

                    <div>
                        <label>
                            <input type="radio" value="1" name="tiene_medida"
                                wire:model.defer="editarFormulario.tiene_medida">
                            Si
                        </label>

                        <label>
                            <input type="radio" value="0" name="tiene_medida"
                                wire:model.defer="editarFormulario.tiene_medida">
                            No
                        </label>
                    </div>
                </div>

                @error('editarFormulario.tiene_medida')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </x-slot>
        <x-slot name="footer">
            <button wire:click="actualizarSubcategoria" wire:loading.attr="disabled" wire:target="actualizarCategoria"
                style="border: 1px solid #000; padding: 5px" type="submit">Editar</button>
        </x-slot>

    </x-jet-dialog-modal>
</div>

@push('script')
    <script>
        Livewire.on('eliminarSubcategoriaModal', subcategoriaId => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recupar esta subcategoria.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('administrador.subcategoria.pagina-subcategoria-administrador',
                        'eliminarSubcategoria', subcategoriaId)

                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    )
                }
            })
        });

        Livewire.on('crearSubcategoriaMensaje', nombreSubcategoria => {
            Swal.fire({
                icon: 'success',
                title: 'Subcategoria ' + nombreSubcategoria + ' creado correctamente.',
                showConfirmButton: false,
                timer: 2500
            })
        })
    </script>
@endpush
