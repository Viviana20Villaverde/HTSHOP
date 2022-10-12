|<div class="centrar_contenedor_slider_producto">
    <div id="contenedor_slider_producto">
        <h1 class="slider_producto_titulo">Equipos Odontológicos más vendidos </h1>
        <div id="slider_producto">

            @foreach ($productos as $key => $producto)
                <div class="item_slider_producto">

                    <div class="slider_producto_imagen">
                        <img src="{{ asset($producto->imagenes->first()->imagen_ruta) }}" class="slider_imagen">
                        <span> <i class="fa-solid fa-heart" style="color: #ffa03d; cursor: pointer; hover:#666666;"></i>
                        </span>
                    </div>
                    <h2 class="slider_producto_nombre">{{ $producto->nombre }}</h2>
                    <h2 class="slider_producto_descripcion">{{ Str::limit($producto->descripcion , 50)}}</h2>
                    <p class="slider_producto_precio">{{ $producto->precio }}</p>
                    <button class="slider_producto_boton" >Ver mas {{ $key }}</button>
                </div>
            @endforeach

        </div>

        <span id="boton_siguiente_producto" class="boton_slider_producto">
            <i class="fa-solid fa-angle-left"></i>
        </span>
        <span id="boton_retroceder_producto" class="boton_slider_producto">
            <i class="fa-solid fa-angle-right"></i>
        </span>

    </div>

</div>
