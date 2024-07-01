
<?php
include("db/dbConnection.php");

// Check if payment id is provided via POST
if(isset($_POST['id']) && !empty($_POST['id'])) {
    $payId = $_POST['id'];

    // Query to fetch student, payment, and course details
    $selQuery = "SELECT student_tbl.*, payment_tbl.*, course_tbl.*
                FROM student_tbl
                LEFT JOIN payment_tbl ON payment_tbl.stu_id = student_tbl.stu_id
                LEFT JOIN course_tbl ON course_tbl.course_id = student_tbl.course_id
                WHERE student_tbl.stu_status = 'Active'
                AND payment_tbl.payment_status = 'Active'
                AND student_tbl.entity_id = 3
                AND payment_tbl.pay_id = '$payId'";

    // Execute the first query
    $result1 = $conn->query($selQuery);

    if($result1 && $result1->num_rows > 0) {
        // Fetch student, payment, and course details
        $row = $result1->fetch_assoc();

        // Calculate balance
        $charge = $row['charge'];
        $amount_received = $row['amount_received'];
        $balance = $charge - $amount_received;

        // Prepare data to return as JSON
        $response = array(
            'success' => true,
            'student' => array(
                'id' => $row['stu_id'],
                'name' => $row['first_name'] . ' ' . $row['last_name'],
                'course_name' => $row['course_name'],
                'charge' => $charge,
                'course_duration' => $row['course_month'],
                'amount_received' => $amount_received,
                'balance' => $balance
            )
        );

        // Query to fetch payment history details
        $resSel = "SELECT * FROM payment_history_tbl WHERE pay_id = '$payId'";
        
        // Execute the second query for payment history
        $result2 = $conn->query($resSel);
        
        if($result2 && $result2->num_rows > 0) {
            // Fetch payment history details
            $payment_history = array();
            while($row2 = $result2->fetch_assoc()) {
                $payment_history[] = array(
                    'payment_date' => $row2['history_payment_date'],
                    'amount_received' => $row2['pay_amount'],
                    'payment_method' => $row2['payment_method'],
                    'payHisId' => $row2['pay_his_id']
                );
            }
            $response['payment_history'] = $payment_history;
        } else {
            // Handle error or no payment history found
            $response['payment_history'] = array();
        }

        // Return JSON response
        echo json_encode($response);
    } else {
        // Handle error in first query
        $response = array(
            'success' => false,
            'message' => "Error executing query or no records found: " . $conn->error
        );
        echo json_encode($response);
    }
} else {
    // If payment id is not provided, handle as needed
    $response = array(
        'success' => false,
        'message' => "Payment id not provided"
    );
    echo json_encode($response);
}
?>
