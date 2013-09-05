<?

# 2D DataMatrix barcode, QR code
$barcode2 = "HE IS TOO TWO";
$barcodeimage2 = "barcode2.png";

`./iec16022 -S 14 -c "$barcode2" -f PNG -o "$barcodeimage2"`;

# test barcode generation success
if(!is_readable($barcodeimage2)) {
    die("Couldn't generate 2D barcode image $barcodeimage2");
}
else{
    echo "barcode2.png is generated successfully!";
}





?>


