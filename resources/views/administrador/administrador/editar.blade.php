<x-administrador-layout>
    <h2>Administrador - Pagina Administrador </h2>
    <br>
    <div>
        <h3>Editar Administrador de: {{ $usuario->administrador->nombre }}</h3>
    </div>
    <br>
    <div>
        <a href="{{ route('administrador.administrador.index') }}">Regresar</a>
    </div>
    @if (session('editar'))
            <p>{{ session('editar') }}</p>
        @endif
    <br>
    <div>
        {!! Form::model($usuario, ['route' => ['administrador.administrador.update', $usuario], 'method' => 'put']) !!}

        @foreach ($roles as $rol)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $rol->id, null, []) !!}
                    {{ $rol->name }}
                </label>
            </div>
        @endforeach

        @error('roles')
            <span>
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {!! Form::submit('Editar Roles') !!}

        {!! Form::close() !!}
    </div>
</x-administrador-layout>
