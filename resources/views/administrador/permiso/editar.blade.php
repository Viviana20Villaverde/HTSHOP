<x-administrador-layout>
    <h1>Permiso - Editar</h1>
    <br>
    <h3>Editar permiso</h3>
    <br>
    <div>
        <a href="{{ route('administrador.permiso.index') }}">Regresar</a>
    </div>
    <br>

    <div>
        {!! Form::open(['route' => ['administrador.permiso.update', $permiso], 'method' => 'put']) !!}

        <div>
            {!! Form::label('nombre', 'Nombre:') !!}
            {!! Form::text('nombre', $permiso->name, ['placeholder' => 'Escribe el nombre']) !!}
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
                    <input type="checkbox" name="roles[]" value="{{ $rol->id }}" @checked($rol->permissions->contains($permiso->id))>
                    {{ $rol->name }}
                </label>
            </div>
        @endforeach

        @error('roles')
            <span>
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {!! Form::submit('Editar Permiso') !!}

        {!! Form::close() !!}
    </div>

</x-administrador-layout>
