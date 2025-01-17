<?php
// $currentDate = date('Y-m-d');
session_start();
    include("db/dbConnection.php");
    
    $selQuery = "SELECT syllabus_tbl.*,
course_tbl.*,task_tbl.* from task_tbl
LEFT JOIN syllabus_tbl ON syllabus_tbl.syllabus_id=task_tbl.syllabus_id 
LEFT JOIN course_tbl ON course_tbl.course_id=task_tbl.course_id
where task_tbl.task_status='Active'";
    $resQuery = mysqli_query($conn , $selQuery);
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
            <div id="assignTaskDetail"></div>

                <!-- Start Content-->
                <div class="container-fluid" id="StuContent">

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
                                    <button type="button" id="addTaskBtn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                                             Add New Task
                                        </button>
                                        
                                        
                                    </div>
                                </div>
                                <h4 class="page-title">Task</h4>   
                            </div>
                        </div>
                    

             <?php include("addTask.php"); ?><!---add Task popup--->
             <?php include("editTask.php");?>
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col-1">Task Name</th>
                                    <th scope="col">Task Duration</th>
                                   
                                    <th scope="col">Subject</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                   $i=1;
                    while ($row = mysqli_fetch_assoc($resQuery))
                    {
                        
                       $id=$row['task_id'];
                       $task_name=$row['task_name'];
                       $task_duration=$row['task_duration'];
                       $syllabus_name=$row['syllabus_name'];
                       $course_name=$row['course_name'];
                       

                        
                        
                    
                    ?>
                     <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td style="word-break: break-word;"><?php echo $task_name; ?></td>
                        <td><?php echo $task_duration; ?></td>
                        <td><?php echo $syllabus_name; ?></td> 
                        <td><?php echo $course_name; ?></td>
                       
                        
                        <td>
                        <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="goEditTask(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editTaskModal"><i class='bi bi-pencil-square'></i></button>
                        <button class="btn btn-circle btn-danger text-white" onclick="goDeleteTask(<?php echo $id; ?>);"><i class="bi bi-trash"></i></button>
                        
                        </td>
                      </tr>
                      <?php 
                       
                    }
                      ?>
                    </tbody>
                  </table>
                 
                 

                   
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


    <!-------Start Add Student--->
    
             
<script>

$(document).ready(function () {
   
    // Function to reset form
    function resetForm(formId) {
        document.getElementById(formId).reset(); // Reset the form
    }

    // Show Add Task Modal
    $('#addTaskBtn').click(function () {
        $('#addTaskModal').modal('show'); // Show the modal
        resetForm('addTask'); // Reset the form
    });

    // Add Task Form Submit
    $('#addTask').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actTask.php",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                // Handle success response
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000
                    }).then(function() {
                        resetForm('addTask');
                        $('#addTaskModal').modal('hide');
                        $('#scroll-horizontal-datatable').load(location.href + ' #scroll-horizontal-datatable > *', function() {
                            $('#scroll-horizontal-datatable').DataTable().destroy();
                            $('#scroll-horizontal-datatable').DataTable({
                                "paging": true, // Enable pagination
                                "ordering": true, // Enable sorting
                                "searching": true // Enable searching
                            });
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while adding Task data.'
                });
                // Re-enable the submit button on error
                $('#submitBtn').prop('disabled', false);
            }
        });
    });

    
    
    // Edit Task Form Submit
    $('#editTask').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actTask.php",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                // Handle success response
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000
                    }).then(function() {
                        $('#editTaskModal').modal('hide'); // Close the modal
                        $('.modal-backdrop').remove(); // Remove the backdrop
                        $('#scroll-horizontal-datatable').load(location.href + ' #scroll-horizontal-datatable > *', function() {
                            $('#scroll-horizontal-datatable').DataTable().destroy();
                            $('#scroll-horizontal-datatable').DataTable({
                                "paging": true, // Enable pagination
                                "ordering": true, // Enable sorting
                                "searching": true // Enable searching
                            });
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while Edit Task data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });

    // Function to populate Edit Task Modal

})

function goEditTask(editId)
{ 
    $.ajax({
        url: 'action/actTask.php',
        method: 'POST',
        data: {
          editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {

          $('#editIdTask').val(response.task_id);
          $('#editCourse').val(response.course_name);
          $('#editSyllabus').val(response.syllabus_name);
          $('#editTaskName').val(response.task_name);
          $('#editTaskDuration').val(response.task_duration);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    
}
function goDeleteTask(id)
{
    //alert(id);
    if(confirm("Are you sure you want to delete Task?"))
    {
      $.ajax({
        url: 'action/actTask.php',
        method: 'POST',
        data: {
          deleteId: id
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#scroll-horizontal-datatable').load(location.href + ' #scroll-horizontal-datatable > *', function() {
                               
                               $('#scroll-horizontal-datatable').DataTable().destroy();
                               
                                $('#scroll-horizontal-datatable').DataTable({
                                    "paging": true, // Enable pagination
                                    "ordering": true, // Enable sorting
                                    "searching": true // Enable searching
                                });
                            });
         

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    }
}
</script>
</body>

</html>



      


