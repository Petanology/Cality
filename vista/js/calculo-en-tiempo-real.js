var totalItemsSeccion1 = document.getElementById("totalItemsDCS").value;
var porcentajeSeccion1 = document.getElementById("valorSeccionTabla1").value;

function calcular(){
    
    var i = 1 , f = 1 , itemPrueba, nAprobadosSeccion1=0, totalSeccion1;
    
    while(i <= totalItemsSeccion1){
        
        itemPrueba = document.getElementsByName("dcs_"+f);

        if(itemPrueba[0].value == 1){
            
            i++;
            
            if(itemPrueba[0].checked){
                nAprobadosSeccion1++;
            }
        }
        
        f++;
    }
    
    totalSeccion1 = nAprobadosSeccion1*porcentajeSeccion1/totalItemsSeccion1;
    document.getElementById("acumSET").innerHTML = totalSeccion1; 
    
}
















/*
document.getElementById("total").innerHTML = 1+2+1 . "%";
*/