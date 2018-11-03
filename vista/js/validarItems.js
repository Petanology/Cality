function validarItems(nSeccion){
        
    var j = 1, y = 1;
    var totalItemsSeccion = $("#totalItems" + nSeccion.toUpperCase()).val();

    while(j <= totalItemsSeccion){
        
        if($("input[name='" + nSeccion + "_" + y +"']").val().length != 0){
           
            if(!$("input[name='" + nSeccion + "_" + y + "']").is(":checked")){
            
                return true;
            
            }
                        
            j++;
            
        }
        
        y++;
    
    }
}