window.onload = function() {
    contarCaracteresR();
    contarCaracteresM();
};


function contarCaracteresR(){
    document.getElementById("contenedorCaracteres").innerHTML = document.getElementById("descripcion").value.length;
}

function contarCaracteresM(){
    document.getElementById("contenedorCaracteres2").innerHTML = document.getElementById("descripcion2").value.length;
}