<x-frontend-layout>
    @section('tituloPagina', 'Inicio')
    @include('frontend.inicio.slider-principal')

    @livewire('frontend.productos.slider-producto', ['productos' => $productos])

    @include('frontend.inicio.llamada-accion')

    @livewire('frontend.productos.slider-producto', ['productos' => $productos])

    @include('frontend.inicio.slider-iconos')

    @include('frontend.inicio.slider-testimonio')

    @include('frontend.inicio.slider-metodo-pago')
</x-frontend-layout>
