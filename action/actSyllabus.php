<?php
include("../db/dbConnection.php");
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a syllabus
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addSyllabus') {

    $course = $_POST['course'];
    $syllabus=$_POST['syllabusName'];
    
    
    $query = "INSERT INTO syllabus_tbl (entity_id,course_id,syllabus_name) 
              VALUES (3,'$course','$syllabus')";          
    $res = mysqli_query($conn, $query);
    

    if ($res) {
        $_SESSION['message'] = "Syllabus details added successfully!";
        $response['success'] = true;
        $response['message'] = "Syllabus details added successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in adding Syllabus details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}
// Handle updating Task details
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editSyllabus') {
    $editid = $_POST['editId'];
  
   
    $editSyllabusName = $_POST['editSyllabusName'];
    $editCourseName=$_POST['editCourse'];
   
    

    $editQuery1 ="UPDATE syllabus_tbl
LEFT JOIN course_tbl ON course_tbl.course_id = syllabus_tbl.course_id
SET 
 syllabus_tbl.syllabus_name='$editSyllabusName',
 syllabus_tbl.course_id='$editCourseName'
WHERE 
    syllabus_tbl.syllabus_status = 'Active' 
    AND syllabus_tbl.syllabus_id = '$editid'";
    
    $editRes = mysqli_query($conn, $editQuery1);

        if ($editRes) {
            $_SESSION['message'] = "Topic details Updated successfully!";
            $response['success'] = true;
            $response['message'] = "Topic details Updated successfully!";
        } 
        else {
         $response['message'] = "Error: " . mysqli_error($conn);
    }
    
    echo json_encode($response);
    exit();
}





// Handle fetching Tak details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    $editId = $_POST['editId'];

    $selQuery = "SELECT syllabus_tbl.*,
       course_tbl.*
      FROM syllabus_tbl
      LEFT JOIN course_tbl ON course_tbl.course_id = syllabus_tbl.course_id
      WHERE syllabus_tbl.syllabus_id='$editId'";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        $studentDetails = array(
            'syllabus_id' => $row['syllabus_id'],
           
           // 'course_id' => $row['course_id'],
            'course_name'=>$row['course_id'],
            'syllabus_name' => $row['syllabus_name'],
           
            
        );

        echo json_encode($studentDetails);
    } else {
        $response['message'] = "Error executing query: " . mysqli_error($conn);
        echo json_encode($response);
    }
    exit();
}

// Handle deleting a syllabus
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $queryDel = "UPDATE syllabus_tbl
LEFT JOIN 
course_tbl ON course_tbl.course_id = syllabus_tbl.course_id
SET 
 syllabus_tbl.syllabus_status = 'InActive' 
WHERE 
     syllabus_tbl.syllabus_id = '$id'";
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