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
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true); // Print text using writeHTMLCell()

// Cobrança
$html = <<<EOD
<table style="border-collapse: collapse; padding-left: 10px; padding-top: 2px; font-size:13px;">
<tr>
<td width="30%" style="border-bottom: 1px solid #8297ac; color:#8297ac;">Cobrar de</td>
<td width="30%" style="border-bottom: 1px solid #8297ac; color:#8297ac;">Enviar para</td>
<td width="40%" style="border-bottom: 1px solid #8297ac; color:#8297ac;">Instruções</td>
</tr>
<tr>
<td width="30%" style="border-bottom: 1px solid #8297ac;">EQUIPAX<br>Daniela Borges<br>Márcio Ferreira</td>
<td width="30%" style="border-bottom: 1px solid #8297ac;">equipax@equipax.com.br<br>daniela@equipax.com.br</td>
<td width="40%" style="border-bottom: 1px solid #8297ac;">Conta Para Transferência:<br>
Banco 260 – Nu Pagamentos S.A.<br>
Agência 0001<br>
Conta Corrente 36499125-7<br>
Marco Antonio de Oliveira Floriano<br>
CPNJ 17013402000123<br>
Chave PIX: 17013402000123 (CNPJ)<br>
</td>
</tr>
</table>
EOD;
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);

// Tabela de Items
$header = array('Serviço', 'Descrição', 'Ref', 'Total');
$item1 = array('Hospedagem Gerenciada WordPress', 'Hospedagem Pro - https://setor9.com.br/servicos/hospedagem-gerenciada-wordpress/Hospedagem - Para pequenos negócios ou Hospedagem Pro - https://setor9.com.br/servicos/hospedagem-gerenciada-wordpress/Hospedagem - Para pequenos negócios ou Hospedagem Pro - https://setor9.com.br/servicos/hospedagem-gerenciada-wordpress/Hospedagem - Para pequenos negócios', 'Contrato Mensal', 'R$50,00');
$item2 = array('Hospedagem Clássica', 'Servidor residencial de 120GB', 'Contrato Mensal', 'R$50,00');
$pdf->printHeader($header);
$pdf->Ln();
$pdf->printItem($item1);
$pdf->printItem($item2);

// Total da Fatura
$subtotal = <<<EOD
<table style="border-collapse: collapse; font-size:13px;">
<tr>
<td width="45%" style="border-bottom: 1px solid #ffffff; color:#8297ac;"></td>
<td width="35%" style="border-bottom: 1px solid #8297ac; color:#8297ac;">Subtotal</td>
<td width="20%" align="right" style="border-bottom: 1px solid #8297ac; color:#000000;">R$100,00</td>
</tr>
</table>
EOD;
$desconto = <<<EOD
<table style="border-collapse: collapse; font-size:13px;">
<tr>
<td width="45%" style="border-bottom: 1px solid #ffffff; color:#8297ac;"></td>
<td width="35%" style="border-bottom: 1px solid #8297ac; color:#8297ac;">Desconto</td>
<td width="20%" align="right" style="border-bottom: 1px solid #8297ac; color:#000000;">R$10,00</td>
</tr>
</table>
EOD;
$total = <<<EOD
<table style="border-collapse: collapse; font-size:13px;">
<tr>
<td width="45%" style="border-bottom: 1px solid #ffffff; color:#8297ac;"></td>
<td width="35%" style="border-bottom: 1px solid #8297ac; color:#8297ac;"><b>Total a ser pago até [15/06/2021]</b></td>
<td width="20%" align="right" style="border-bottom: 1px solid #8297ac; color:#000000;"><b>R$90,00</b></td>
</tr>
</table>
EOD;
$pdf->Ln();
$pdf->writeHTMLCell(0, 0, '', '', $subtotal, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $desconto, 0, 1, 0, true, '', true);
$pdf->Ln();
$pdf->writeHTMLCell(0, 0, '', '', $total, 0, 1, 0, true, '', true);

// save pdf file
$pdf->Output(__DIR__ . '/fatura.pdf', 'I');