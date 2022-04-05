<?php
require "./vendor/autoload.php";
require "./customPdfGenerator.php";
 
$pdf = new CustomPdfGenerator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setFontSubsetting(true);
// $pdf->SetFont('dejavusans', '', 12, '', true);
$pdf->SetFont('helvetica', '', 11, '', true);
 
// Primeira Página da Fatura
$pdf->AddPage();
 
// Cabeçalho da Fatura
$pdf->writeHTML("Setor9 - Negócios Online");
// $pdf->writeHTML("<b>DATE:</b> 31/03/2022");
$pdf->writeHTML("www.setor9.com.br");
$pdf->writeHTML("Tel. 12-981924785");
$pdf->writeHTML("E-mail. contato@setor9.com.br");
$pdf->Write(0, "\n\n", '', 0, 'C', true, 0, false, false, 0);

// Título da Fatura
$html = <<<EOD
<table border="0" style="padding-left: 10px; padding-bottom: 10px; padding-top: 10px; color:white; font-size:16px; background-color:#8297ac">
<tr>
<td style="border: 1px solid white;">Fatura [N.º EQX034]</td>
<td style="border: 1px solid white; text-align: right">Vencimento [15/06/2021]</td>
</tr>
</table>
EOD;
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Teste
$html = <<<EOD
<table border="0" style="padding-left: 100px; padding-bottom: 15px;">
<tr>
<td style="border: 1px solid grey;"> One two three </td>
<td style="border: 1px solid grey;"> Four five six </td>
</tr>
</table>
EOD;
// Print text using writeHTMLCell()
$pdf->Write(0, "\n\n", '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
 
// address
$pdf->writeHTML("84 Norton Street,");
$pdf->writeHTML("NORMANHURST,");
$pdf->writeHTML("New South Wales, 2076");
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
 
// bill to
$pdf->writeHTML("<b>BILL TO:</b>", true, false, false, false, 'R');
$pdf->writeHTML("22 South Molle Boulevard,", true, false, false, false, 'R');
$pdf->writeHTML("KOOROOMOOL,", true, false, false, false, 'R');
$pdf->writeHTML("Queensland, 4854", true, false, false, false, 'R');
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
 
// invoice table starts here
$header = array('DESCRIPTION', 'UNITS', 'RATE $', 'AMOUNT');
$data = array(
   array('Item #1','1','100','100'),
   array('Item #2','2','200','400')
);
$pdf->printTable($header, $data);
$pdf->Ln();
 
// comments
$pdf->SetFont('', '', 12);
$pdf->writeHTML("<b>OTHER COMMENTS:</b>");
$pdf->writeHTML("Method of payment: <i>PAYPAL</i>");
$pdf->writeHTML("PayPal ID: <i>katie@paypal.com");
$pdf->Write(0, "\n\n\n", '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML("If you have any questions about this invoice, please contact:", true, false, false, false, 'C');
$pdf->writeHTML("Katie A Falk, (07) 4050 2235, katie@sks.com", true, false, false, false, 'C');
 
// save pdf file
$pdf->Output(__DIR__ . '/invoice#12.pdf', 'I');