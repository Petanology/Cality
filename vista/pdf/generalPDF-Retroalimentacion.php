<?php

    // importación de la librería
    require_once("fpdf/fpdf.php");

    class PDFRETROALIMENTACION extends FPDF {
        
        public $tabla;
        public $codigo;
        public $version;
        public $ultimosDias;
        public $minimo;
        public $maximo;
        public $fechaVersion;
        public $corte;
        var $B=0;
        var $I=0;
        var $U=0;
        var $HREF='';
        var $ALIGN='';
        var $widths;
        var $aligns;
        
        function SetWidths($w)
        {
            //Set the array of column widths
            $this->widths=$w;
        }

        function SetAligns($a)
        {
            //Set the array of column alignments
            $this->aligns=$a;
        }

        function Row($data)
        {
            //Calculate the height of the row
            $nb=0;
            for($i=0;$i<count($data);$i++)
                $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
            $h=2*$nb;
            //Issue a page break first if needed
            $this->CheckPageBreak($h);
            //Draw the cells of the row
            for($i=0;$i<count($data);$i++)
            {
                $w=$this->widths[$i];
                $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                //Save the current position
                $x=$this->GetX();
                $y=$this->GetY();
                //Draw the border
                $this->Rect($x,$y,$w,$h);
                //Print the text
                $this->MultiCell($w,1.9,$data[$i],0,$a);
                //Put the position to the right of the cell
                $this->SetXY($x+$w,$y);
            }
            //Go to the next line
            $this->Ln($h);
        }

        function CheckPageBreak($h)
        {
            //If the height h would cause an overflow, add a new page immediately
            if($this->GetY()+$h>$this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }

        function NbLines($w,$txt)
        {
            //Computes the number of lines a MultiCell of width w will take
            $cw=&$this->CurrentFont['cw'];
            if($w==0)
                $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            $s=str_replace("\r",'',$txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb)
            {
                $c=$s[$i];
                if($c=="\n")
                {
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
                }
                if($c==' ')
                    $sep=$i;
                $l+=$cw[$c];
                if($l>$wmax)
                {
                    if($sep==-1)
                    {
                        if($i==$j)
                            $i++;
                    }
                    else
                        $i=$sep+1;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                }
                else
                    $i++;
            }
            return $nl;
        }

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
                        $this->Cell(0,3,$e,0,1,'C');
                    else
                        $this->Write(3,$e);
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
                
        function Header(){
            $this->SetFont('Arial','B',7);
            $this->SetFillColor(244, 246, 246);
            $this->SetDrawColor(133, 146, 158);
            $this->SetTextColor(70,70,70);

            $this->SetXY(11,11);
            $this->Cell(0,12,'',1,0,'C',0);
            
            $this->SetXY(11,11);
            $this->Cell(50,4,'CODIGO: ' . $this->codigo,1,0,'C',1);
            
            $this->SetXY(11,15);
            $this->Cell(50,4,'FECHA: ' . $this->fechaVersion,1,0,'C',1);
            
            $this->SetXY(11,19);
            $this->Cell(50,4,'VERSION: ' . $this->version,1,0,'C',1);

            $this->SetTextColor(45,50,38);
            $this->SetFont('Arial','B',11);
            
            $this->SetFillColor(235, 237, 239);
            
            $this->SetXY(61,11);
            $this->Cell(100,12,"FORMATO DE RETROALIMENTACION NOTAS",1,0,'C',1);
            
            
            $this->SetFillColor(255,255,255);
            $this->SetXY(160,11);
            $this->Cell(46,12,"",1,0,'C',1);
            
            // Logo GF
            $this->Image('../img/gf-logo.png',168,12,10);
            
            $this->line(184,14,184,20);
            
            // Logo Cality
            $this->Image('../img/faviconx512-5.png',191,13,8);
            
            // Salto de Línea para tabla
            $this->Ln(20);
        }
        
        
        function Footer(){

            $this->SetY(-15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0 , 10, 'Página ' . $this->PageNo() . ' de {nb}', 0 , 0 , 'C' );
        }
    }


?>