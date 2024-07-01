<?php
include("../db/dbConnection.php");
include("../phpqrcode/qrlib.php");
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];


// Handle adding a client
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addStudent') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $location = $_POST['location'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $aadhar = $_POST['aadhar'];
    $course = $_POST['course'];
    $month = $_POST['month'];
    $name = $fname . " " . $lname;
    $username = $fname . $lname;

    function count_name($value) {
        global $conn;
        $count_sql = "SELECT COUNT(*) as count FROM admin_tbl WHERE username='$value' AND status='Active';";
        $result_count = mysqli_query($conn, $count_sql);
        $row = mysqli_fetch_assoc($result_count);
        return $row['count'];
    }

    function generateRandomNumber($value) {
        $name = $value;
        $num = mt_rand(100, 999);
        $last_user_name = $name . $num;
        return $last_user_name;
    }

    $feesQuery = "SELECT * FROM course_tbl WHERE course_id=$course";
    $resultFees = mysqli_query($conn, $feesQuery);
    $row = mysqli_fetch_assoc($resultFees);

    if ($month == 3) {
        $fees = $row['course_fees_3'];
    } elseif ($month == 12) {
        $fees = $row['course_fees_12'];
    } else {
        $fees = $row['course_fees_6'];
    }

    $count = count_name($username);
    if ($count > 0) {
        $rand_name = generateRandomNumber($username);
        $password = generateRandomNumber($username);
        $insertAdmin = "INSERT INTO admin_tbl(name, username, pass, role) VALUES ('$name', '$rand_name', '$password', 'Student')";
    } else {
        $password = generateRandomNumber($username);
        $insertAdmin = "INSERT INTO admin_tbl(name, username, pass, role) VALUES ('$name', '$username', '$password', 'Student')";
    }

    if ($conn->query($insertAdmin) === TRUE) {
        $last_parent_id = $conn->insert_id;

        $stu_sql = "INSERT INTO student_tbl (user_id, first_name, last_name, entity_id, course_id, course_month, stu_gender) VALUES ('$last_parent_id', '$fname', '$lname', 3, '$course', '$month', '$gender')";

        if ($conn->query($stu_sql) === TRUE) {
            $last_parent_id1 = $conn->insert_id;

            $stu_add_sql = "INSERT INTO additional_details_tbl(stu_id, dob, email, phone, address, aadhar) VALUES ('$last_parent_id1', '$dob', '$email', '$mobile', '$location', '$aadhar')";

            if ($conn->query($stu_add_sql) === TRUE) {
                $insertPayment = "INSERT INTO payment_tbl(stu_id, charge) VALUES ('$last_parent_id1', '$fees')";

                if ($conn->query($insertPayment) === TRUE) {
                    // Generate QR Code
                    $qrContent = "http://192.168.1.78/nexGenIT/student.php?id=$last_parent_id1";
                    $qrFileName = $username . "_qrcode.png";
                    $qrFilePath = "../document/students/" . $qrFileName;
                    QRcode::png($qrContent, $qrFilePath);

                    // Update the student table with the QR code image filename
                    $updateQrCodeSql = "UPDATE student_tbl SET stu_qrcode='$qrFileName' WHERE stu_id='$last_parent_id1'";
                    if ($conn->query($updateQrCodeSql) === TRUE) {
                        $_SESSION['message'] = "Student details added successfully!";
                        $response['success'] = true;
                        $response['message'] = "Student details added successfully!";
                        $response['qr_code'] = $qrFilePath;
                    } else {
                        $response['message'] = "Error: " . $updateQrCodeSql . "<br>" . $conn->error;
                    }
                } else {
                    $_SESSION['message'] = "Unexpected error in adding Student details!";
                    $response['message'] = "Error: " . $insertPayment . "<br>" . $conn->error;
                }
            } else {
                $response['message'] = "Error: " . $stu_add_sql . "<br>" . $conn->error;
            }
        } else {
            $response['message'] = "Error: " . $stu_sql . "<br>" . $conn->error;
        }
    } else {
        $response['message'] = "Error: " . $insertAdmin . "<br>" . $conn->error;
    }

    echo json_encode($response);
    exit();
}



// Handle fetching client details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    $editId = $_POST['editId'];

    $selQuery = "SELECT student_tbl.*,
    additional_details_tbl.*,
    course_tbl.*
     FROM student_tbl
    LEFT JOIN additional_details_tbl on student_tbl.stu_id=additional_details_tbl.stu_id
    LEFT JOIN course_tbl on student_tbl.course_id=course_tbl.course_id
    WHERE student_tbl.stu_id = $editId";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        $studentDetails = array(
            'stu_id' => $row['stu_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'course_name' => $row['course_id'],
            'dob' => $row['dob'],
            'address' => $row['address'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'aadhar' => $row['aadhar'],
        );

        echo json_encode($studentDetails);
    } else {
        $response['message'] = "Error executing query: " . mysqli_error($conn);
        echo json_encode($response);
    }
    exit();
}

