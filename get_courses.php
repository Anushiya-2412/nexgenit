<?php
        include("db/dbConnection.php");



        

        if(isset($_POST['studentId'])) {
            $studentId = $_POST['studentId'];

            $select_course = "SELECT * FROM `student_tbl` AS a 
            LEFT JOIN course_tbl AS b ON a.course_id =b.course_id 
            WHERE a.stu_id ='$studentId' AND a.entity_id = 3 AND a.stu_status ='Active';";
            $res_course = mysqli_query($conn, $select_course);

            
            while($row = mysqli_fetch_array($res_course, MYSQLI_ASSOC)) {
                $course_id = $row['course_id'];
                $course_name = $row['course_name'];
                // $syllabus_id[]=$row['syllabus_id'];
                // $syllabus_name[] = $row['syllabus_name'];
                // $topic_id[]=$row['topic_id'];
                // $topic_name[] = $row['topic_name'];
                // $task_id[]=$row['task_id'];
                // $task_name[]=$row['task_name'];  
            }

            //----------------course name print end ----------------------------------

            $select_syllabus = "SELECT * FROM `syllabus_tbl` WHERE entity_id = 3 AND syllabus_status ='Active'";
            $res_syllabus = mysqli_query($conn, $select_syllabus);

            
            while($syllabus = mysqli_fetch_array($res_syllabus, MYSQLI_ASSOC)) {
                $syllabus_id[] = $syllabus['syllabus_id'];
                $syllabus_name[] = $syllabus['syllabus_name'];
                // $syllabus_id[]=$row['syllabus_id'];
                // $syllabus_name[] = $row['syllabus_name'];
                // $topic_id[]=$row['topic_id'];
                // $topic_name[] = $row['topic_name'];
                // $task_id[]=$row['task_id'];
                // $task_name[]=$row['task_name'];  
            }
            $data =array(
                "course_id" =>$course_id,
                "course_name" =>$course_name,
                "syllabus_id" =>$syllabus_id,
                "syllabus_name" =>$syllabus_name,
            
            );
            echo json_encode($data);

              
        }
        //------------syllabus --------------------------------
        if(isset($_POST['syllabus_id'])) {
            $syllabus_id = $_POST['syllabus_id'];
        //-----------syllabus data print end -------------------------------------
        $select_task = "SELECT * FROM `task_tbl`WHERE syllabus_id =$syllabus_id AND task_status ='Active';";
        $res_task = mysqli_query($conn, $select_task);

        
        while($task = mysqli_fetch_array($res_task, MYSQLI_ASSOC)) {
            // $topic_id[] = $topic['syllabus_id'];
            // $topic_name[] = $topic['syllabus_name'];
            // $syllabus_id[]=$row['syllabus_id'];
            // $syllabus_name[] = $row['syllabus_name'];
            $task_id[]=$task['task_id'];
            $task_name[] = $task['task_name'];
            // $task_id[]=$row['task_id'];
            // $task_name[]=$row['task_name'];  
        }  
        $data =array(
            
            "task_id" =>$task_id,
            "task_name" =>$task_name,
            
        );
        echo json_encode($data);
        
        }


        
        
?>

