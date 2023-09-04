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



<table style="width:100%" class="table table-bordered">
 <tr> 
<td rowspan="6" style="width:40%; border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
<table width="100%">
<tr>
<td width="7%"></td>
<td width="86%"><div>
<img src="http://flashticket.co-opselfservice.com/images/ticket_imgbig.jpg" style="max-width:100%;">
</div>
<div>
<img src="http://flashticket.co-opselfservice.com/images/ticket_barcode.jpg" style="max-width:100%; width:50px;">
</div>
</td>
<td width="7%"></td>
</tr>
</table>

</td>

<td style="width:30%;  border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000; ">
<h6 style="color:#999999; text-align:left; font-size:9px; margin:0px;">Event</h6>
<h2 style="text-align:right; font-size:11px; color:#000; margin:0px;">2019 Magical<br> Kenya Open</h2>
</td>

<td rowspan="3" style="width:30%  border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000; " >
<table width="100%">
<tr>
<td width="7%"></td>
<td width="86%"><img src="http://flashticket.co-opselfservice.com/images/ticket_imagesmall.jpg" style="max-width:100%; "></td>
<td width="7%"></td>
</tr>
</table>

</td>
    
  </tr>

<tr>
<td style="width:30%;  border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
<h6 style="color:#999999; text-align:left; font-size:9px; margin:0px;">Date+Time</h6>
<h2 style="text-align:right; font-size:11px; color:#000; margin:0px;">14/03/2019 06:00 -<br>
17/03/2019 00:00</h2>
</td>
</tr>
<tr>
<td style="width:30%;  border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000;">
<h6 style="color:#999999; text-align:left; font-size:9px; margin:0px;">Location</h6>
<h2 style="text-align:right; font-size:11px; color:#000; margin:0px;">2019 Magical<br> Kenya Open</h2>
</td>
</tr>


<tr>
<td rowspan="2" style=" border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000; ">
<h6 style="color:#999999; text-align:left; font-size:9px; margin:0px;">Order Info
</h6>
<h2 style="text-align:right; font-size:11px; color:#000; margin:0px;">Ordered on Thursday,07
March 2019 12:21
Order ID: 167278 #2 of #5
Payment Status:
Delivered</h2>
</td>

<td style=" border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000; ">
<h6 style="color:#999999; text-align:left; font-size:9px; margin:0px;">Type
</h6>
<h2 style="text-align:right; font-size:11px; color:#000; margin:0px;">SEASON TICKET
Complimentary </h2>
</td>
</tr>

<tr>
<td style=" border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000; ">
<h6 style="color:#999999; text-align:left; font-size:9px; margin:0px;">Type
</h6>
<h2 style="text-align:right; font-size:11px; color:#000; margin:0px;">SEASON TICKET
Complimentary </h2>
</td>
</tr>

<tr>
<td style=" border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000; ">
<h6 style="color:#999999; text-align:left; font-size:9px; margin:0px;">Ticket ID

</h6>
<h2 style="text-align:right; font-size:11px; color:#000; margin:0px;">2748-167278-2-87811
 </h2>
</td>

<td style=" border-left:2px solid #000; border-right:2px solid #000; border-bottom:2px solid #000; border-top:2px solid #000; ">
<h6 style="color:#999999; text-align:left; font-size:9px; margin:0px;">ID Number
</h6>
<h2 style="text-align:right; font-size:11px; color:#000; margin:0px;"> </h2>
</td>
</tr>
';
foreach($ticketgen as $value){ //pr($value); die;

	
	
$df=$value['qrcode'];
	
$html.='';
    
  }
$html.='</table>






<br>
<br>
<table width="100%" style="font-size:9px;">
<tr>
<td width="75%">
<h6 style="font-size:9px;">TERMS AND CONDITIONS</h6>
<ul>
<li>Management reserves the right to admission at the event.</li>
<li>Only tickets bought directly through www.ticketsasa.com shall be deemed
valid. We shall not be held responsible for tickets re-sold or purchased through
a third party.</li>
<li>All sales are final. No cancellations, refunds or exchanges.</li>
<li>You can print your ticket or come with it on your mobile phone.</li>
<li>Please Note: Once the barcode has been scanned at the gate, it ceases to
be valid. To avoid duplication, kindly keep your ticket safe and do not share it. </li>
<li>holder of this ticket voluntarily assumes all risks incident to the event,
including risk of lost, stolen or damaged property or personal injury</li>
<li>Public Parking available, free of charge, at the WATERFRONT KAREN
MALL.</li>
</ul>
<h6 style="font-size:9px;">Shuttles from the WaterFront Karen Mall to/from the Karen Country Club will be
provided free of charge.</h6>
</td>
<td width="2%"></td>
<td width="23%">
<h6 style="text-align:center; font-size:9px;">SUPPORT</h6>
<h6 style="text-align:center; font-size:9px;">Email: info@ticketsasa.com</h6>
<h6 style="text-align:center; font-size:9px;">Tel: +254 739 077 204/+254 705 804 226</h6>
</td>
</tr>
</table>
</body>
</html>';


$pdf->WriteHTML($html, true, false, true, false, '');

echo $pdf->Output('Result');
exit;
?>



?>
