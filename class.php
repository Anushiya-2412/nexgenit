
<?php

        // Function to fetch syllabus name based on course_id
function getsyllabusName($syllabusId) {
    global $conn; // Assuming $conn is your database connection object

    // Escape the course ID to prevent SQL injection
    $syllabusId = mysqli_real_escape_string($conn, $syllabusId);

    // Query to retrieve course name based on course_id
    $query = "SELECT `syllabus_name` FROM `syllabus_tbl` WHERE syllabus_id ='$syllabusId';";

    // Execute the query
    $result = $conn->query($query);

    // Check if query was successful
    if ($result) {
        // Fetch the course name
        $row = $result->fetch_assoc();
        if ($row) {
            return $row['syllabus_name'];
        } else {
            return "Syllabus not found";
        }
    } else {
        // Query execution failed
        return "Query failed: " . $conn->error;
    }
}


//---------------task name------------------------------
  // Function to fetch syllabus name based on course_id
  function gettaskName($taskId) {
    global $conn; // Assuming $conn is your database connection object

    // Escape the course ID to prevent SQL injection
    $taskId = mysqli_real_escape_string($conn, $taskId);

    // Query to retrieve course name based on course_id
    $task_query = "SELECT * FROM `task_tbl` WHERE task_id ='$taskId';";

    // Execute the query
    $task_result = $conn->query($task_query);

    // Check if query was successful
    if ($task_result) {
        // Fetch the course name
        $task_row = $task_result->fetch_assoc();
        if ($task_row) {
            return $task_row['task_name'];
        } else {
            return "Task not found";
        }
    } else {
        // Query execution failed
        return "Query failed: " . $conn->error;
    }
}

//---------------student name------------------------------
  // Function to fetch syllabus name based on course_id
  function getStudentName($studentId) {
    global $conn; // Assuming $conn is your database connection object

    // Escape the course ID to prevent SQL injection
    $studentId = mysqli_real_escape_string($conn, $studentId);

    // Query to retrieve course name based on course_id
    $student_query = "SELECT first_name,last_name FROM `student_tbl` WHERE stu_id ='$studentId' AND entity_id=3;";

    // Execute the query
    $student_result = $conn->query($student_query);

    // Check if query was successful
    if ($student_result) {
        // Fetch the course name
        $student_row = $student_result->fetch_assoc();
        if ($student_row) {
            $first_name = $student_row['first_name'];
            $last_name =$student_row['last_name'];
            $name =$first_name ." ".$last_name ;
            return $name;
        } else {
            return "Student not found";
        }
    } else {
        // Query execution failed
        return "Query failed: " . $conn->error;
    }
}



//---------------Course name------------------------------
  // Function to fetch syllabus name based on course_id
  function getCourseName($courseId) {
    global $conn; // Assuming $conn is your database connection object

    // Escape the course ID to prevent SQL injection
    $courseId = mysqli_real_escape_string($conn, $courseId);

    // Query to retrieve course name based on course_id
    $course_query = "SELECT `course_name` FROM `course_tbl` WHERE course_id ='$courseId' AND entity_id=3";

    // Execute the query
    $course_result = $conn->query($course_query);

    // Check if query was successful
    if ($course_result) {
        // Fetch the course name
        $course_row = $course_result->fetch_assoc();
        if ($course_row) {
            
            return $course_row['course_name'];
        } else {
            return "Course not found";
        }
    } else {
        // Query execution failed
        return "Query failed: " . $conn->error;
    }
}


    //---------------pending status------------------------------
  // Function to fetch syllabus name based on course_id
  function getStatuses($stu_Id) {
    global $conn; // Assuming $conn is your database connection object

    // Escape the student ID to prevent SQL injection
    $stu_Id = mysqli_real_escape_string($conn, $stu_Id);

    // Query to retrieve task_detail based on student_id
    $query_stu = "SELECT task_detail FROM `task_detail` WHERE student_id ='$stu_Id';";

    // Execute the query
    $result_stu = $conn->query($query_stu);

    // Check if query was successful
    if ($result_stu) {
        // Fetch the task details
        $row_stu = $result_stu->fetch_assoc();
        if ($row_stu) {
            // Decode the JSON data
            $taskDetails_stu = json_decode($row_stu['task_detail'], true);
            if ($taskDetails_stu === null && json_last_error() !== JSON_ERROR_NONE) {
                return "JSON decode error: " . json_last_error_msg();
            }

            // Extract and return the statuses
            $statuses = [];
            foreach ($taskDetails_stu as $taskId_stu => $task_stu) {
                if (isset($task['status'])) {
                    $statuses[$taskId_stu] = htmlspecialchars($task_stu['status']);
                } else {
                    $statuses[$taskId_stu] = "Status not found";
                }
            }

            return $statuses;
        } else {
            return "No task details found for this student";
        }
    } else {
        // Query execution failed
        return "Query failed: " . $conn->error;
    }
}





// Function to fetch pending tasks from task_detail JSON data
function getPendingTasks() {
    global $conn; // Assuming $conn is your database connection object

    // Query to retrieve task details
    $query_pending = "SELECT `task_id`, `student_id`, `task_detail` FROM `task_detail`";

    // Execute the query
    $result_pending = $conn->query($query_pending);

    // Check if query was successful
    if ($result_pending) {
        $pendingTasks = [];

        // Fetch all task details
        while ($pending_row = $result_pending->fetch_assoc()) {
            // Decode the JSON data
            $taskData = json_decode($pending_row['task_detail'], true);

            // Check if the status is Pending
            if ($taskData['status'] === 'Pending') {
                // Add the task to the pending tasks array
                $pendingTasks[] = [
                    'task_id' => $pending_row['task_id'],
                    'student_id' => $pending_row['student_id'],
                    'task_detail' => $pending_row['task_detail']
                ];
            }
        }

        return $pendingTasks;
    } else {
        // Query execution failed
        return "Query failed: " . $conn->error;
    }
}

?>
