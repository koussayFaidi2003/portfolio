<?php
include 'C:/xampp/htdocs/INTEG MALEK OUMA/Controller/BilletC.php';
// Include the main TCPDF library (search for the installation path).
require_once('C:/xampp/htdocs/INTEG MALEK OUMA/View/back/Preclinic-Hospital-Bootstrap4-Admin/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {
    
    // Load data from the listBillet() function
    public function LoadData() {
        // TODO: Add your logic to extract data from the listBillet() function
        // Use a database connection and execute an SQL query

        // Assuming listBillet() returns an array similar to the one you used before
        $b = new BilletC();
        $billets = $b->listBillet();

        // Convert the data to the required format for the PDF
        $data = array();
        foreach ($billets as $billet) {
            $data[] = array(
                $billet['idBillet'],
                $billet['flightNumber'],
                $billet['UserName'],
                $billet['Date_Purchase'],
                $billet['Seat_Number'],
                $billet['Price']
            );
        }

        return $data;
    }

    // Colored table for billet data
    public function ColoredTable($header, $data) {
        // Colors, line width, and bold font
        $this->SetFillColor(0, 102, 255); 
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 51, 128); 
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');

        // Header
        $w = array(30, 35, 35, 40, 25, 20);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = 0;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row[4], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row[5], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }

        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('PDF listBillet.php');
$pdf->SetSubject('Billet List');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'List Of Tickets', 0, 1, 'C');

// column titles
$header = array('Id Billet', 'Flight Number', 'User Name', 'Date Purchase', 'Seat Number', 'Price');
// data loading
$data = $pdf->LoadData();

// print colored table for billet data
$pdf->ColoredTable($header, $data);

// close and output PDF document
$pdf->Output('pdf.pdf', 'I');
?>