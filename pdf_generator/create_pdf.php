<?
#   will create temp file
#   delete the temp file if path changes

#define("_SYSTEM_TTFONTS", "font/");

require_once("tfpdf.php");

#   initial
#   class tFPDF defined in tfpdf.php
$pdf = new tFPDF('P','pt','Letter');

$pdf->SetAuthor("Hang");
$pdf->SetTitle("My PDF");
$pdf->SetCreator("Hang script");
$pdf->SetSubject("My PDF");


#   language
if(isset($_REQUEST['locale']))
    $locale = $_REQUEST['locale'];

#   Chinese default
$locale = in_array($locale, array('english', 'chinese', 'japanese')) ? $locale : 'chinese';


if($locale == 'chinese' || $locale == 'japanese'){
    $pdf->AddFont('Standard','','WenQuanYiMicroHeiLight.ttf',true);
    $pdf->AddFont('Standard','B','WenQuanYiMicroHei.ttf',true);
}
else{
    $pdf->AddFont('Standard','','DejaVuSansCondensed.ttf',true);
    $pdf->AddFont('Standard','B','DejaVuSansCondensed-Bold.ttf',true);
}


$pdf->SetLeftMargin(3.0);
$pdf->SetRightMargin(3.0);
$pdf->SetAutoPageBreak(true, 3.0);

$pdf->AddPage();


#   format variable
$xl = 75;   #left margin
$xr = 540;  #right margin
$yb = 760;  #bottom margin

#   margin of page
#$pdf->Rect(30, 25, 545, 740);

#####################################################
#   logo
$logo = "logo.jpg";
$pdf->SetXY($xl, 40);
$pdf->Image($logo, 208, $pdf->GetY(), 195, 40);
  
#####################################################
$lineheight = 17;

#   address
$str = '1234 Abc Ave, Def, GH 98765';
$pdf->SetTextColor(0, 0, 128);
$pdf->SetFont('Standard','',11);
$pdf->SetXY($xl, $pdf->GetY()+45);
$pdf->Cell($xr-$xl, $lineheight, $str, 0, 1, 'C');

$pdf->Line($xl, $pdf->GetY(), $xr, $pdf->GetY());

#####################################################
#   title
$str = "My PDF";
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Standard', 'B', 20);
$pdf->SetXY($xl, $pdf->GetY()+8);
$pdf->Cell($xr-$xl, 22, $str, 0, 1, 'C');


##
$str = "Hello World...";
$pdf->SetFont('Standard', '', 13);
$pdf->SetXY($xl, $pdf->GetY());
$pdf->Cell($xr-$xl, 28, $str, 0, 1, 'L');


##
$str = "有木有~";
$pdf->SetFont('Standard', 'B', 14);
$pdf->SetXY($xl, $pdf->GetY());
$pdf->Cell($xr-$xl, 28, $str, 0, 1, 'L');


##
$str = "面倒くさい!";
$pdf->SetFont('Standard', '', 15);
$pdf->SetXY($xl, $pdf->GetY());
$pdf->Cell($xr-$xl, 28, $str, 0, 1, 'L');





#####################################################
#   footer
$str = "ph: 123.456.7890 fx: 123.456.7899 toll free 1.800.800.8080 web: www.hello.com";
$pdf->SetTextColor(0, 0, 128);
$pdf->SetFont('Standard', '', 8);
$pdf->SetXY($xl, $yb);
$pdf->Cell($xr-$xl, $lineheight, $str, 0, 1, 'C');


#####################################################
#   output

$output = "mypdf.pdf";
$pdf->Output($output, 'F');


# output Notification as pdf
header("Pragma: no-cache");
header("Cache-control: private");
header("Content-type: application/pdf");
header("Content-disposition: attachment; filename=$output");

readfile($output);


unlink($output);

?>

