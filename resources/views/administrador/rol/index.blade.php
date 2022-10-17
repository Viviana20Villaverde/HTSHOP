<x-administrador-layout>

    <div>
        <h1>Rol - Index</h1>
        <br>
        <h3>Lista de Roles</h3>
        <br>
        <div>
            <a href="{{ route('administrador.rol.crear') }}">Crear Rol</a>
            @if (session('crear'))
                <p>{{ session('crear') }}</p>
            @endif
            @if (session('eliminar'))
                <p>{{ session('eliminar') }}</p>
            @endif
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $key => $rol)
                    <tr>
                        <td>
                            {{ $key }}
                        </td>
                        <td>
                            {{ $rol->name }}
                        </td>
                        <td>
                            <a href="{{ route('administrador.rol.editar', $rol) }}">Editar</a>
                        </td>
                        <td>
                            <form action="{{ route('administrador.rol.eliminar', $rol) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <p>No hay roles</p>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-administrador-layout>
