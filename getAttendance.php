<?php
include("db/dbConnection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['attendanceType'])) {
        $attendanceType = $_POST['attendanceType'];
        $options = getpending($attendanceType);
        echo $options;
    }elseif (isset($_POST['customer'])) {
        $customerType = $_POST['customer'];
        $options = getCustomerOptions($customerType);
        echo $options;
    }

}
function getCustomerOptions($type) {
    global $conn;

    if ($type == 'Client') {
        $query = "SELECT * FROM client_dil WHERE client_status = 'Active' ORDER BY created_date DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $options =" <label class='modallabel' for='clientSelect'><b>Client Name </b></label>";
            $options .= "<select name='clientSelect' id='clientSelect' required>";
            $options .= "<option value=''>---Select Client---</option>";
            while ($row = mysqli_fetch_assoc($result)) {
                $options .= "<option value='" . htmlspecialchars($row['client_id']) . "'>" . htmlspecialchars($row['client_name']) . "</option>";
            }
            $options .= "</select>";
            return $options;
        } else {
            return '<p>No clients available.</p>';
        }
    } else if ($type == 'Customer') {
        $query = "SELECT * FROM customer_dil WHERE cus_status = 'Active' ORDER BY created_date DESC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $options ="<div class='form-group'><label class='modallabel' for='customerSelect'><b>Customer Name </b></label>";
            $options .= "<select name='customerSelect' id='customerSelect' required>";
            $options .= "<option value=''>---Select Customer---</option>";
            while ($row = mysqli_fetch_assoc($result)) {
                $options .= "<option value='" . htmlspecialchars($row['cus_id']) . "'>" . htmlspecialchars($row['cus_name']) . "</option>";
            }
            $options .= "</select></div>";  
            return $options;
        } else {
            return '<p>No customers available.</p>';
        }
    } else {
        return '<p>Select a valid customer type.</p>';
    }
}

function getpending($type) {
    global $conn;
    if ($type == 'employee') {
    $query = "SELECT * FROM `employee_tbl`";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $i=1;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
            $id = $row['emp_id']; 
            $emp_first_name = $row['emp_first_name'];
            $emp_last_name = $row['emp_last_name'];
            
            $cus_location = $row['cus_location'];
            $client_location = $row['client_location'];
            $client_phone = $row['client_phone'];
            $cus_location = $row['cus_location'];

           $options =` <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="student'.$student_id.'_present" name="'.$student_id.'" value="1">
                <label class="form-check-label" for="student1_present">Present</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="student'.$student_id.'_absent" name="'.$student_id.'" value="0">
                <label class="form-check-label" for="student1_absent">Absent</label>
            </div>`;

            // Check if client_name is empty or NULL, if so, use cus_name
            $name = (empty($client_name)) ? $cus_name : $client_name;

            // Check if client_location is empty or NULL, if so, use cus_location
            $location = (empty($client_location)) ? $cus_location : $client_location;

            // Check if client_phone is empty or NULL, if so, use cus_location
            $mobile = (empty($client_phone)) ? $cus_location : $client_phone;

            $i++;
        }
        return $options;
    } else {
        return '<p>No clients available.</p>';
    }
    } else {
        $query = "SELECT a.*, b.*, c.*
        FROM `service_dil` AS a
        LEFT JOIN client_dil AS b ON a.client_id = b.client_id
        LEFT JOIN customer_dil AS c ON a.cus_id = c.cus_id
        WHERE ser_status = 'Active' AND a.service_status = 'Confirm' 
        ORDER BY a.actual_delivery_date DESC;";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $options ="<table class='table v-middle' id='search_table'><thead><tr class='bg-light'><th scope='col'>Serial No</th><th scope='col'>Name</th><th scope='col'>Location</th><th scope='col'>Contact No</th><th scope='col'>Delivery Date</th><th scope='col'>Action</th></tr></thead><tbody>";
            $i=1;
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
                $id = $row['service_id']; 
                $client_name = $row['client_name'];
                $cus_name = $row['cus_name'];
                $cus_location = $row['cus_location'];
                $client_location = $row['client_location'];
                $client_phone = $row['client_phone'];
                $cus_location = $row['cus_location'];
                $actual_delivery_date =$row['actual_delivery_date'];
    
                // Check if client_name is empty or NULL, if so, use cus_name
                $name = (empty($client_name)) ? $cus_name : $client_name;
    
                // Check if client_location is empty or NULL, if so, use cus_location
                $location = (empty($client_location)) ? $cus_location : $client_location;
    
                // Check if client_phone is empty or NULL, if so, use cus_location
                $mobile = (empty($client_phone)) ? $cus_location : $client_phone;
    
                $options .= "<tr>";
                $options .= "<td>" . $i . "</td>";
                $options .= "<td>" . htmlspecialchars($name) . "</td>";
                $options .= "<td>" . htmlspecialchars($location) . "</td>";
                $options .= "<td>" . htmlspecialchars($mobile) . "</td>";
                $options .= "<td>" . htmlspecialchars($actual_delivery_date) . "</td>";
                $options .= "<td>";
                // View Button
                $options .= "<button class='btn btn-circle btn-info text-white modalBtn' onclick='goViewEmp(" . $id . ");'><i class='bx bx-show'></i></button>";
                
                $options .= "</td>";
                $options .= "</tr>";
                $i++;
            }
            $options .= "</tbody></table>";
            return $options;
        } 

            }
}

?>
