var imagenes = new Array(
    "url('img/fondos-bienvenido/1.png')",
    "url('img/fondos-bienvenido/2.jpg')",
    "url('img/fondos-bienvenido/3.jpg')",
    "url('img/fondos-bienvenido/4.jpg')",
    "url('img/fondos-bienvenido/5.jpg')",
    "url('img/fondos-bienvenido/6.jpg')",
    "url('img/fondos-bienvenido/7.jpg')",
    "url('img/fondos-bienvenido/8.jpg')"
);

var numAleatorio = Math.round(Math.floor((Math.random() * imagenes.length - 1) + 1));

document.getElementById("contenedor-principal").style.backgroundImage=imagenes[numAleatorio];