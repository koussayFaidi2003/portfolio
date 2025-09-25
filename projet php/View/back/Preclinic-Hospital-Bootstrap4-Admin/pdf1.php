<?php
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');

class MYPDF extends TCPDF {

    // Load table data from file
    public function LoadData() {
        // TODO: Ajoutez votre logique pour extraire les données de listdestination.php
        // Utilisez une connexion à la base de données et exécutez une requête SQL
        $data = array(
            array('10', 'guide5'),
            array('11', 'pp'),
            // Ajoutez d'autres lignes de données en conséquence
        );

        return $data;
    }

    // Colored table
    public function ColoredTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');

        // Header
        $w = array(40, 35);
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
            // Utilisation de la syntaxe ?? '' pour traiter les valeurs nulles ou non définies
            $this->Cell($w[0], 6, $row[0] ?? '', 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1] ?? '', 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }

        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

// create new PDF document
$pdf1 = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf1->SetCreator(PDF_CREATOR);
$pdf1->SetAuthor('Nicola Asuni');
$pdf1->SetTitle('PDF listguide.php');
$pdf1->SetSubject('guide List');
$pdf1->SetKeywords('TCPDF, PDF, example, test, guide');

// set default monospaced font
$pdf1->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf1->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf1->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf1->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf1->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf1->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf1->SetFont('helvetica', '', 12);

// add a page
$pdf1->AddPage();

$pdf1->SetFont('helvetica', 'B', 14);
$pdf1->Cell(0, 10, 'List Of Guide', 0, 1, 'C');

// column titles
$header = array('Id ', 'specialite');
// data loading
$data = $pdf1->LoadData();

// print colored table
$pdf1->ColoredTable($header, $data);

// close and output PDF document
$pdf1->Output('pdf1.pdf1', 'I');
?>
