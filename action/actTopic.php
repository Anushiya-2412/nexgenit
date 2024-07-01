<?php
include("../db/dbConnection.php");
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a client
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addTopic') {

    $course = $_POST['course'];
    $syllabus=$_POST['syllabus'];
    $taskName = $_POST['topicName'];
    $duration = $_POST['topicDuration'];
    $query = "INSERT INTO topic_tbl (syllabus_id,course_id,topic_name, topic_duration) 
              VALUES ('$syllabus','$course', '$taskName', '$duration')"; 
              
    $res = mysqli_query($conn, $query);
    

    if ($res) {
        $_SESSION['message'] = "Topic details added successfully!";
        $response['success'] = true;
        $response['message'] = "Topic details added successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in adding Task details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}
// Handle fetching Tak details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    $editId = $_POST['editId'];

    $selQuery = "SELECT syllabus_tbl.*,
       course_tbl.*,
       topic_tbl.*
      FROM syllabus_tbl
      LEFT JOIN course_tbl ON course_tbl.course_id = syllabus_tbl.course_id
      LEFT JOIN topic_tbl ON topic_tbl.syllabus_id = syllabus_tbl.syllabus_id
      WHERE course_tbl.course_status='Active' AND topic_tbl.topic_id='$editId'";
    $result = mysqli_query($conn, $selQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        $studentDetails = array(
            'syllabus_id' => $row['syllabus_id'],
            'topic_id'=>$row['topic_id'],
            'topic_name' => $row['topic_name'],
            'course_id' => $row['course_id'],
            'course_name'=>$row['course_name'],
            'syllabus_name' => $row['syllabus_id'],
            'topic_duration' => $row['topic_duration'],
            
        );

        echo json_encode($studentDetails);
    } else {
        $response['message'] = "Error executing query: " . mysqli_error($conn);
        echo json_encode($response);
    }
    exit();
}

// Handle updating Task details
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editTopic') {
    $editid = $_POST['editid'];
  
   
    $editTopicName = $_POST['editTopicName'];
    $editTopicDuration = $_POST['editTopicDuration'];
   
    

    $editQuery1 =" UPDATE syllabus_tbl
LEFT JOIN course_tbl ON course_tbl.course_id = syllabus_tbl.course_id
LEFT JOIN topic_tbl ON topic_tbl.syllabus_id = syllabus_tbl.syllabus_id
SET 
    topic_tbl.topic_name = '$editTopicName',
    topic_tbl.topic_duration = '$editTopicDuration'
WHERE 
    topic_tbl.topic_status = 'Active' 
    AND topic_tbl.topic_id = '$editid'";
    
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
// Handle deleting a Task
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $queryDel = "UPDATE `topic_tbl` 
    SET topic_status = 'Inactive'
    WHERE topic_id = $id;";
    $reDel = mysqli_query($conn, $queryDel);

    if ($reDel) {
        $_SESSION['message'] = "Topic details have been deleted successfully!";
        $response['success'] = true;
        $response['message'] = "Topic details have been deleted successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in deleting Topic details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}
