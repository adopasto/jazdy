<?php
require('fpdf/fpdf.php'); // Include the FPDF library

class PDF extends FPDF
{
    function Header()
    {
        // Add header content if needed
    }

    function Footer()
    {
        // Add footer content if needed
    }
}

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial', 'B', 16); // Use the "Arial" font
$pdf->Cell(0, 10, 'Exported Records PDF', 0, 1, 'C');

// Fetch records from the database
$servername = "mysql80.r1.websupport.sk";
$username = "admin_dhzo";
$password = "Dharma108";
$dbname = "Zaznam_jazd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM jazda";
$result = $conn->query($query);

// Table headers
$pdf->SetFont('Arial', 'B', 12); // Use the "Arial" font
$pdf->Cell(30, 10, utf8_decode('Meno'), 1);
$pdf->Cell(30, 10, utf8_decode('Vozidlo'), 1);
$pdf->Cell(30, 10, utf8_decode('Posádka'), 1);
$pdf->Cell(30, 10, utf8_decode('KM pred jazdou'), 1);
$pdf->Cell(30, 10, utf8_decode('KM po jazde'), 1);
$pdf->Cell(30, 10, utf8_decode('Dátum'), 1);
$pdf->Cell(30, 10, utf8_decode('Čas odjazdu'), 1);
$pdf->Cell(30, 10, utf8_decode('Čas príjazdu'), 1);
$pdf->Cell(30, 10, utf8_decode('Cieľ jazdy'), 1);
$pdf->Cell(30, 10, utf8_decode('Účel jazdy'), 1);
$pdf->Cell(30, 10, utf8_decode('Detaily jazdy'), 1);
$pdf->Ln();

// Add records to the PDF
$pdf->SetFont('Arial', '', 12); // Use the "Arial" font
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, utf8_decode($row['Meno']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['Vozidlo']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['Posádka']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['KM pred jazdou']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['KM po jazde']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['Dátum']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['Čas odjazdu']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['Čas príjazdu']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['Cieľ jazdy']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['Účel jazdy']), 1);
        $pdf->Cell(30, 10, utf8_decode($row['Detaily jazdy']), 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No records found'), 1, 1, 'C');
}

$conn->close();

// Output PDF
$pdf->Output();
?>