<?php
include("../db/dbConnection.php");
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Handle adding a task
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'addTask') {

    $course = $_POST['course'];
    $syllabus=$_POST['syllabus'];
    $taskName = $_POST['taskName'];
    $taskDuration=$_POST['taskDuration'];
   
    
    $query = "INSERT INTO task_tbl (course_id,syllabus_id,task_name,task_duration) VALUES('$course','$syllabus','$taskName',$taskDuration)"; 
              
    $res = mysqli_query($conn, $query);
    

    if ($res) {
        $_SESSION['message'] = "Task details added successfully!";
        $response['success'] = true;
        $response['message'] = "Task details added successfully!";
    } else {
        $_SESSION['message'] = "Unexpected error in adding Task details!";
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}

// Handle fetching task details for editing
if (isset($_POST['editId']) && $_POST['editId'] != '') {
    $editIdFetch = $_POST['editId'];

    $selQueryTask = "SELECT syllabus_tbl.*,
course_tbl.*,task_tbl.* from task_tbl
LEFT JOIN syllabus_tbl ON syllabus_tbl.syllabus_id=task_tbl.syllabus_id 
LEFT JOIN course_tbl ON course_tbl.course_id=task_tbl.course_id WHERE task_tbl.task_id='$editIdFetch'";
    $resultFetch = mysqli_query($conn, $selQueryTask);

    if ($resultFetch) {
        $row = mysqli_fetch_assoc($resultFetch);
        
        $studentDetails = array(
            'task_id' => $row['task_id'],
            'task_name' => $row['task_name'],
            'task_duration' => $row['task_duration'],
            'course_name' => $row['course_id'],
            'syllabus_name' => $row['syllabus_id'],
            
        );

        echo json_encode($studentDetails);
    } else {
        $response['message'] = "Error executing query: " . mysqli_error($conn);
        echo json_encode($response);
    }
    exit();
}


//Handle fetch the edit task 
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editTask') {
    $editIdTask = $_POST['editId'];
    $editTaskName=$_POST['editTaskName'];
    $editDuration=$_POST['editTaskDuration'];
   
    

    $editQueryTask ="UPDATE task_tbl SET task_name='$editTaskName',
task_duration='$editDuration'
WHERE task_id='$editIdTask'";
    
    $editResTask = mysqli_query($conn, $editQueryTask);

        if ($editResTask) {
            $_SESSION['message'] = "Task details Updated successfully!";
            $response['success'] = true;
            $response['message'] = "Task details Updated successfully!";
        } 
        else {
         $response['message'] = "Error: " . mysqli_error($conn);
    }
    
    echo json_encode($response);
    exit();
}
//handles delete a task
if (isset($_POST['deleteId'])) {
    $id = $_POST['deleteId'];
    $queryDelTask = "UPDATE task_tbl SET task_status='Inactive'
WHERE task_id='$id'";
    $reDelTask = mysqli_query($conn, $queryDelTask);

    if ($reDelTask) {
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

// // Handle select quary assign  Task details
// if (isset($_POST['editId']) && $_POST['editId'] != '') {
//     $editId = $_POST['editId'];

//     $selQuery = "SELECT a.*, b.* FROM `task_detail` AS a 
//       LEFT JOIN student_tbl AS b ON a.student_id = b.stu_id
//       WHERE stu_status='Active'AND b.entity_id=3";
//     $result = mysqli_query($conn, $selQuery);

//     if ($result) {
//         $row = mysqli_fetch_assoc($result);
        
//         $clientDetails = array(
//             'client_id' => $row['client_id'],
//             'client_name' => $row['client_name'],
//             'client_company' => $row['client_company'],
//             'client_location' => $row['client_location'],
//             'client_email' => $row['client_email'],
//             'client_phone' => $row['client_phone'],
//             'client_gst' => $row['client_gst'],
//         );

//         echo json_encode($clientDetails);
//     } else {
//         $response['message'] = "Error executing query: " . mysqli_error($conn);
//         echo json_encode($response);
//     }
//     exit();
// }

// Handle updating assign Task details
if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editAssignTask') {
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

// Handle Complete tasks
if (isset($_POST['taskNameId']) && isset($_POST['taskId'])) {
    // $id = $_POST['deleteId'];
    // // Escape the id to prevent SQL injection
    // $id = mysqli_real_escape_string($conn, $id);
    $taskNameId = $_POST['taskNameId'];
    $taskId = $_POST['taskId'];
    
    // Escape the inputs to prevent SQL injection
    $taskNameId = mysqli_real_escape_string($conn, $taskNameId);
    $taskId = mysqli_real_escape_string($conn, $taskId);
    
    // Prepare the query to update the specific task status
    $queryDel = "UPDATE `task_detail` 
                 SET `task_detail` = JSON_SET(`task_detail`, '$.\"$taskNameId\".status', 'Completed') 
                 WHERE `task_id` = '$taskId'";
    
    // Execute the query
    $reDel = mysqli_query($conn, $queryDel);

    if ($reDel) {
        $_SESSION['message'] = "Complete Status Updated Successfully";
        $response['success'] = true;
        $response['message'] = "Complete Status Updated Successfully";
    } else {
        $_SESSION['message'] = "Unexpected error in updating Complete status!";
        $response['success'] = false;
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    // Return the response as JSON
    echo json_encode($response);
    exit();
}

//Handles Pending task

if (isset($_POST['taskName']) && isset($_POST['task']) ) {
    $taskNameId1 = $_POST['taskName'];
    $taskId1 = $_POST['task'];
    
    // Escape the inputs to prevent SQL injection
    $taskNameId1 = mysqli_real_escape_string($conn, $taskNameId1);
    $taskId1 = mysqli_real_escape_string($conn, $taskId1);
    
    // Prepare the query to update the specific task status
    $queryDel2 = "UPDATE `task_detail` 
                 SET `task_detail` = JSON_SET(`task_detail`, '$.\"$taskNameId1\".status', 'Pending') 
                 WHERE `task_id` = '$taskId1'";
    
    // Execute the query
    $reDel1 = mysqli_query($conn, $queryDel2);

    $response = [];
    if ($reDel1) {
        $_SESSION['message'] = "Status Updated Successfully";
        $response['success'] = true;
        $response['message'] = "Status Updated Successfully";
    } else {
        $_SESSION['message'] = "Unexpected error in updating Complete status!";
        $response['success'] = false;
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    // Return the response as JSON
    echo json_encode($response);
    exit();
}


?>