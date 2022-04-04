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
$pdf->SetFont('helvetica', '', 12, '', true);
 
// start a new page
$pdf->AddPage();
 
// date and invoice no
// $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML("Setor9 - Negócios Online");
// $pdf->writeHTML("<b>DATE:</b> 31/03/2022");
$pdf->writeHTML("www.setor9.com.br");
$pdf->writeHTML("Tel. 12-981924785");
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

// Set some content to print
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

//
$html = <<<EOD
<div style="font-size: 18px; background-color:#8297ac;color:white; padding:20px;">
Fatura [N.º EQX034]
</div>
EOD;
// Print text using writeHTMLCell()
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