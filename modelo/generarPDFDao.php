<?php
    require_once ("util/conexion.php");

    class generarPDFDao{ 
        
        
        private $conexion;
        
        
        public function __construct(){
            $objetoConexion = new Conexion();
            $this->conexion = $objetoConexion->conn;
        }

        
        public function listarPrimerValorGrupoDC($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoDC('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoDP($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoDP('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoIE($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoIE('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoIB($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoIB('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        

        public function listarPrimerValorGrupoNEG($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoNEG('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoMEN($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoMEN('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarPrimerValorGrupoIBF($fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarPrimerValorGrupoIBF('$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        public function listarNotaDetalladoDCSET($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoDCSET('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoDCNEG($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoDCNEG('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        public function listarNotaDetalladoDCC($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoDCC('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoDCRS($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoDCRS('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoDPSET($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoDPSET('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoDPNEG($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoDPNEG('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoDPNEG2($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoDPNEG2('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoDPRS($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoDPRS('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoIESET($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIESET('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoIEIT($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIEIT('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoIERS($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIERS('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        public function listarNotaDetalladoIBSET($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIBSET('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        public function listarNotaDetalladoIBOLL($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIBOLL('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoIBRS($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIBRS('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        public function listarNotaDetalladoNEGPEP($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoNEGPEP('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        public function listarNotaDetalladoNEGSC($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoNEGSC('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoNEGN($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoNEGN('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoNEGAD($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoNEGAD('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        public function listarNotaDetalladoNEGRS($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoNEGRS('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }

        
        public function listarNotaDetalladoMENSET($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoMENSET('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    
        public function listarNotaDetalladoMENIT($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoMENIT('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoMENRS($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoMENRS('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoIBFSET($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIBFSET('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
    
        public function listarNotaDetalladoIBFOLL($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIBFOLL('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }
        
        
        public function listarNotaDetalladoIBFRS($asesor,$fecha_mes){
            try{
                $query = $this->conexion->prepare("CALL listarNotaDetalladoIBFRS('$asesor','$fecha_mes%');");
                $query->execute();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            return $query;
        }


    }
?>