<x-frontend-layout>
    @section('tituloPagina', 'Inicio')
    @include('frontend.inicio.slider-principal')

    @livewire('frontend.productos.slider-producto', ['productos' => $productos])

    @include('frontend.inicio.slider-testimonio')

</x-frontend-layout>
