<?php
// Include database connection file
include("db/dbConnection.php");

// Check if employee id is provided
if(isset($_POST['id']) && $_POST['id'] != '') {
    $empId = $_POST['id'];

    // Prepare and execute the SQL query to fetch employee details
    $selQuery = "SELECT a.*,b.* FROM `employee_tbl` AS a LEFT JOIN admin_tbl AS b ON a.emp_user_id=b.user_id WHERE a.emp_id =$empId";
    $result = $conn->query($selQuery);

    if($result) {
        // If query is successful, fetch the employee details
        $row = $result->fetch_assoc();
        
        // Create an associative array to hold employee details
        $employeeDoc = array(
            'empId' => $row['emp_id'],
            'username' => $row['username'],
            'aadhar'=>$row['emp_aadhar'],
            'pan'=>$row['emp_pan'],
            'bank'=>$row['emp_bank'],
        );

        echo json_encode($employeeDoc);
    } else {
        // If query fails, return an error message
        echo "Error executing query: " . $conn->error;
    }
} else {
    // If employee id is not provided, return an error message
    echo "Employee ID not provided.";
}
?>
