<?
require_once('barcode.php');
require_once('c39object.php');


#####################################################
#   1D barcode
$barcode = "HE IS TOO TWO";
$barcodeimage1 = "barcode1.png";

$barcode1 = new C39Object(600, 300, BCS_ALIGN_CENTER | BCS_IMAGE_PNG, $barcode) or die("Can't create C39Object");
$barcode1->DrawObject(2); # xres = 1: thin bar = 1px; thick bar = 3px
$barcode1->FlushObject($barcodeimage1);
$barcode1->DestroyObject();

#####################################################
# 2D DataMatrix barcode, QR code
$barcodeimage2 = "barcode2.png";

`./iec16022 -S 14 -c "$barcode" -f PNG -o "$barcodeimage2"`;

# test barcode generation success
if(!is_readable($barcodeimage2)) {
    die("Couldn't generate 2D barcode image $barcodeimage2");
}
else{
    echo "barcode2.png is generated successfully!";
}





?>


