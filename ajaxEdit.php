<?php
// Include database connection file
include("db/dbConnection.php");

// Check if employee id is provided
if(isset($_POST['id']) && $_POST['id'] != '') {
    $empId = $_POST['id'];

    // Prepare and execute the SQL query to fetch employee details
    $selQuery = "SELECT 
    employee_tbl.*, 
    emp_additional_tbl.* 
FROM 
    employee_tbl
LEFT JOIN 
    emp_additional_tbl 
ON 
    emp_additional_tbl.emp_id = employee_tbl.emp_id WHERE employee_tbl.emp_id =$empId";
    $result = $conn->query($selQuery);

    if($result) {
        // If query is successful, fetch the employee details
        $row = $result->fetch_assoc();
        
        // Create an associative array to hold employee details
        $employeeDetails = array(
            'empId' => $row['emp_id'],
            'first_name' => $row['emp_first_name'],
            'last_name' =>$row['emp_last_name'],
            'company_email' => $row['emp_company_email'],
            'personal_email' => $row['emp_personal_email'],
            'emp_joining_date' => $row['emp_joining_date'],
            'married_status' => $row['emp_married_status'],
            'emp_dob' => $row['emp_dob'],
            'emp_role' => $row['emp_role'],
            'mobile' => $row['emp_mobile'],
            'address' => $row['emp_address'],
           'aadhar'=>$row['emp_aadhar'],
           'bank'=>$row['emp_bank'],

           
            // Add other fields as needed
        );

        // Encode the employee details array as JSON and echo it
        echo json_encode($employeeDetails);
    } else {
        // If query fails, return an error message
        echo "Error executing query: " . $conn->error;
    }
} else {
    // If employee id is not provided, return an error message
    echo "Employee ID not provided.";
}
?>
