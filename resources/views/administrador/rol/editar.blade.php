<div>
    <h1>Rol - Editar</h1>
    <br>
    <h3>Editar rol</h3>
    <br>
    <div>
        <a href="{{ route('administrador.rol.index') }}">Regresar</a>
    </div>
    <br>

    <div>
        {!! Form::open(['route' => ['administrador.rol.update', $rol], 'method' => 'put']) !!}

        <div>
            {!! Form::label('nombre', 'Nombre:') !!}
            {!! Form::text('nombre', $rol->name, ['placeholder' => 'Escribe el nombre']) !!}
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
                    <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}" @checked($rol->permissions->contains($permiso->id))>
                    {{ $permiso->name }}
                </label>
            </div>
        @endforeach

        @error('permisos')
            <span>
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {!! Form::submit('Editar Rol') !!}

        {!! Form::close() !!}
    </div>

</div>
