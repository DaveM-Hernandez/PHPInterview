<?php
require_once "ConnectionString.php";
require_once "../fpdf/fpdf.php";

function generarPDF() {
    global $con;
    
    $sql = "SELECT * FROM testeo2 ORDER BY Habitacion ASC, precio ASC";
    $result = $con->query($sql);

    if ($result === false) {
        die('Error en la consulta a la base de datos');
    }

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    // Cabecera del PDF
    $pdf->Cell(40, 10, 'Id');
    $pdf->Cell(40, 10, 'Habitacion');
    $pdf->Cell(40, 10, 'Precio');
    $pdf->Cell(40, 10, 'Latitud');
    $pdf->Cell(40, 10, 'Longitud');
    $pdf->Ln();

    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['Id']);
        $pdf->Cell(40, 10, $row['Habitacion']);
        $pdf->Cell(40, 10, $row['Precio']);
        $pdf->Cell(40, 10, $row['Latitud']);
        $pdf->Cell(40, 10, $row['Longitud']);
        $pdf->Ln();
    }
    $date = date('Y-m-d');
    $filePath = '../reportes/report_' . $date . '.pdf';  // Ruta donde se guardará el archivo PDF
    $pdf->Output('F', $filePath);
}


function generarCSV() {
    global $con;
    
    $sql = "SELECT * FROM testeo2 ORDER BY Habitacion ASC, precio ASC";
    $result = $con->query($sql);

    if ($result === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Error en la consulta a la base de datos']);
        exit;
    }
    $date = date('Y-m-d');
    $filename = '../reportes/report_' . $date . '.csv';  // Ruta donde se guardará el archivo CSV
    $file = fopen($filename, 'w');

    // Cabecera del CSV
    fputcsv($file, ['Id','Habitacion', 'Precio','Latitud','Longitud']);

    while ($row = $result->fetch_assoc()) {
        fputcsv($file, [$row['Id'],$row['Habitacion'], $row['Precio'],$row['Latitud'],$row['Longitud']]);
    }

    fclose($file);

    return $filename;
}

















if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $tipo = $input['tipo'];  // Tipo de reporte a generar: 'pdf' o 'csv'
    if ($tipo == 'pdf') {
        $filePath = generarPDF();
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="report_' . date('Y-m-d') . '.pdf"');
        readfile($filePath);
    } 
    
    elseif ($tipo == 'csv') {
        $filePath = generarCSV();
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="report_' . date('Y-m-d') . '.csv"');
        readfile($filePath);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Tipo de reporte no soportado']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
