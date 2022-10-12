<div>
    <h1>Administrador - Crear</h1>
    <br>
    <h3>Crear administrador</h3>
    <br>
    <div>
        <a href="{{ route('administrador.administrador.index') }}">Regresar</a>
    </div>
    <br>

    <div>
        {!! Form::open(['route' => 'administrador.administrador.store']) !!}
        <div>
            {!! Form::label('nombre', 'Nombre:') !!}
            {!! Form::text('nombre', null, ['placeholder' => 'Escribe el nombre']) !!}
            @error('nombre')
                <span>
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div>
            {!! Form::label('email', 'Correo:') !!}
            {!! Form::email('email', null, ['placeholder' => 'Escribe el correo']) !!}
            @error('email')
                <span>
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            {!! Form::label('password', 'Contraseña:') !!}
            {!! Form::password('password', ['placeholder' => 'Escribe la contraseña']) !!}
            @error('password')
                <span>
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {!! Form::submit('Crear Administrador') !!}

        {!! Form::close() !!}
    </div>

</div>
