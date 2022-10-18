const slidericonos = document.querySelector("#contenedor_slider_iconos_items");
let sliderItemsiconos = document.querySelectorAll(".slider_iconos_item");
let slidericonosAnterior = sliderItemsiconos[sliderItemsiconos.length - 1];

const botonIzquieroSlidericonos = document.querySelector("#boton_izquierdo_slider_iconos");
const botonDerechoSlidericonos = document.querySelector("#boton_derecho_slider_iconos");

slidericonos.insertAdjacentElement('afterbegin', slidericonosAnterior);

function Siguienteiconos() {
    let sliderSectionPrimero = document.querySelectorAll(".slider_iconos_item")[0];
    slidericonos.style.marginLeft = "-200%";
    slidericonos.style.transition = "all 0.5s";
    setTimeout(function () {
        slidericonos.style.transition = "none";
        slidericonos.insertAdjacentElement('beforeend', sliderSectionPrimero);
        slidericonos.style.marginLeft = "-100%";
    }, 500);
}

function Anterioriconos() {
    let sliderItemsiconos = document.querySelectorAll(".slider_iconos_item");
    let sliderSectionUltimo = sliderItemsiconos[sliderItemsiconos.length - 1];
    slidericonos.style.marginLeft = "0";
    slidericonos.style.transition = "all 0.5s";
    setTimeout(function () {
        slidericonos.style.transition = "none";
        slidericonos.insertAdjacentElement('afterbegin', sliderSectionUltimo);
        slidericonos.style.marginLeft = "-100%";
    }, 500);
}

botonDerechoSlidericonos.addEventListener('click', function () {
    Siguienteiconos();
});

botonIzquieroSlidericonos.addEventListener('click', function () {
    Anterioriconos();
});

setInterval(function () {
    Siguienteiconos()
}, 10000)
