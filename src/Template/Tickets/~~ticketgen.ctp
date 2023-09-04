<?php 
class xtcpdf extends TCPDF {
 
}


 //$subject=$this->Comman->findexamsubjectsresult($students['id'],$students['section']['id'],$students['acedmicyear']);

   $this->set('pdf', new TCPDF('P','mm','A4'));
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->AddPage();



$pdf->SetFont('', '', 9, '', 'false');


  //pr($ticketgen); die;

 
$html.='
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Result</title><link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">';
$html.='</head>
<body style="font-family:"trebuchet MS",Arial,Helvetica,sans-serif;">



<table style="width:100%">
 <tr> 
    <td  style=" height:20px; line-height:20px; font-size:12px">Event Name</td>
    <td  style=" height:20px; line-height:20px; font-size:12px">Start Date</td>
    <td  style=" height:20px; line-height:20px; font-size:12px">End Date</td>
    <td  style=" height:20px; line-height:20px; font-size:12px">Event Number</td>
    <td  style=" height:20px; line-height:20px; font-size:12px">Venue</td>
    <td  style=" height:20px; line-height:20px; font-size:12px">QR Code</td>
    <br>
    <br>
    
  </tr>


<tr>

<td>'.$ticketgen['ticket']['event']['name'].'</td>
<td>'.$ticketgen['ticket']['event']['date_from'].'</td>
<td>'.$ticketgen['ticket']['event']['date_to'].'</td>
<td>'.$ticketgen['ticket_num'].'</td>
<td>'.$ticketgen['ticket']['event']['location'].'</td>
<td>'.$ticketgen['qrcode'].'</td>

</tr>
    
  
</table>






<br>

</body>
</html>';


$pdf->WriteHTML($html, true, false, true, false, '');

echo $pdf->Output('Result');
exit;
?>



?>
