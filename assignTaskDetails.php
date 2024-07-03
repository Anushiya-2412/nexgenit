<?php
// $currentDate = date('Y-m-d');

session_start();
include("db/dbConnection.php");
if(isset($_POST['id']) && $_POST['id'] != '') {
    $studentId = $_POST['id'];

    // Prepare and execute the SQL query
    $selQuery = "SELECT 
    student_tbl.*,
    course_tbl.*,
    assign_task_tbl.*,
    syllabus_tbl.*,
    task_tbl.*,
    payment_tbl.*
FROM 
    assign_task_tbl
LEFT JOIN 
    student_tbl ON student_tbl.stu_id = assign_task_tbl.stu_id
LEFT JOIN 
    course_tbl ON course_tbl.course_id = assign_task_tbl.course_id
LEFT JOIN 
    syllabus_tbl ON syllabus_tbl.syllabus_id = assign_task_tbl.syllabus_id
LEFT JOIN
	task_tbl ON task_tbl.task_id =assign_task_tbl.task_id
LEFT JOIN 
	payment_tbl on payment_tbl.stu_id=student_tbl.stu_id
WHERE 
    assign_task_tbl.stu_id='$studentId'";
    
    $result1 = $conn->query($selQuery);

    if($result1) {
        // Fetch employee details
        $row = mysqli_fetch_array($result1 , MYSQLI_ASSOC);
        $id = $row['at_id']; 
        $e_id = $row['entity_id'];
        $fname = $row['first_name'];
        $lname=$row['last_name'];
        $course=$row['course_name'];
       
        $course=$row['course_name']; 
       
        $charge=$row['charge'];
        $course_duration=$row['course_month'];

       
        
        $name=$fname." ".$lname;    

    } else {
        echo "Error executing query: " . $conn->error;
    }
} else {
    // If employee id is not provided, redirect to employees.php
    header("Location: task.php");
    exit(); // Ensure script stops executing after redirection
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>
<body>
    <!-- Begin page -->
    <div class="wrapper">

        
        <!-- ========== Topbar Start ========== -->
        <?php include("top.php") ?>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

        <?php include("left.php"); ?>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        
        <div class="content-page">
            <div class="content">
            

                <!-- Start Content-->
                <div class="container-fluid" id="assignTaskDetail">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="bg-flower">
                                <img src="assets/images/flowers/img-3.png">
                            </div>

                            <div class="bg-flower-2">
                                <img src="assets/images/flowers/img-1.png">
                            </div>
        
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <div class="d-flex flex-wrap gap-2">
                                    
                                        
                                    </div>
                                </div>
                                <h4 class="page-title">Task</h4>   
                            </div>
                        </div>
                    

                        <?php include("editComplete.php"); ?>
                 
                 <!-- <form name="frm" method="post">
                     <input type="hidden" name="hdnAction" value=""> -->
                   <div class="modal-header">
                     <h4 class="modal-title" id="myModalLabel">Assign Task Details</h4>
                     <div class="modal-footer p-2">
                     <button type="button" class="btn btn-danger" onclick="javascript:location.href='task.php'" >Back</button>
                   </div> 
                   </div>  
                  <div class="modal-body">
                           <div class="row">
                               <div class="col-sm-3">
                                   <div class="card p-3">
                                       <h4>Name</h4> 
                                       <span class="detail"><?php echo $name;?></span>
                                   </div>
                               </div>  
                                <div class="col-sm-3 ">
                                   <div class="card p-3">
                                       <h4>Course Name</h4>
                                       <span class="detail"><?php echo  $course ;?></span>
                                   </div>
                               </div>
                               <!-- <div class="col-sm-3">
                                   <div class="card p-3">
                                       <h4>Course Fee</h4>
                                       <span class="detail"><?php echo $charge;?></span>
                                   </div>
                               </div> -->
                               <div class="col-sm-3">
                                   <div class="card p-3">
                                       <h4>Course Duration</h4>
                                       <span class="detail"><?php echo $course_duration;?></span>
                                   </div>
                               </div>
                               
                   </div>
                   <!-- </form>    -->
                   <div></div>
             <?php
       include "class.php";
       $task_query = "SELECT *, 
                             JSON_UNQUOTE(JSON_EXTRACT(task_detail, '$.status')) AS task_status,
                             JSON_UNQUOTE(JSON_EXTRACT(task_detail, '$.start_date')) AS start_date
                      FROM task_detail 
                      WHERE student_id = '$studentId'
                      ORDER BY task_status = 'Pending' DESC, start_date ASC";
       $task_res = $conn->query($task_query);
       
       $tasks = [];
       // Check if there are tasks for the student
       if ($task_res->num_rows > 0) {
           // Fetch all rows for the student
           while ($task = mysqli_fetch_assoc($task_res)) {
               // Decode JSON data from task_detail column
               $jsonData = $task['task_detail'];
               $taskDetails = json_decode($jsonData, true);
               foreach ($taskDetails as $taskId => $taskDetail) {
                   $taskDetail['task_id'] = $task['task_id'];
                   $tasks[] = $taskDetail;
               }
           }
           // Sort tasks by status ('Pending' first) and start_date
           usort($tasks, function ($a, $b) {
               if ($a['status'] == $b['status']) {
                   return 0;
               }
               return $a['status'] == 'Pending' ? -1 : 1;
           });
       
       
           // Output the HTML table structure
           ?>
           <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
           <thead>
               <tr class="bg-light">
                   <th scope="col">S.No.</th>
                   <th scope="col">Date</th>
                   <th scope="col">Task</th>
                   <th scope="col">Trainer</th>
                   <th scope="col">Status</th>
                   <th scope="col">Syllabus</th>
                   <th scope="col">Action</th>
               </tr>
           </thead>
           <tbody>
               <?php 
               $i = 1; // Counter for serial number
               foreach ($tasks as $taskDetails): 
                   $courseId = htmlspecialchars($taskDetails['course_id']); // Assuming course_id is in taskDetails
                   $syllabusId = htmlspecialchars($taskDetails['syllabus_id']);
                   $taskNameId = htmlspecialchars($taskDetails['taskName_id']);
                   $duration = htmlspecialchars($taskDetails['duration']);
                   
                   $status = htmlspecialchars($taskDetails['status']);
                   $task_id = htmlspecialchars($taskDetails['task_id']);
                   $start_date=htmlspecialchars($taskDetails['start_date']);
                   $date_only = date('d-m-Y', strtotime($start_date));
                   $trainer=htmlspecialchars($taskDetails['trainer']);
               ?>
               <tr>
                   <td><?php echo $i++; ?></td>
                   <td><?php echo $date_only; ?></td>
                   <td><?php echo gettaskName($taskNameId); ?></td>
                   <td><?php echo getTrainerName($trainer); ?></td>
                   <td><?php echo $status; ?></td>
                   <td><?php echo getsyllabusName($syllabusId);?></td>
                   
                   <td>
                   <input type="button" class="btn btn-circle btn-warning text-white modalBtn" value="Edit" onclick="goComplete('<?php echo $taskNameId; ?>','<?php echo $task_id; ?>');">
                      <?php if ($status != 'Completed'): ?>
       
                      <input type="button" class="btn btn-circle btn-success text-white"value="Completed" onclick="goConfirmTask('<?php echo $taskNameId; ?>','<?php echo $task_id; ?>');">
                      <?php endif; ?>
                  </td>
               </tr>
               <?php endforeach; ?>
           </tbody>
           </table>
           <?php
       } else {
           echo "No tasks found for the student.";
       }
       
if (mysqli_num_rows($resQuery) == 0) {
    echo "No tasks found for any student.";
}
?>

                   
                  </div>

                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div> <!-- end row-->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php include("footer.php") ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
<?php include("theme.php"); ?> <!-------Add theme--------------->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Datatables js -->
    <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
</script>         



</body>

</html>



      


