const slidermetodo_pago = document.querySelector("#contenedor_slider_metodo_pago_items");
let sliderItemsmetodo_pago = document.querySelectorAll(".slider_metodo_pago_item");
let slidermetodo_pagoAnterior = sliderItemsmetodo_pago[sliderItemsmetodo_pago.length - 1];

const botonIzquieroSlidermetodo_pago = document.querySelector("#boton_izquierdo_slider_metodo_pago");
const botonDerechoSlidermetodo_pago = document.querySelector("#boton_derecho_slider_metodo_pago");

slidermetodo_pago.insertAdjacentElement('afterbegin', slidermetodo_pagoAnterior);

function Siguientemetodo_pago() {
    let sliderSectionPrimero = document.querySelectorAll(".slider_metodo_pago_item")[0];
    slidermetodo_pago.style.marginLeft = "-200%";
    slidermetodo_pago.style.transition = "all 0.5s";
    setTimeout(function () {
        slidermetodo_pago.style.transition = "none";
        slidermetodo_pago.insertAdjacentElement('beforeend', sliderSectionPrimero);
        slidermetodo_pago.style.marginLeft = "-100%";
    }, 500);
}

function Anteriormetodo_pago() {
    let sliderItemsmetodo_pago = document.querySelectorAll(".slider_metodo_pago_item");
    let sliderSectionUltimo = sliderItemsmetodo_pago[sliderItemsmetodo_pago.length - 1];
    slidermetodo_pago.style.marginLeft = "0";
    slidermetodo_pago.style.transition = "all 0.5s";
    setTimeout(function () {
        slidermetodo_pago.style.transition = "none";
        slidermetodo_pago.insertAdjacentElement('afterbegin', sliderSectionUltimo);
        slidermetodo_pago.style.marginLeft = "-100%";
    }, 500);
}

botonDerechoSlidermetodo_pago.addEventListener('click', function () {
    Siguientemetodo_pago();
});

botonIzquieroSlidermetodo_pago.addEventListener('click', function () {
    Anteriormetodo_pago();
});

setInterval(function () {
    Siguientemetodo_pago()
}, 10000)
