<?php
// Include the database connection file
include "db/dbConnection.php";
include "fpdf186/fpdf.php";

// Get the empId from the query parameter
$id = isset($_GET['payHisId']) ? $_GET['payHisId'] : null;

// SQL query to fetch the data
$select_sql = "SELECT * FROM `payment_history_tbl` AS a 
LEFT JOIN payment_tbl AS b ON a.pay_id = b.pay_id 
LEFT JOIN student_tbl AS c ON b.stu_id = c.stu_id 
LEFT JOIN course_tbl AS d ON c.course_id = d.course_id  
WHERE a.pay_his_id = ?;"; // Use parameterized query to prevent SQL injection

// Prepare the statement
$stmt = $conn->prepare($select_sql);
$stmt->bind_param("i", $id); // Bind the $id parameter
$stmt->execute();
$result = $stmt->get_result();

// Check if data is fetched
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $name = $first_name . ' ' . $last_name;
        $course_name = $row['course_name'];
        $pay_his_id = $row['pay_his_id'];
        $course_month     = $row['course_month'];
        $received_amount = $row['amount_received'];
        $pay_amount = $row['pay_amount'];

        if($course_month ==3){
            $course_fees = $row['course_fees_3'];  
        }elseif($course_month ==6){
            $course_fees = $row['course_fees_6'];  
        }else{
            $course_fees = $row['course_fees_12'];  
        }

        $balance = $course_fees - $row['amount_received'];

        // Add additional fields as needed
    }
} else {
    die('No results found.');
}
$conn->close();

// Include the FPDF library


// Create a class extending FPDF
class PDF extends FPDF
{
    // Header
    function Header()
    {
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 10, 'Invoice Bill', 0, 1, 'C');
        $this->Ln(5);
        $this->Image('./image/logo.png', 10, 4, 50);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'NEXGEN IT ACADEMY', 0, 1, 'R');
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'RORIRI IT PARK, Nallanathanpuram, Kalakad, Keela Karuvelankulam, Tamil Nadu 627502', 0, 1, 'R');
        $this->Ln(10);
    }

    // Footer
    function Footer()
    {
        $this->SetY(-70);
        $this->SetFont('Arial', 'B', 12);
        $this->Ln(15);
        $this->SetFont('Arial', 'B', 12);
        $this->Image('./image/seal.png', 90, 195, 45);
        $this->Image('./image/sign.png', 150, 205, 40);
        $this->Cell(0,10,"Authorized Signature",0,1,"R");
        $this->Ln(10);
        $this->SetY(-25);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, "", 'B', 1);
        $this->SetY(-23);
        $this->Cell(0, 10, "Mobile : 7845593579  || email : contact@roririsoft.com   ", 0, 1, "L");
        $this->SetY(-23);
        $this->Cell(0, 6, "Thank You From Nexgen It Academy", 0, 1, "R");
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Create a new PDF instance
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


// Set font for the document
$pdf->SetFont('Arial', '', 12);

// Add invoice content
$pdf->Cell(0, 10, 'Name: ' . $name, 'T', 0, 'L');
$pdf->Cell(0, 10, 'Date: ' . date('Y-m-d'), 'T', 1, 'R');
$pdf->Cell(0, 10, 'Invoice Number: INV-00' . $pay_his_id, 0, 0,'L');
$pdf->Cell(0, 10, 'GST No: 33AANCR0590E1ZG', 0, 1, 'R');

$pdf->Ln();

// Add item details to the table
$pdf->SetX(20);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(50, 10, 'Course Name', 1, 0, 'C');
$pdf->Cell(40, 10, 'Course Duration', 1, 0, 'C');
$pdf->Cell(40, 10, 'Course Fees', 1, 0, 'C');
$pdf->Cell(40, 10, 'Amount', 1, 1, 'C');


$pdf->SetFont('Arial', '', 10);
// Assuming you have some data to populate
$totalAmt = 0; // Initialize total amount
// Loop to add each course (assuming you have multiple courses in the fetched data)
$pdf->SetX(20);
$pdf->Cell(50, 10, $course_name, 'RLT', 0, 'C'); // Course Name
$pdf->Cell(40, 10, $course_month .' Month', 'RLT', 0, 'C'); // Replace with actual duration
$pdf->Cell(40, 10, $course_fees, 'RLT', 0, 'C'); // Replace with actual fees
$pdf->Cell(40, 10, $pay_amount, 'RLT', 1, 'C'); // Total Price (calculate as needed)

for ($i = 0; $i < 5; $i++) { 
    $pdf->SetX(20);
    $pdf->Cell(50, 10,"", 'LR');
    $pdf->Cell(40, 10, "", 'LR'); 
    $pdf->Cell(40, 10, "", 'LR'); 
    $pdf->Cell(40, 10, "", 'LR');  
    $pdf->Ln();
}

// Calculate totals
$total = $totalAmt; // Sum all amounts (add your logic here)
$grandTotal = $total; // Add any additional calculations if needed

// Add subtotal, tax, and grand total to the table
$pdf->SetX(20);
$pdf->Cell(130, 10, 'Total Fees:', 1, 0, 'R');
$pdf->Cell(40, 10,  number_format($course_fees, 2), 1, 1, 'R');
$pdf->SetX(20);
$pdf->Cell(130, 10, 'Pay Fees:', 1, 0, 'R');
$pdf->Cell(40, 10,  number_format($pay_amount, 2), 1, 1, 'R');
$pdf->SetX(20);
$pdf->Cell(130, 10, 'Total Pay Fees:', 1, 0, 'R');
$pdf->Cell(40, 10,  number_format($received_amount, 2), 1, 1, 'R');
$pdf->SetX(20);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(130, 10, 'Balance:', 1, 0, 'R');
$pdf->Cell(40, 10, number_format($balance, 2), 1, 1, 'R');

// Output the PDF
$pdf->Output("NexgenInvoice.pdf", 'D'); // Force download the PDF

?>
