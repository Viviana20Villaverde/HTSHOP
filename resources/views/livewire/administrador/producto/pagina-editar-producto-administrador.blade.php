<div class="contenedor_pagina_administrador">
    <div class="titulo_pagina">
        <h2>Editar Producto</h2>
    </div>

    <div class="contenedor_formulario" x-data>
        <!--Dropzone-->
        <div class="contenedor_elemento_formulario">
            <form action="{{ route('administrador.producto.files', $producto) }}" method="POST" class="dropzone"
                id="my-awesome-dropzone"></form>
        </div>
        <div class="contenedor_elemento_formulario">
            <label for="nombre">Imagenes:</label>
            @if ($producto->imagenes->count())
                @foreach ($producto->imagenes as $imagen)
                    <li wire:key="image-{{ $imagen->id }}">
                        <img src="{{ Storage::url($imagen->imagen_ruta) }}" alt="">
                        <button wire:click="eliminarImagen({{ $imagen->id }})" wire:loading.attr="disabled"
                            wire:target="eliminarImagen({{ $imagen->id }})">
                            x
                        </button>
                    </li>
                @endforeach
            @endif
        </div>

        @livewire('administrador.producto.componente-estado-producto', ['producto' => $producto], key('estado-producto-' . $producto->id))

        <form wire:submit.prevent="editarProducto">

        </form>
    </div>

</div>
