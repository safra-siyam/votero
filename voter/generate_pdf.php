<?php
session_start();

// Check if the generate PDF button is clicked
if(isset($_POST['generate_pdf'])) {
    // Include TCPDF library
    require_once('../include/tcpdf/tcpdf.php');

    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Voter Details');
    $pdf->SetSubject('Voter Details');
    $pdf->SetKeywords('Voter, Details, PDF');

    // Add a page
    $pdf->AddPage();

    // Fetch data from the database
    include '../include/connect.php'; // Include database connection
    $username = $_SESSION['user']['Voter_Username']; // Get the username from session
    $sql = mysqli_query($con, "SELECT registration.*, voter.*
                        FROM registration
                        INNER JOIN voter
                        ON registration.rNIC = voter.Voter_NIC
                        WHERE voter.Voter_Username = '$username'");

    while($row = mysqli_fetch_array($sql)) {
        // Add data to the PDF
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'Voter Nic: ' . $row['rNIC'], 0, 1);
        $pdf->Cell(0, 10, 'Voter Name: ' . $row['rName'], 0, 1);
        $pdf->Cell(0, 10, 'Grama Niladhari Division: ' . $row['rGramaNiladhariDivision'], 0, 1);
        $pdf->Cell(0, 10, 'Election: ' . $row['electionType'], 0, 1);
        $pdf->Cell(0, 10, 'Date: ' . $row['rRegistrationDate'], 0, 1);
        $pdf->Cell(0, 10, 'Eligibility Status: ' . $row['elegibility_status'], 0, 1);
    }

    // Close and output PDF document
    $pdf->Output('voter_details.pdf', 'D');
    exit;
}
?>
