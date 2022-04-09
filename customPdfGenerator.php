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
        
        // corpo da tabela
        foreach($data as $row) {
            $this->Cell($w[0], 10, $row[0], 'LR', 0, 'L', $fill); // largura, altura, linha
            $this->Cell($w[1], 10, $row[1], 'LR', 0, 'R', $fill);
            $this->Cell($w[2], 10, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 10, number_format($row[3]), 'LR', 0, 'R', $fill);
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

    public function printNewTable()
    {
        $this->SetFillColor(130, 151, 172);
        $this->SetTextColor(255);
        $this->SetDrawColor(255);
        $this->SetLineWidth(0.1);
        $this->SetFont('helvetica', '', 11);
        
        // set cell padding
        $this->setCellPaddings(1, 1, 1, 1);

        // set cell margins
        $this->setCellMargins(1, 1, 1, 1);

        // set color for background
        $this->SetFillColor(255, 255, 127);

        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

        // set some text for example
        $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

        // Multicell test
        $this->MultiCell(55, 5, '[LEFT] '.$txt, 1, 'L', 1, 0, '', '', true);
        $this->MultiCell(55, 5, '[RIGHT] '.$txt, 1, 'R', 0, 1, '', '', true);
        $this->MultiCell(55, 5, '[CENTER] '.$txt, 1, 'C', 0, 0, '', '', true);
        $this->MultiCell(55, 5, '[JUSTIFY] '.$txt."\n", 1, 'J', 1, 2, '' ,'', true);
        $this->MultiCell(55, 5, '[DEFAULT] '.$txt, 1, '', 0, 1, '', '', true);

        $this->Ln(4);

        // Vertical alignment
        $this->MultiCell(55, 40, '[VERTICAL ALIGNMENT - TOP] '.$txt, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'T');
        $this->MultiCell(55, 40, '[VERTICAL ALIGNMENT - MIDDLE] '.$txt, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'M');
        $this->MultiCell(55, 40, '[VERTICAL ALIGNMENT - BOTTOM] '.$txt, 1, 'J', 1, 1, '', '', true, 0, false, true, 40, 'B');

        $this->Ln(4);

        // set some text for example
        $txt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.

        Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.';

        // print a blox of text using multicell()
        $this->MultiCell(80, 5, $txt."\n", 1, 'J', 1, 1, '' ,'', true);

        // AUTO-FITTING

        // set color for background
        $this->SetFillColor(255, 235, 235);

        // Fit text on cell by reducing font size
        $this->MultiCell(55, 60, '[FIT CELL] '.$txt."\n", 1, 'J', 1, 1, 125, 145, true, 0, false, true, 60, 'M', true);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        // CUSTOM PADDING

        // set color for background
        $this->SetFillColor(255, 255, 215);

        // set font
        $this->SetFont('helvetica', '', 8);

        // set cell padding
        $this->setCellPaddings(2, 4, 6, 8);

        $txt = "CUSTOM PADDING:\nLeft=2, Top=4, Right=6, Bottom=8\nLorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue.\n";

        $this->MultiCell(55, 5, $txt, 1, 'J', 1, 2, 125, 210, true);
    }
}