// Handle updating student details
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editStudent') {
    $editid = $_POST['editid'];
    $editFName = $_POST['editFname'];
    $editLName = $_POST['editLname'];
    $editCourse = $_POST['editCourse'];
    $editdob = $_POST['editDob'];
    $editLocation = $_POST['editLocation'];
    $editMobile = $_POST['editMobile'];
    $editEmail = $_POST['editEmail'];
    $editAadhar = $_POST['editAadhar'];
    
    
    $editQuery1 =" UPDATE `student_tbl` st
    JOIN `additional_details_tbl` adt ON st.`stu_id` = adt.`stu_id`
    SET st.`first_name` = '$editFName',
        st.`last_name` = '$editLName',
        adt.`dob` = '$editdob',
        adt.`email` = '$editEmail',
        adt.`phone` = '$editMobile',
        adt.`address` = '$editLocation',
        adt.`aadhar` = '$editAadhar'
    WHERE st.`stu_id` = $editid;";
    
    $editRes = mysqli_query($conn, $editQuery1);

        if ($editRes) {
            $_SESSION['message'] = "Student details Updated successfully!";
            $response['success'] = true;
            $response['message'] = "Student details Updated successfully!";
        } 
        else {
         $response['message'] = "Error: " . mysqli_error($conn);
    }
    
    echo json_encode($response);
    exit();
}

// Handle deleting a client
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $queryDel = "UPDATE `student_tbl` st
    LEFT JOIN `additional_details_tbl` adt ON st.`stu_id` = adt.`stu_id`
    LEFT JOIN `admin_tbl` ad ON st.`user_id` = ad.`user_id`
    LEFT JOIN `payment_tbl` pt ON st.`stu_id` = pt.`stu_id`
    SET st.stu_status = 'Inactive',
        adt.`aditional_status` = 'Inactive',
        ad.status = 'Inactive',
        pt.payment_status = 'Inactive'
    WHERE st.`stu_id` = $id;";
    $reDel = mysqli_query($conn, $queryDel);

    if ($reDel) {
        $_SESSION['message'] = "Student details have been deleted successfully!";
        $response['success'] = true;
        $response['message'] = "Student details have been deleted successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in deleting Student details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}


// Upload Documents
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'docStudent') {
    if (!isset($_POST['stuDocId']) || empty($_POST['stuDocId']) || !isset($_POST['userName']) || empty($_POST['userName'])) {
        $response['message'] = 'Student ID and Username are required.';
        echo json_encode($response);
        exit;
    }

    $empId = $_POST['stuDocId'];
    $username = $_POST['userName'];
    $aadharFileName = null;
    $marksheetFileName = null;
   // $bankFileName = null;

    function uploadFile($file, $fileName) {
        $targetDir = "../document/students/";
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

    if (isset($_FILES['marksheet']) && $_FILES['marksheet']['error'] === UPLOAD_ERR_OK) {
        $result = uploadFile($_FILES['marksheet'], $username . '_marksheet');
        if ($result['success'] === false) {
            $response['message'] = $result['message'];
            echo json_encode($response);
            exit;
        }
        $marksheetFileName = $result['file'];
    }

    // if (isset($_FILES['bank']) && $_FILES['bank']['error'] === UPLOAD_ERR_OK) {
    //     $result = uploadFile($_FILES['bank'], $username . '_bank');
    //     if ($result['success'] === false) {
    //         $response['message'] = $result['message'];
    //         echo json_encode($response);
    //         exit;
    //     }
    //     $bankFileName = $result['file'];
    // }

    if ($aadharFileName || $marksheetFileName) {
        $sql = "UPDATE student_tbl SET ";
        $params = [];
        if ($aadharFileName) {
            $sql .= "stu_aadhar = ?, ";
            $params[] = $aadharFileName;
        }
        if ($marksheetFileName) {
            $sql .= "stu_marksheet = ?, ";
            $params[] = $marksheetFileName;
        }
        // if ($bankFileName) {
        //     $sql .= "emp_bank = ?, ";
        //     $params[] = $bankFileName;
        // }
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE stu_id = ?";

        $params[] = $empId;

        if ($stmt = $conn->prepare($sql)) {
            $types = str_repeat('s', count($params) - 1) . 'i';
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Student documents uploaded successfully!';
            } else {
                $response['message'] = 'Failed to update Student documents.';
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
exit();


    
    
