<x-administrador-layout>
    <h1>Permisos - Index</h1>
    <br>
    <h3>Lista de Permisos</h3>
    <br>
    <div>
        <a href="{{ route('administrador.permiso.crear') }}">Crear Permiso</a>
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
            @forelse($permisos as $key => $permiso)
                <tr>
                    <td>
                        {{ $key }}
                    </td>
                    <td>
                        {{ $permiso->name }}
                    </td>
                    <td>
                        <a href="{{ route('administrador.permiso.editar', $permiso) }}">Editar</a>
                    </td>
                    <td>
                        <form action="{{ route('administrador.permiso.eliminar', $permiso) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button>Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <p>No hay permisos</p>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-administrador-layout>
