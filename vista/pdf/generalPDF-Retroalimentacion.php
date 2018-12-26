<?php

    // importación de la librería
    require_once("fpdf/fpdf.php");

    class PDFRETROALIMENTACION extends FPDF {
        
        public $tabla;
        public $ultimosDias;
        public $puntaje;
        
        
        /* ----------------------------------------------------- */
        
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
        
        /* ----------------------------------------------------- */
        
        function Header(){
            // Fondo Encabezado
            $this->SetFillColor(255,255,255);
            $this->SetDrawColor(39, 55, 70);
            $this->Cell(0,16,'',1,0,'C',1);

            // Titulo principal
            $this->SetTextColor(45,50,38);
            $this->SetFont('Arial','B',11);
            $this->SetXY(11,13);
            $this->Cell(149,10,"FORMATO DE RETROALIMENTACION NOTAS",0,0,'C',1);
            
            // Linea blanca
            $this->SetDrawColor(39, 55, 70);
            $this->line(160,10,160,26);
            
            // Logo GF
            $this->Image('../img/gf-logo.png',166,12,12);
            
            // Linea blanca
            $this->SetDrawColor(39, 55, 70);
            $this->line(184,15,184,22);
            
            // Logo Cality
            $this->Image('../img/faviconx512-5.png',189,13,11);
            
            // Salto de Línea para tabla
            $this->Ln(20);
        }
        
        
        function Footer(){

            $this->SetY(-15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0 , 10, 'Página ' . $this->PageNo() . ' de {nb}', 0 , 0 , 'C' );
        }
        
        /*
        function ImprimirMes($mesACambiar){
            $fecha = explode("-" , $mesACambiar);
            $ano = $fecha[0]; // obtener el año, ejemplo : 2018
            $mes = trim($fecha[1] , '0'); // obtener el mes, ejemplo : 11
            
            $nomMes = array();
            $nomMes[1] = "ENERO";
            $nomMes[2] = "FEBRERO";
            $nomMes[3] = "MARZO";
            $nomMes[4] = "ABRIL";
            $nomMes[5] = "MAYO";
            $nomMes[6] = "JUNIO";
            $nomMes[7] = "JULIO";
            $nomMes[8] = "AGOSTO";
            $nomMes[9] = "SEPTIEMBRE";
            $nomMes[10] = "OCTUBRE";
            $nomMes[11] = "NOVIEMBRE";
            $nomMes[12] = "DICIEMBRE";
            
            return "$nomMes[$mes] DEL $ano";
        }
        */
    }


?>