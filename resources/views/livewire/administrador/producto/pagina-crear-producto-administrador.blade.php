<div class="contenedor_pagina_administrador">
    <div class="titulo_pagina">
        <h2>Crear Producto</h2>
    </div>
    <div class="contenedor_formulario">
        <form wire:submit.prevent="crearProducto">
            <!--Estado-->
            <div class="contenedor_elemento_formulario">
                <label for="estado">Estado:</label>
                <div class="estado">
                    <label>
                        <input type="radio" value="1" name="estado" wire:model.defer="estado" id="estado">
                        Si
                    </label>

                    <label>
                        <input type="radio" value="0" name="estado" wire:model.defer="estado" id="estado">
                        No
                    </label>
                </div>
                @error('estado')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Imagenes-->
            <div class="contenedor_elemento_formulario">
                <label for="imagenes">Imagen:</label>
                <div class="contenedor_formulario_imagen">
                    @if ($imagenes)
                        @foreach ($imagenes as $imagen)
                            <img src="{{ $imagen->temporaryUrl() }}">
                        @endforeach
                    @endif
                    <label class="formulario_boton_imagen">
                        <input type="file" wire:model="imagenes" multiple style="display: none" id="imagenes">
                        <a>Subir Imagenes</a>
                    </label>
                </div>

                @error('imagenes.*')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Categorias-->
            <div class="contenedor_elemento_formulario">
                <label for="categoria_id">Categorias:</label>
                <select wire:model="categoria_id" id="categoria_id">
                    <option value="" selected disabled>Seleccione una categoría</option>

                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Subcategorias-->
            <div class="contenedor_elemento_formulario">
                <label for="subcategoria_id">Subcategorias:</label>
                <select wire:model="subcategoria_id" id="subcategoria_id">
                    <option value="" selected disabled>Seleccione una subcategoría</option>

                    @foreach ($subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                    @endforeach
                </select>
                @error('subcategoria_id')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Marcas-->
            <div class="contenedor_elemento_formulario">
                <label for="marca_id">Marcas:</label>
                <select wire:model="marca_id" id="marca_id">
                    <option value="" selected disabled>Seleccione una marca</option>

                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                    @endforeach
                </select>
                @error('marca_id')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Nombre-->
            <div class="contenedor_elemento_formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" wire:model="nombre" id="nombre">
                @error('nombre')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Ruta-->
            <div class="contenedor_elemento_formulario">
                <label for="slug">Ruta:</label>
                <input type="text" wire:model="slug" id="slug">
                @error('slug')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Sku-->
            <div class="contenedor_elemento_formulario">
                <label for="sku">SKU:</label>
                <input type="text" wire:model="sku" id="sku">
                @error('sku')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Precio-->
            <div class="contenedor_elemento_formulario">
                <label for="precio">Precio:</label>
                <input type="number" wire:model="precio" id="precio" step="0.01">
                @error('precio')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Descripcion Corta-->
            <div class="contenedor_elemento_formulario">
                <label for="descripcion">Descripcion Corta:</label>
                <textarea rows="3" wire:model="descripcion" id="descripcion"></textarea>
                @error('descripcion')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Informacion-->
            <div class="contenedor_elemento_formulario" wire:ignore>
                <label for="informacion">Información:</label>
                <textarea rows="3" wire:model="informacion" id="informacion" x-data x-init="ClassicEditor.create($refs.miEditor, {
                        toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'bulletedList']
                    })
                    .then(function(editor) {
                        editor.model.document.on('change:data', () => {
                            @this.set('informacion', editor.getData())
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });" x-ref="miEditor">
                </textarea>
                @error('informacion')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Puntos a ganar-->
            <div class="contenedor_elemento_formulario">
                <label for="puntos_ganar">Puntos a ganar:</label>
                <input type="number" wire:model="puntos_ganar" id="puntos_ganar" step="1">
                @error('puntos_ganar')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Puntos tope canjeo-->
            <div class="contenedor_elemento_formulario">
                <label for="puntos_tope">Puntos tope canjeo:</label>
                <input type="number" wire:model="puntos_tope" id="puntos_tope" step="1">
                @error('puntos_tope')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Tiene Detalle-->
            <div class="contenedor_elemento_formulario">
                <label for="tiene_detalle">¿Tienes detalle?</label>
                <div class="estado">
                    <label>
                        <input type="radio" value="1" name="tiene_detalle" wire:model.defer="tiene_detalle"
                            id="tiene_detalle">
                        Si
                    </label>

                    <label>
                        <input type="radio" value="0" name="tiene_detalle" wire:model.defer="tiene_detalle"
                            id="tiene_detalle">
                        No
                    </label>
                </div>
                @error('tiene_detalle')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Detalle-->
            <div class="contenedor_elemento_formulario" wire:ignore>
                <label for="detalle">Detalle:</label>
                <textarea rows="3" wire:model="detalle" id="detalle" x-data x-init="ClassicEditor.create($refs.miEditor2, {
                        toolbar: ['insertTable', 'bold'],
                        table: {
                            contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                        }
                    })
                    .then(function(editor2) {
                        editor2.model.document.on('change:data', () => {
                            @this.set('detalle', editor2.getData())
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });" x-ref="miEditor2">
                </textarea>
                @error('detalle')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <!--Tipo de Subcategoria-->
            @if ($subcategoria_id)
                @if ($this->subcategoria->tiene_color && !$this->subcategoria->tiene_medida)
                    <p>El producto varia en Color</p>
                @elseif(!$this->subcategoria->tiene_color && $this->subcategoria->tiene_medida)
                    <p>El producto varia en Medida</p>
                @elseif($this->subcategoria->tiene_color && $this->subcategoria->tiene_medida)
                    <p>El producto varia en Color y Medida</p>
                @else
                    <p>El producto no tiene variación</p>
                @endif
            @endif
            <!--Enviar-->
            <div class="contenedor_elemento_formulario formulario_boton_enviar">
                <input type="submit" value="Crear Producto">
            </div>
        </form>
    </div>



</div>
