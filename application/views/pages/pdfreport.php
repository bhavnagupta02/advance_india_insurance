<?php
/*tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);*/
/*$title = "Insurance Summary";
$obj_pdf->SetTitle($title);*/

// $sitelogo = '<img src="'.base_url('assets/images/logo.png').'">';
// $sitelogo = base_url('assets/images/logo.png');
// $obj_pdf->SetLogo($sitelogo);

/*$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);*/
//$obj_pdf->AddPage();
/*var_dump(array(
    "test" => "demo"
));*/
//ob_start();
// we can have any view part here like HTML, PHP etc
//
/*$content = '<h1>HTML Example-</h1>'.$exp_policy_data['id'].'
<h2>List</h2>
List example:
<ol>
    <li><b>bold text</b></li>
    <li><i>italic text</i></li>
    <li><u>underlined text</u></li>
    <li><b>b<i>bi<u>biu</u>bi</i>b</b></li>
    <li><a href="http://www.tecnick.com" dir="ltr">link to http://www.tecnick.com</a></li>
    <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br />Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>
    <li>SUBLIST
        <ol>
            <li>row one
                <ul>
                    <li>sublist</li>
                </ul>
            </li>
            <li>row two</li>
        </ol>
    </li>
    <li><b>T</b>E<i>S</i><u>T</u> <del>line through</del></li>
    <li><font size="+3">font + 3</font></li>
    <li><small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal</li>
</ol>
</div>';*/

//$content = ob_get_contents();
/*ob_end_clean();
//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->writeHTML($content, true, false, true, false, '');
//$obj_pdf->writeHTML($content);
$pdf_filename = 'insurance_policy'.time().'.pdf';
$url = base_url('uploads/insurance_pdf/');
//print_r($url.$pdf_filename);
$obj_pdf->Output($url.$pdf_filename, 'I');*/

/*Sql Query

$pdf_status = 1;
            $pdf_stmt = $user_home->runQuery("UPDATE form_user SET pdf_status=:pdf_status,pdf_name=:pdf_name  WHERE form_id=:form_id");
       
            $pdf_stmt->bindparam(":pdf_status",$pdf_status);
            $pdf_stmt->bindparam(":pdf_name",$pdf_filename);
            $pdf_stmt->bindparam(":form_id",$last_id);
        
            $pdf_stmt->execute();
            $user_home->redirect("thank_you.php?id=".$last_id);

*/

//$obj_pdf->Output($pdf_filename, 'D');    /// for download
//$obj_pdf->Output('output.pdf', 'I');
?>