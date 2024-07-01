<?php
include("../db/dbConnection.php");
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];



// Handle adding a payment
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addClient') {
    $name = $_POST['name'];
    $comName = $_POST['Company'];
    $location = $_POST['location'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gst = $_POST['gst'];

    $query = "INSERT INTO client_tbl (entity_id, client_name, client_company, client_location, client_email, client_phone, client_gst) 
              VALUES (1, '$name', '$comName', '$location', '$email', '$mobile', '$gst')"; 
    $res = mysqli_query($conn, $query);

    if ($res) {
        $_SESSION['message'] = "Client details added successfully!";
        $response['success'] = true;
        $response['message'] = "Client details added successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in adding client details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}


// Handle deleting a payment
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $queryDel = "UPDATE client_tbl SET client_status = 'Inactive' WHERE client_id = $id";
    $reDel = mysqli_query($conn, $queryDel);

    if ($reDel) {
        $_SESSION['message'] = "Client details have been deleted successfully!";
        $response['success'] = true;
        $response['message'] = "Client details have been deleted successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in deleting client details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}
 
// Handle fetching payment details for editing
if (isset($_POST['editId']) && $_POST['editId'] != ''){
    $editId = $_POST['editId'];

    $selQuery = "SELECT a.*,b.*,c.* FROM payment_tbl as a
     LEFT JOIN
      student_tbl AS b 
      ON a.stu_id =b.stu_id 
      LEFT JOIN 
      course_tbl AS c
       ON b.course_id = c.course_id 
       WHERE a.pay_id =$editId AND a.payment_status ='Active';";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $course_month     = $row['course_month'];

        if($course_month ==3){
            $course_fees = $row['course_fees_3'];  
        }elseif($course_month ==6){
            $course_fees = $row['course_fees_6'];  
        }else{
            $course_fees = $row['course_fees_12'];  
        }

        $balance = $course_fees - $row['amount_received'];

        $paymentDetails = array(
            'pay_id' => $row['pay_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'course_name' => $row['course_name'],
            'course_month' => $course_month,
            'course_fees' => $course_fees,
            'amount_received' => $balance,
            
            
        );

        echo json_encode($paymentDetails);
    } else {
        $response['message'] = "Error executing query: " . mysqli_error($conn);
        echo json_encode($response);
    }
    exit();
}

// Handle updating payment details
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editPayment') {
    $payeditid = $_POST['payeditid'];
    $addfees = $_POST['addfees'];
    $date = $_POST['date'];
    $paymentmtd = $_POST['paymentmtd'];
    

    $fees_select ="SELECT amount_received,charge FROM `payment_tbl` WHERE pay_id= $payeditid;";
    $fees_res = mysqli_query($conn , $fees_select);
    $fees = mysqli_fetch_array($fees_res , MYSQLI_ASSOC);
    $received_amt =$fees['amount_received'];
    $charge_amt=$fees['charge'];

    
    
    $amount = $received_amt + $addfees;
    if($charge_amt==$amount)
    {
        $paymentStauts="Paid";
    }
    elseif($charge_amt>$amount){
        $paymentStauts="Partially Paid";
    }
    else{
        $paymentStauts="Unpaid";
    }

    $editQuery = "UPDATE `payment_tbl` SET amount_received = '$amount',    
    pay_status='$paymentStauts'
     WHERE pay_id ='$payeditid'";
    if($editRes = mysqli_query($conn, $editQuery) === true){
        $insert_payment_sql ="INSERT INTO `payment_history_tbl`
        ( `pay_id`
        , `history_payment_date`
        , `pay_amount`
        , `payment_method`) 
        VALUES 
        ('$payeditid'
        ,'$date'
        ,'$addfees'
        ,'$paymentmtd')";
        $fees_res = mysqli_query($conn , $insert_payment_sql);
    }

    if ($fees_res) {
        $_SESSION['message'] = "Payment details updated successfully!";
        $response['success'] = true;
        $response['message'] = "Payment details updated successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in updating client details!";
        $response['message'] = "Error: " .  $row = mysqli_fetch_assoc($result);
    }

    echo json_encode($response);
    exit();
}

// Default response for invalid actions
$response['message'] = "Invalid action or no action specified.";
echo json_encode($response);
exit();




