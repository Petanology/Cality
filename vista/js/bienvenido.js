var imagenes = new Array(
    "url('img/fondo-2.png')",
    "url('img/fondo-3.png')",
    "url('img/fondo-4.jpg')",
    "url('img/fondo-5.jpg')",
    "url('img/fondo-6.jpg')",
    "url('img/fondo-7.png')"
);

var numAleatorio = Math.round(Math.floor((Math.random() * imagenes.length - 1) + 1));

document.body.style.backgroundImage=imagenes[numAleatorio];