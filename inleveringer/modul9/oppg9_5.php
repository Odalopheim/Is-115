<?php
//Laster in FPDI biblioteket
//FPDI bygger på FPDF og importere en eksisterende PDF som mal
require_once __DIR__ . '/vendor/autoload.php';

use setasign\Fpdi\Fpdi;

//Hette pdf tepleten og logo filen 
$pdfTemplate = __DIR__ . '/filer/Innlevering 9_fakturamal.pdf';
$logoFile = __DIR__ . '/filer/Logo.png';

// Håndter informasjons innsending
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $issuer  = trim($_POST['issuer'] ?? 'Min Bedrift AS');
    $customer = trim($_POST['customer'] ?? 'Kunde Navn');
    $address = trim($_POST['address'] ?? 'Kundens adresse');
    $product = trim($_POST['product'] ?? 'Produkt / tjeneste');
    $price   = trim($_POST['price'] ?? '0');
    $total   = trim($_POST['total'] ?? $price);

    if (!file_exists($pdfTemplate)) {
        echo "Mal-pdf ikke funnet: " . htmlspecialchars($pdfTemplate);
        exit;
    }

    // Opprett ny PDF fra malen
    $pdf = new Fpdi();

    $pageCount = $pdf->setSourceFile($pdfTemplate);
    // Importer alle sider og tegn tekst på første side
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $tplId = $pdf->importPage($pageNo);
        $size = $pdf->getTemplateSize($tplId);
        $orientation = ($size['width'] > $size['height']) ? 'L' : 'P';
        $pdf->AddPage($orientation, [$size['width'], $size['height']]);
        $pdf->useTemplate($tplId);

        if ($pageNo === 1) {
            // Sett logo øverst i midten hvis den finnes (juster størrelse/posisjon ved behov)
            if (file_exists($logoFile)) {
                $logoWidth = 15; 
                $pageW = $pdf->GetPageWidth();
                $x = ($pageW - $logoWidth) / 8;
                $pdf->Image($logoFile, $x, 10, $logoWidth);
            }

            // Velg font og størrelse
            $pdf->SetFont('Helvetica', '', 11);
            $pdf->SetTextColor(0,0,0);

            //setter korrekte posisjoner og skriver inn dataene
            // Fakturautsteder
            $pdf->SetXY(20, 60);
            $pdf->Cell(0, 6, "Fakturautsteder: " . $issuer, 0, 1);

            // Kunde
            $pdf->SetXY(20, 70);
            $pdf->Cell(0, 6, "Kunde: " . $customer, 0, 1);

            // Adresse 
            $pdf->SetXY(20, 76);
            $pdf->MultiCell(0, 6, "Adresse: " . $address, 0, 'L');

            // Produkt og pris 
            $pdf->SetXY(20, 95);
            $pdf->Cell(120, 6, "Produkt: " . $product, 0, 0);
            $pdf->Cell(0, 6, "Pris: " . $price . " NOK", 0, 1, 'R');

            // Totalsum
            $pdf->SetXY(20, 108);
            $pdf->SetFont('Helvetica', 'B', 12);
            $pdf->Cell(0, 8, "Totalsum: " . $total . " NOK", 0, 1);
        }
    }

    // Send generert PDF til nettleser inline
    $pdf->Output('I', 'fyllt_faktura.pdf');
    exit;
}
?>
<!doctype html>
<html lang="no">
<head>
  <meta charset="utf-8">
  <title>Fyll faktura</title>
</head>
<body>
  <h1>Fyll faktura (bruk malen)</h1>
  <form method="post">
    <label>Fakturautsteder:<br><input name="issuer" required></label><br><br>
    <label>Navn på kunde:<br><input name="customer" required></label><br><br>
    <label>Kundens adresse:<br><input name="address" required></label><br><br>
    <label>Produkt:<br><input name="product" required></label><br><br>
    <label>Pris (NOK):<br><input name="price" required></label><br><br>
    <label>Totalsum (NOK):<br><input name="total" required></label><br><br>
    <button type="submit">Generer PDF</button>
  </form>
</body>
</html>