<div class="contenedor_slider_principal">
    <div class="contenedor_slider_items" id="contenedor_slider_items">
        @foreach ($sliders as $slider)
            <div class="slider_item_principal">
                <a href="{{$slider->link}}">
                    <img src="{{ asset("$slider->imagen_ruta") }}" class="slider_principal_imagen">
                </a>
            </div>
        @endforeach
    </div>
    <div class="slider_principal_boton" id="boton_izquierdo_slider_principal">
        <i class="fa-solid fa-angle-left"></i>
    </div>
    <div class="slider_principal_boton" id="boton_derecho_slider_principal">
        <i class="fa-solid fa-angle-right"></i>
    </div>
</div>
