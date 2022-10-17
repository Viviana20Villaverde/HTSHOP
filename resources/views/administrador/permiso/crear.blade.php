<x-administrador-layout>
    <h1>Permiso - Crear</h1>
    <br>
    <h3>Crear permiso</h3>
    <br>
    <div>
        <a href="{{ route('administrador.permiso.index') }}">Regresar</a>
    </div>
    <br>

    <div>
        {!! Form::open(['route' => 'administrador.permiso.store']) !!}

        <div>
            {!! Form::label('nombre', 'Nombre:') !!}
            {!! Form::text('nombre', null, ['placeholder' => 'Escribe el nombre']) !!}
            @error('nombre')
                <span>
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <strong>Roles</strong>

        @foreach ($roles as $rol)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $rol->id, null, ['style' => 'margin-top: 5px;']) !!}
                    {{ $rol->name }}
                </label>
            </div>
        @endforeach

        @error('permisos')
            <span>
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {!! Form::submit('Crear Permiso') !!}

        {!! Form::close() !!}
    </div>

</x-administrador-layout>
