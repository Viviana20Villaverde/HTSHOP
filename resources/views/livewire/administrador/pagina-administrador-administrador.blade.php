<div>
    <h2>Administrador - Pagina Administrador </h2>
    <br>
    <div>
        <h3>Todos los Administradores</h3>
    </div>
    <br>
    <div>
        <a href="{{ route('administrador.administrador.crear') }}">Crear Administrador</a>
        @if (session('crear'))
            <p>{{ session('crear') }}</p>
        @endif
    </div>
    <br>
    <div>
        <h4>Buscador</h4>
        <input wire:model='buscar' type="text" placeholder="Busca un administrador">
    </div>
    <br>
    @if ($administradores->count())
        <div>
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($administradores as $key => $administrador)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $administrador->nombre }}</td>
                            <td>{{ $administrador->correo }}</td>
                            <td>{{ $administrador->rol }}</td>
                            <td>
                                <a href="{{ route('administrador.administrador.editar', $administrador->user_id) }}">Editar
                                </a>
                                <a wire:click="'eliminarUsuario', '{{ $administrador->user_id }}'">Eliminar
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div>
                {{ $administradores->links() }}
            </div>
        </div>
    @else
        <div>
            <p>No hay administradores</p>
        </div>
    @endif
</div>
