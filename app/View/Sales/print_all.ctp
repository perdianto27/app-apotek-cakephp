<?php
App::import("Vendor", "xtcpdf");
set_time_limit(300000);
$pdf = new XTCPDF("P", PDF_UNIT, "A4", true, "UTF-8", false);
//---------------------------------------------------------- config start ---------------------------------------------------------------------------
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("Mizno Kruge");
$pdf->SetTitle("Sale Report");
$pdf->SetSubject("Sale");
$pdf->SetKeywords("Sale");
#$pdf->SetHeaderData($logo,20, "","");
#$pdf->setPrintHeader(false);
#$pdf->setPrintFooter(false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
#$pdf->SetDisplayMode($zoom="fullpage", $layout="TwoColumnRight", $mode="UseNone");
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, "", PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 28, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage();
$pdf->SetFont("helvetica", "", 8);
$label = array(array("l" => "id", "w" => 50), array("l" => "name", "w" => 150), array("l" => "phone", "w" => 130), array("l" => "phone_alt", "w" => 130), array("l" => "email", "w" => 200));
//---------------------------------------------------------- config end ---------------------------------------------------------------------------
$html="";
$title="Sale";
if(count($sales)==0){
$html.="<center>TIDAK ADA DATA</center>";
}else{
$html.= '<center><h1>LAPORAN SALE</h1></center>';
$html.= '<table border="1" cellpadding="5" cellspacing="0" width="100%">';
    $html.= "<tr>";
                        $html.="<th>Id</th>";
                                $html.="<th>No</th>";
                                $html.="<th>Date</th>";
                                $html.="<th>Total</th>";
                                $html.="<th>Customer</th>";
                                $html.="<th>Clinic</th>";
                        $html.= "</tr>";

    foreach ($sales as $sale):
    $html.= "<tr>";
                            $html.='<td>'.$sale['Sale']['id'].'</td>';
                                        $html.='<td>'.$sale['Sale']['no'].'</td>';
                                        $html.='<td>'.$sale['Sale']['date'].'</td>';
                                        $html.='<td>'.$sale['Sale']['total'].'</td>';
                                                $html.='<td>'.$sale['Customer']['name'].'</td>';
                                                        $html.='<td>'.$sale['Clinic']['name'].'</td>';
                               
        $html.= "</tr>";
    endforeach;

    $html.= "</table>";
}
$html.= '<p><br/></p><table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <td width="200" align="center">Gudang</td>
        <td width="200" align="center">Penerima</td>
        <td width="200" align="center">Diketahui</td>
    </tr>
    <tr>
        <td align="center"><br><br><br><br><br><br><br></td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
</table>';
$pdf->writeHTML($html, true, false, true, false, "");
//$pdf->lastPage();
$pdf->Output($title .'-'. time().".pdf", "I");
die();
