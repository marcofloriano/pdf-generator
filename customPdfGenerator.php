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
 
    public function Footer() 
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 15);
        $this->Cell(0, 10, 'setor9.com.br', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
 
    public function printTable($header, $data)
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
        $this->Ln();
 
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
 
        // table data
        $fill = 0;
        $total = 0;
 
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
            $total+=$row[3];
        }
 
        $this->Cell($w[0], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, '', 'LR', 0, 'R', $fill);
        $this->Cell($w[2], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 6, '', 'LR', 0, 'R', $fill);
        $this->Ln();
 
        $this->Cell($w[0], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, '', 'LR', 0, 'R', $fill);
        $this->Cell($w[2], 6, 'TOTAL:', 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 6, $total, 'LR', 0, 'R', $fill);
        $this->Ln();
 
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}