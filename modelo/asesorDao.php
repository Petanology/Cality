<?php
    require_once ("util/conexion.php");

    class asesorDao{ 
        
        private $conexion;
        private $registro = true;
        private $modificacion = true;
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }
        
        
        public function registrarAsesor($pIdPersona,$pLiderAsesor,$pUsuarioAsesor,$pContrasenaAsesor) {
            try{
                $query = $this->conexion->prepare("CALL registrarAsesor($pIdPersona,$pLiderAsesor,'$pUsuarioAsesor','$pContrasenaAsesor');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->registro = false; 
            }
            return $this->registro;
        }
        
        
        public function listarTabla(){
            try{
                $query = $this->conexion->prepare("CALL listarTablaAsesor();");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        public function saberExistenciaUsuario($nom_usuario){
            try{
                $query = $this->conexion->prepare("CALL saberExistenciaUsuario('$nom_usuario');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarAsesorGestion($pUsuarioAsesor){
            try{
                $query = $this->conexion->prepare("CALL listarAsesorGestion('$pUsuarioAsesor');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        public function listarItem($pItem){
            try{
                $query = $this->conexion->prepare("call listarItemAsesor($pItem)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarAsesoresActivos(){
            try{
                $query = $this->conexion->prepare("call listarAsesoresActivos()"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function actualizarItem($pIdPersona2,$pGeneroAsesor2,$pTipoDocAsesor2,$pNomsAsesor2,$pApesAsesor2,$pCorreoAsesor2,$pLiderAsesor2,$pUsuarioAsesor2,$pEstadoAsesor2){
            try{
                $query = $this->conexion->prepare("call actualizarAsesor($pIdPersona2,$pGeneroAsesor2,$pTipoDocAsesor2,'$pNomsAsesor2','$pApesAsesor2','$pCorreoAsesor2',$pLiderAsesor2,'$pUsuarioAsesor2',$pEstadoAsesor2)"); 
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
                $this->modificacion = false;
            }
            return $this->modificacion;
        }

        
        // Listar promedio de Asesor DC
        public function listarPromedioAsesorDC($mes,$lider){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioAsesorDC('$mes%','$lider');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Asesor DP
        public function listarPromedioAsesorDP($mes,$lider){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioAsesorDP('$mes%','$lider');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Asesor IE
        public function listarPromedioAsesorIE($mes,$lider){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioAsesorIE('$mes%','$lider');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Asesor IB
        public function listarPromedioAsesorIB($mes,$lider){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioAsesorIB('$mes%','$lider');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar promedio de Asesor NEG
        public function listarPromedioAsesorNEG($mes,$lider){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioAsesorNEG('$mes%','$lider');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    
        // Listar promedio de Asesor MEN
        public function listarPromedioAsesorMEN($mes,$lider){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioAsesorMEN('$mes%','$lider');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    
        // Listar promedio de Asesor IBF
        public function listarPromedioAsesorIBF($mes,$lider){
            try{
                $query = $this->conexion->prepare("CALL listarPromedioAsesorIBF('$mes%','$lider');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    
        // Listar ranking de asesores DC
        public function listarRankingAsesorDC($mes){
            try{
                $query = $this->conexion->prepare("CALL listarRankingAsesorDC('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar ranking de asesores DP
        public function listarRankingAsesorDP($mes){
            try{
                $query = $this->conexion->prepare("CALL listarRankingAsesorDP('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // Listar ranking de asesores IE
        public function listarRankingAsesorIE($mes){
            try{
                $query = $this->conexion->prepare("CALL listarRankingAsesorIE('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar ranking de asesores IB
        public function listarRankingAsesorIB($mes){
            try{
                $query = $this->conexion->prepare("CALL listarRankingAsesorIB('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        // Listar ranking de asesores NEG
        public function listarRankingAsesorNEG($mes){
            try{
                $query = $this->conexion->prepare("CALL listarRankingAsesorNEG('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    
        
        // Listar ranking de asesores MEN
        public function listarRankingAsesorMEN($mes){
            try{
                $query = $this->conexion->prepare("CALL listarRankingAsesorMEN('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        // Listar ranking de asesores IBF
        public function listarRankingAsesorIBF($mes){
            try{
                $query = $this->conexion->prepare("CALL listarRankingAsesorIBF('$mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        
        public function listarInfoAsesorDetalladoMEN($asesor){
            try{
                $query = $this->conexion->prepare("CALL listarInfoAsesorDetalladoMEN('$asesor');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
    
    }
?>