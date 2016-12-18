<?php

include("mpdf/mpdf.php");



$mpdf=new mPDF('win-1252','A4','','',20,15,48,25,10,10);
$mpdf->useOnlyCoreFonts = true;    // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Acme Trading Co. - Invoice");
$mpdf->SetAuthor("Acme Trading Co.");
$mpdf->SetWatermarkText("Paid");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
   font-size: 10pt;
 }
p {    margin: 0pt;
}
td { vertical-align: top; }
.items td {
 border-left: 0.1mm solid #000000;
border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
text-align: center;
border: 0.1mm solid #000000;
}
.items td.blanktotal {
background-color: #FFFFFF;
border: 0mm none #000000;
border-top: 0.1mm solid #000000;
border-right: 0.1mm solid #000000;
}
.items td.totals {
text-align: right;
border: 0.1mm solid #000000;
}
</style>

</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
 <table width="100%"><tr>
 <td width="50%" style="color:#0000BB;"><span style="font-weight: bold; font-size:     14pt;">Acme Trading Co.</span><br />123 Anystreet<br />Your City<br />GD12 4LP<br /><span style="font-size: 15pt;">&#9742;</span> 01777 123 567</td>
 <td width="50%" style="text-align: right;">Invoice No.<br /><span style="font-weight: bold; font-size: 12pt;">0012345</span></td>
 </tr></table>
 </htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center;   padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<div style="text-align: right">Date: '.date('jS F Y').'</div>

<table width="100%" style="font-family: serif;" cellpadding="10">
<tr>
<td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt;   color: #555555; font-family: sans;">SOLD TO:</span><br /><br />345 Anotherstreet<br   />Little Village<br />Their City<br />CB22 6SO</td>
<td width="10%">&nbsp;</td>
<td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">SHIP TO:</span><br /><br />345 Anotherstreet<br />Little Village<br />Their City<br />CB22 6SO</td>
</tr>
 </table>

        **<div style="font-size:9px" id="serviced"><b>Service :</b></div>
        <script type="text/javascript">
$(document).ready(function(){
$("#serviced").load("http://website.com/service.php #serviced")
})
</script>**
        <div style="font-size:9px" id="tratyped"><b>Type of Transport :</b></div>
        <div style="font-size:9px" id="custyped"><b>Type of Client</b></div>
        <div style="font-size:9px" id="datepickerd"><b>Date :</b></div>
        <div  style="font-size:9px;display:none" id="timed"><b>Time :</b></div>
        <div  style="font-size:9px" id="departured"><b>Departure Address :</b></div>
        <div style="font-size:9px" id="destinationd"><b>Arrival Address</b></div>

        <div style="font-size:9px" id="passengerd"><b>No. of Passengers :</b></div>
        <div style="font-size:9px" id="shairwelld"><b>No. of Chariwells :</b></div>
        <div style="font-size:9px" id="babycd"><b>No. of Baby Chairs :</b></div>
        <div style="font-size:9px" id="companiond"><b>No. of Companions :</b></div>
        <div style="font-size:9px" id="luggaged"><b>No. of Luggages :</b></div>
        <div style="font-size:9px" id="petd"><b>No. of Pets :</b></div>
        <div style="font-size:9px" id="waitingd"><b>Waiting Time :</b></div>
        <div style="font-size:9px" id="insuranced"><b>Insurance :</b></div>
        <div style="font-size:9px" id="stopd"><b>Stop in Way :</b></div>

        <div style="font-size:9px" id="dis"><b>Distance(app) :</b></div>
        <div style="font-size:9px" id="tim"><b>Time(app) :</b></div>
        <div style="font-size:9px" id="ht"><b>PRICE (HT) :</b></div>
        <div style="font-size:9px" id="vat"><b>VAT :</b></div>
        <div style="font-size:9px" id="ttc"><b>PRICE (TTC) :</b></div>


<div style="text-align: center; font-style: italic;">Payment terms: payment due in 28 days</div>
</body>
</html>
';



$mpdf->WriteHTML($html);

$mpdf->Output(); exit;

exit;

?>