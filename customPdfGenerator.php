<?php
class CustomPdfGenerator extends TCPDF 
{
    public function Header() 
    {
        $image_file = 'web/logo.png';
        $this->Image($image_file, 165, 20, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false); // arquivo da imagem, posição horizontal, posição vertical, tamanho da imagem
        /*
        $this->SetFont('helvetica', 'B', 20);
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 15, 'Setor9', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        */
    }
 
    public function printFooter() 
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 10, 'setor9.com.br', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function printHeader($header)
    {
        $this->SetFillColor(130, 151, 172);
        $this->SetTextColor(255);
        $this->SetDrawColor(255);
        $this->SetLineWidth(0.1);
        $this->SetFont('helvetica', '', 11);
 
        $w = array(30, 92, 30, 30); // largura de cada coluna
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
    }

    public function printLine()
    {
        $this->Ln();
        $html = <<<EOD
        <table style="border-collapse: collapse;">
        <tr>
        <td width="100%" style="border-bottom: 1px solid #8297ac;"> </td>
        </tr>
        </table>
        EOD;        
        $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);       
    }

    public function printItem($item)
    {
        // set font
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(0);
        // set cell padding
        $this->setCellPaddings(1, 1, 1, 0);
        // set cell margins
        $this->setCellMargins(1, 1, 1, 0);
        // set color for background
        $this->SetFillColor(255, 255, 127);
        // set cell border color
        //$this->SetDrawColor(0);
        //$this->SetLineWidth(0.1);

        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0) 
        $this->MultiCell(30, 5, substr($item[0],0,30), 1, 'L', 0, 0, '', '', true, 0, false, true); 
        $this->MultiCell(90, 5, substr($item[1],0,150), 0, 'L', 0, 0, '', '', true, 0, false, true);
        $this->MultiCell(30, 5, substr($item[2],0,30), 0, 'L', 0, 0, '', '', true, 0, false, true);
        $this->MultiCell(25, 5, substr($item[3],0,25), 0, 'R', 0, 2, '' ,'', true, 0, false, true);
        $this->printLine();
    }
}