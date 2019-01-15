function calcular(sector){
    
    var totalItemsSeccion = document.getElementById("totalItems" + sector.toUpperCase()).value;
    var porcentajeSeccion = document.getElementById("valorSeccion" + sector.toUpperCase()).value;
    
    var i = 1 , f = 1 , itemPrueba, nAprobadosSeccion=0, totalSeccion, cadena;
    
    while(i <= totalItemsSeccion){
        
        itemPrueba = document.getElementsByName(sector + "_" + f);
        
        if(typeof itemPrueba[0] !== 'undefined'){
            //if(itemPrueba[0].value == 1){

                if(itemPrueba[0].checked){
                    nAprobadosSeccion++;
                }

                i++;
            //}
        }
           
        
        f++;
    }
    
    var operacion = nAprobadosSeccion*porcentajeSeccion/totalItemsSeccion; 
    
    totalSeccion = operacion.toFixed(1);
    
    document.getElementById("acum_" + sector + "_input").value = totalSeccion;
    
    document.getElementById("acum_" + sector).innerHTML = totalSeccion + "%";
    calculoAcumTotal();
}



function calculoAcumTotal(){
    
    var acum=0; 
    var notaParcialGrupo = document.getElementsByClassName("notaParcialGrupo");
    
    for(w=0; w<notaParcialGrupo.length; w++){
        acum += parseFloat(notaParcialGrupo[w].innerHTML.split("%",1));
    }
    
    document.getElementById("acumTotal").innerHTML = acum + "%";

    
    if(acum>=0 && acum<=68){
        document.getElementById("contenedorAcumTotal").style.background="#E74C3C";
    }else 
    if(acum>=69 && acum<=84){
        document.getElementById("contenedorAcumTotal").style.background="#F4D03F";
    }else 
    if(acum>=85 && acum<=100){
        document.getElementById("contenedorAcumTotal").style.background="#2ECC71";
    }
}























