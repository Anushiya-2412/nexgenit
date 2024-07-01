<?php
include("../db/dbConnection.php");
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a client
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


// Handle deleting a client
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

// Handle fetching client details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    $editId = $_POST['editId'];

    $selQuery = "SELECT * FROM client_tbl WHERE client_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        $clientDetails = array(
            'client_id' => $row['client_id'],
            'client_name' => $row['client_name'],
            'client_company' => $row['client_company'],
            'client_location' => $row['client_location'],
            'client_email' => $row['client_email'],
            'client_phone' => $row['client_phone'],
            'client_gst' => $row['client_gst'],
        );

        echo json_encode($clientDetails);
    } else {
        $response['message'] = "Error executing query: " . mysqli_error($conn);
        echo json_encode($response);
    }
    exit();
}

// Handle updating client details
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editClient') {
    $editid = $_POST['editid'];
    $editName = $_POST['editname'];
    $editComName = $_POST['editCompany'];
    $editLocation = $_POST['editlocation'];
    $editMobile = $_POST['editmobile'];
    $editEmail = $_POST['editemail'];
    $editGst = $_POST['editgst'];

    $editQuery = "UPDATE `client_tbl` 
    SET `client_name` = '$editName',
        `client_company` = '$editComName',
        `client_location` = '$editLocation',
        `client_email` = '$editEmail',
        `client_phone` = '$editMobile',
        `client_gst` = '$editGst' 
    WHERE `client_id` = $editid";
    $editRes = mysqli_query($conn, $editQuery);

    if ($editRes) {
        $_SESSION['message'] = "Client details updated successfully!";
        $response['success'] = true;
        $response['message'] = "Client details updated successfully!";
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




