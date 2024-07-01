<?php
include("../db/dbConnection.php");
session_start();

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Add Employee
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addEmployee') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $name = $fname . ' ' . $lname;
    $mobile = $_POST['mobile'];
    $pemail = $_POST['pemail'];
    $cemail = $_POST['cemail'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $jDate = $_POST['jDate'];
    $role = $_POST['role'];
    $married_status = $_POST['ms'];
    $username = $fname . $lname;
    function count_name($value) {
        global $conn;
        $count_sql = "SELECT COUNT(*) as count FROM admin_tbl WHERE name='$value' AND status='Active';";
        $result_count = mysqli_query($conn, $count_sql);
        $row = mysqli_fetch_assoc($result_count);
        return $row['count'];
    }

    function generateRandomNumber($username) {
        $name = "$username";
        $num = mt_rand(100, 999);
        $last_user_name = $name . $num;
        return $last_user_name;
    } 
    
    $count = count_name($username);
    if ($count > 0) {
        $rand_name = generateRandomNumber($username);
        $password = generateRandomNumber($username);
        $empuser_sql = "INSERT INTO admin_tbl(name, username, pass, role) VALUES ('$name', '$rand_name', '$password', '$role')";
    } else {
        $password = generateRandomNumber($username);
        $empuser_sql = "INSERT INTO admin_tbl(name, username, pass, role) VALUES ('$name', '$username', '$password', '$role')";
    }
    
    if ($conn->query($empuser_sql) === TRUE) {
        $last_insert_id = $conn->insert_id;

        $emp_sql = "INSERT INTO employee_tbl (entity_id,emp_first_name, emp_last_name, emp_user_id, emp_married_status) VALUES (1,'$fname', '$lname', '$last_insert_id', '$married_status')";

        if ($conn->query($emp_sql) === TRUE) {
            $last_parent_id = $conn->insert_id;

            $emp_add_sql = "INSERT INTO emp_additional_tbl (emp_id, emp_personal_email, emp_company_email, emp_dob, emp_joining_date, emp_role, emp_mobile, emp_address) VALUES ('$last_parent_id', '$pemail', '$cemail', '$dob', '$jDate', '$role', '$mobile', '$address')";

            if ($conn->query($emp_add_sql) === TRUE) {
                $response['success'] = true;
                $response['message'] = "Employee details added successfully!";
            } else {
                $response['message'] = "Unexpected error in adding Employee details! " . $conn->error;
            }
        } else {
            $response['message'] = "Error: " . $conn->error;
        }
    } else {
        $response['message'] = "Error: " . $conn->error;
    }
}

// Edit Employee
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'hdneditEmployee') {
    $empId = $_POST['empId'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $married_status = $_POST['ms'];
    $pemail = $_POST['pemail'];
    $cemail = $_POST['cemail'];
    $dob = $_POST['dob'];
    $jDate = $_POST['jDate'];
    $role = $_POST['role'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $queryUpdate = "UPDATE employee_tbl AS a
                  LEFT JOIN emp_additional_tbl AS b ON a.emp_id = b.emp_id
                  SET 
                      a.emp_first_name = '$fname', 
                      a.emp_last_name = '$lname',
                      a.emp_married_status = '$married_status',
                      b.emp_personal_email = '$pemail',
                      b.emp_company_email = '$cemail',
                      b.emp_dob = '$dob',
                      b.emp_joining_date = '$jDate',
                      b.emp_role = '$role',
                      b.emp_mobile = '$mobile',
                      b.emp_address = '$address' 
                  WHERE a.emp_id = $empId";

    if ($conn->query($queryUpdate) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Employee details updated successfully!";
    } else {
        $response['message'] = "Unexpected error in updating Employee details! " . $conn->error;
    }
}

// Delete Employee
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $query = "UPDATE employee_tbl AS a 
              LEFT JOIN emp_additional_tbl AS b ON a.emp_id = b.emp_id 
              SET a.emp_status = 'Inactive', b.emp_status = 'Inactive' 
              WHERE a.emp_id = $id";
    $res = mysqli_query($conn, $query);

    if ($res) {
        $response['success'] = true;
        $response['message'] = "Employee details have been deleted successfully!";
    } else {
        $response['message'] = "Unexpected error in deleting employee details! " . $conn->error;
    }
}

// Upload Documents
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'docEmployee') {
    if (!isset($_POST['empDocId']) || empty($_POST['empDocId']) || !isset($_POST['userName']) || empty($_POST['userName'])) {
        $response['message'] = 'Employee ID and Username are required.';
        echo json_encode($response);
        exit;
    }

    $empId = $_POST['empDocId'];
    $username = $_POST['userName'];
    $aadharFileName = null;
    $panFileName = null;
    $bankFileName = null;

    function uploadFile($file, $fileName) {
        $targetDir = "../document/employees/";
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
        $targetFile = $targetDir . basename($fileName . '.' . $fileExt);

        if (!file_exists($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                return ['success' => false, 'message' => 'Failed to create directory: ' . $targetDir];
            }
        }

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return ['success' => true, 'file' => basename($targetFile)];
        } else {
            return ['success' => false, 'message' => 'Failed to move uploaded file from ' . $file["tmp_name"] . ' to ' . $targetFile];
        }
    }

    if (isset($_FILES['aadhar']) && $_FILES['aadhar']['error'] === UPLOAD_ERR_OK) {
        $result = uploadFile($_FILES['aadhar'], $username . '_aadhar');
        if ($result['success'] === false) {
            $response['message'] = $result['message'];
            echo json_encode($response);
            exit;
        }
        $aadharFileName = $result['file'];
    }

    if (isset($_FILES['pan']) && $_FILES['pan']['error'] === UPLOAD_ERR_OK) {
        $result = uploadFile($_FILES['pan'], $username . '_pan');
        if ($result['success'] === false) {
            $response['message'] = $result['message'];
            echo json_encode($response);
            exit;
        }
        $panFileName = $result['file'];
    }

    if (isset($_FILES['bank']) && $_FILES['bank']['error'] === UPLOAD_ERR_OK) {
        $result = uploadFile($_FILES['bank'], $username . '_bank');
        if ($result['success'] === false) {
            $response['message'] = $result['message'];
            echo json_encode($response);
            exit;
        }
        $bankFileName = $result['file'];
    }

    if ($aadharFileName || $panFileName || $bankFileName) {
        $sql = "UPDATE employee_tbl SET ";
        $params = [];
        if ($aadharFileName) {
            $sql .= "emp_aadhar = ?, ";
            $params[] = $aadharFileName;
        }
        if ($panFileName) {
            $sql .= "emp_pan = ?, ";
            $params[] = $panFileName;
        }
        if ($bankFileName) {
            $sql .= "emp_bank = ?, ";
            $params[] = $bankFileName;
        }
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE emp_id = ?";

        $params[] = $empId;

        if ($stmt = $conn->prepare($sql)) {
            $types = str_repeat('s', count($params) - 1) . 'i';
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Employee documents uploaded successfully!';
            } else {
                $response['message'] = 'Failed to update employee documents.';
            }

            $stmt->close();
        } else {
            $response['message'] = 'Failed to prepare statement: ' . $conn->error;
        }
    } else {
        $response['message'] = 'No documents uploaded.';
    }
}

echo json_encode($response);
?>
