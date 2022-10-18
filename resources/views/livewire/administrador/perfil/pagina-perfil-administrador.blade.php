<div>
    <h2>Administrador - Pagina Perfil </h2>
    <br>
    <div>
        <h3>Perfil de: {{ $usuario->email }}</h3>
    </div>
    <br>
    <div>
        <form wire:submit.prevent="editarPerfilAdministrador" enctype="multipart/form-data">
            <div>
                <label>
                    <p>Imagen: </p>
                </label>
                @if ($nueva_imagen_ruta)
                    <img style="width: 100px; height: 100px;" src="{{ $nueva_imagen_ruta->temporaryUrl() }}">
                @elseif($imagen_ruta)
                    <img style="width: 100px; height: 100px;"
                        src="{{ Storage::url($usuario->administrador->imagen_ruta) }}">
                @else
                    <img style="width: 100px; height: 100px;" src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}">
                @endif
                <input type="file" wire:model="nueva_imagen_ruta">
            </div>

            <label>
                <p>Nombre: </p> <input type="text" wire:model="nombre">
            </label>
            <label>
                <p>Apellido: </p> <input type="text" wire:model="apellido">
            </label>
            <label>
                <p>Celular: </p> <input type="text" wire:model="celular">
            </label>
            <br>
            <br>
            <button style="border: 1px solid #000; padding: 5px" type="submit">Actualizar</button>
        </form>
    </div>

</div>
