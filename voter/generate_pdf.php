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
    $image_file = '../assets/images/emb1.png';
    $pdf->Image($image_file, 12, 12, 20, '', 'PNG', '', 'R', false, 300, '', false, false, 0, false, false, false);

    // Fetch data from the database
    include '../include/connect.php'; 
    $username = $_SESSION['user']['Voter_Username']; 
    $sql = mysqli_query($con, "SELECT registration.*, voter.*
                        FROM registration
                        INNER JOIN voter
                        ON registration.rNIC = voter.Voter_NIC
                        WHERE voter.Voter_Username = '$username'");

    while($row = mysqli_fetch_array($sql)) {
        // Add data to the PDF
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 40, '', 0, 1); 
        $pdf->Cell(0, 10, 'Voter Nic: ' . $row['rNIC'], 0, 1);
        $pdf->Cell(0, 10, 'Voter Name: ' . $row['rName'], 0, 1);
        $pdf->Cell(0, 10, 'Grama Niladhari Division: ' . $row['rGramaNiladhariDivision'], 0, 1);
        $pdf->Cell(0, 10, 'Election: ' . $row['electionType'], 0, 1);
        $pdf->Cell(0, 10, 'Date: ' . $row['rRegistrationDate'], 0, 1);
        $pdf->Cell(0, 10, 'Eligibility Status: ' . $row['elegibility_status'], 0, 1);
        // Add a note stating that the data is issued after verification
        // $pdf->SetFont('helvetica', '', 10);
        // $pdf->Cell(0, 10, 'Note: The above data is issued after verification.', 0, 1);

        $pdf->Cell(0, 20, '', 0, 1); 
        $pdf->SetFont('helvetica', '', 12);

        $pdf->Cell(0, 10, 'Government Notice:', 0, 1, 'L'); 
        $pdf->SetFont('helvetica', '', 10);
        $noticeContent = "This is to certify that the above data has been verified and issued by the relevant authorities.";
        $pdf->MultiCell(0, 10, $noticeContent, 0, 'L'); 
        $pdf->Ln(10); 
        $pdf->Cell(0, 10, '', 0, 1);


    }
    $pdf->Output('voter_details.pdf', 'D');
    exit;
}
?>
