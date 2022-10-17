<x-administrador-layout>
    <h1>Rol - Crear</h1>
    <br>
    <h3>Crear rol</h3>
    <br>
    <div>
        <a href="{{ route('administrador.rol.index') }}">Regresar</a>
    </div>
    <br>

    <div>
        {!! Form::open(['route' => 'administrador.rol.store']) !!}

        <div>
            {!! Form::label('nombre', 'Nombre:') !!}
            {!! Form::text('nombre', null, ['placeholder' => 'Escribe el nombre']) !!}
            @error('nombre')
                <span>
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <strong>Permisos</strong>

        @foreach ($permisos as $permiso)
            <div>
                <label>
                    {!! Form::checkbox('permisos[]', $permiso->id, null, ['style' => 'margin-top: 5px;']) !!}
                    {{ $permiso->name }}
                </label>
            </div>
        @endforeach

        @error('permisos')
            <span>
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {!! Form::submit('Crear Rol') !!}

        {!! Form::close() !!}
    </div>

</x-administrador-layout>
