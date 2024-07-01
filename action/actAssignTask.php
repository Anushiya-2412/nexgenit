<?php
session_start();
include("../db/dbConnection.php");
include("../class.php");

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Display the current date and time


if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'assignTask') {
    $currentDate = date("Y-m-d");
    $currentDateTime = date("Y-m-d H:i:s");
    $student_id = $_POST['studentName'];
    $course =  $_POST['courseName'];
    $syllabus =  $_POST['syllabusName'];
    $taskName =  $_POST['taskName'];
    $duration=$_POST['duration'];

    // Check if the current date already exists for the given student ID
    $select_date_query = "SELECT `task_detail` FROM `task_detail` WHERE `student_id` = '$student_id' AND DATE(`created_at`) = '$currentDate'";
    $res_date = mysqli_query($conn, $select_date_query);

    if (mysqli_num_rows($res_date) > 0) {
        // If the current date exists, update the existing record
        $row = mysqli_fetch_assoc($res_date);
        $existing_tasks = json_decode($row['task_detail'], true);
        if (!$existing_tasks) {
            $existing_tasks = [];
        }
        foreach ($taskName as $taskNames) {
        $existing_tasks[$taskNames] = [
            "course_id" => $course,
            "syllabus_id" => $syllabus,
            "taskName_id" => $taskNames,
            "duration" => $duration,
            "status" => "Pending",
            "start_date" => $currentDateTime
        ];
        }

        $jsondata = json_encode($existing_tasks);

        $update_query = "UPDATE `task_detail` SET `task_detail` = '$jsondata' WHERE `student_id` = '$student_id' AND DATE(`created_at`) = '$currentDate'";
        $res = mysqli_query($conn, $update_query);

        if ($res) {
            $response['success'] = true;
            $response['message'] = 'Task details updated successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to update task details.';
        }
    } else {
        // If the current date does not exist, insert a new record
        foreach ($taskName as $taskNames) {
            $data[$taskNames] = [
                "course_id" => $course,
                "syllabus_id" => $syllabus,
                "taskName_id" => $taskNames,
                "duration" => $duration,
                "status" => "Pending",
                "start_date" => $currentDateTime
            ];
            }
        $jsondata = json_encode($data);

        $insert_query = "INSERT INTO `task_detail`(`student_id`, `task_detail`, `created_at`) VALUES ('$student_id', '$jsondata', '$currentDate')";
        $res = mysqli_query($conn, $insert_query);

        if ($res) {
            $response['success'] = true;
            $response['message'] = 'Task details inserted successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to insert task details.';
        }
    }
    
}
echo json_encode($response);
    exit();
//Handles Edit Update query

if (isset($_POST['hdnAction']) && $_POST['hdnAction'] == 'editAssignTask') {
    $editid = $_POST['editid'];
    $studentName = $_POST['editStudentName'];
    $courseName = $_POST['editCourseName'];
    $syllabusName = $_POST['editSyllabusName'];
    $task = $_POST['editTaskName'];
    $duration=$_POST['duration'];

    
    // Sanitize input values
    $editid = real_escape_string($editid);
    $studentName =real_escape_string($studentName);
    $courseName =real_escape_string($courseName);
    $syllabusName = real_escape_string($syllabusName);
    $task = ($task);
    $duration=real_escape_string($duration);
    // Create array and JSON encode it
    $editArray = [
        "course_id" => $courseName,
        "syllabus_id" => $syllabusName,
        "taskName_id" => $task,
        "duration" => $duration,
    ];
    $up = json_encode($editArray);

    // Update query
    $sqlUpdate = "UPDATE `task_detail` SET `task_detail` = '$up' WHERE `student_id` = '$editid'";

    // Execute query
    $editRes = mysqli_query($conn, $sqlUpdate);

    if ($editRes) {
        $_SESSION['message'] = "Updated successfully!";
        $response['success'] = true;
        $response['message'] = "Updated successfully!";
    } else {
        $response['message'] = "Error: " . mysqli_error($conn);
    }

    echo json_encode($response);
    exit();
}
?>


