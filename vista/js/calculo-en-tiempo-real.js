function calcular(sector){
    
    var totalItemsSeccion = document.getElementById("totalItems" + sector.toUpperCase()).value;
    var porcentajeSeccion = document.getElementById("valorSeccion" + sector.toUpperCase()).value;
    
    var i = 1 , f = 1 , itemPrueba, nAprobadosSeccion=0, totalSeccion, cadena;
    
    while(i <= totalItemsSeccion){
        
        itemPrueba = document.getElementsByName(sector + "_" + f);

        if(itemPrueba[0].value == 1){
            
            i++;
            
            if(itemPrueba[0].checked){
                nAprobadosSeccion++;
            }
        }
        
        f++;
    }
    var operacion = nAprobadosSeccion*porcentajeSeccion/totalItemsSeccion; 
    totalSeccion = operacion.toFixed(1);
    document.getElementById("acum_" + sector).innerHTML = totalSeccion + "%";
}



























