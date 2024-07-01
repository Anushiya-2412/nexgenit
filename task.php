<?php
// $currentDate = date('Y-m-d');
session_start();
    include("db/dbConnection.php");
    $currentDate = date('Y-m-d'); 
    $selQuery = "SELECT a.*, b.*
FROM task_detail AS a
LEFT JOIN student_tbl AS b ON a.student_id = b.stu_id
WHERE b.stu_status = 'Active'
  AND b.entity_id = 3
  
  AND a.created_at ='$currentDate'";
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
                                    
                                        <button type="button" id="assignTaskBtnForm" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#assignModal">
                                             Assign Task
                                        </button>
                                        
                                    </div>
                                </div>
                                <h4 class="page-title">Task</h4>   
                            </div>
                        </div>
                    

             <?php include("addTask.php"); ?><!---add Task popup--->
             <?php include("assignTask.php"); ?><!---Assign Task popup--->
             <?php include("editAssignTask.php"); ?><!-------Edit Task popup--->
             <?php include("class.php"); ?><!-------class fuction--->
             
             
             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col-1">Name</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Syllabus</th>
                                    
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1; // Counter for serial number
                    
                    while ($row = mysqli_fetch_assoc($resQuery)): 
                        $student_id = $row['student_id'];
                        $task_id = $row['task_id'];
                        // Decode JSON data from task_detail column
                        $jsonData = $row['task_detail'];
                        $tasks = json_decode($jsonData, true);
                        
                        foreach ($tasks as $taskId => $taskDetails):
                            $courseId = htmlspecialchars($taskDetails['course_id']); // Assuming course_id is in taskDetails
                            $syllabusId = htmlspecialchars($taskDetails['syllabus_id']);
                            $taskNameId = htmlspecialchars($taskDetails['taskName_id']);
                            $duration=htmlspecialchars($taskDetails['duration']);
                            $status = htmlspecialchars($taskDetails['status']);
                    
                    ?>
                     <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td id="stuName_<?php echo $task_id; ?>"><?php echo getStudentName($student_id); ?></td>
                        <td id="courName_<?php echo $task_id; ?>"><?php echo getCourseName($courseId);?></td>
                        <td  id="taskName_<?php echo $task_id; ?>"><?php echo gettaskName($taskNameId); ?></td> 
                        <td><?php echo $status; ?></td>
                        <td id="syllName_<?php echo $task_id; ?>"><?php echo getsyllabusName($syllabusId); ?></td>
                        
                        <td>
                        <button style="display:none" type="button" title="Edit" class="btn btn-circle btn-warning text-white modalBtn" onclick="goEditTask(<?php echo $task_id; ?>);" data-bs-toggle="modal" data-bs-target="#editAssignTaskModal"><i class='bi bi-pencil-square'></i></button>
                       
                        <button class="btn btn-circle btn-success text-white modalBtn" title="View" onclick="goViewAssignTask(<?php echo $student_id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            
                            
                        </td>
                      </tr>
                      <?php 
                        endforeach; 
                    endwhile; 
                      ?>
                    </tbody>
                  </table>
                 
                  <?php
                    if ($resQuery->num_rows == 0) {
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

    //-------------------------------------start assign topic ---------------------------------

    $(document).ready(function () {
    // Function to reset form
    function resetForm(formId) {
        document.getElementById(formId).reset(); // Reset the form
    }

    // Show Assign Task Modal
    $('#assignTaskBtn').click(function() {
        // Serialize the form data
        var formData = $('#assignTask').serialize();
        
        console.log('Serialized Form Data:', formData); // Log serialized data for debugging

        $.ajax({
            url: "action/actAssignTask.php",
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Response:', response); // Check response in console
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000
                    }).then(function() {
                        resetForm('assignTask');
                        $('#assignModal').modal('hide');
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
                console.error('Error:', xhr.responseText); // More detailed error logging
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while assigning the task.'
                });
            }
        });
    });
});

    // Populate Course and Syllabus based on Student selection
    $('#studentName').change(function() {
        var studentId = $(this).val();
        if (studentId) {
            $.ajax({
                url: 'get_courses.php',
                type: 'POST',
                data: { studentId: studentId },
                dataType: 'json',
                success: function(data) {
                    $('#courseName').html('<option value='+data.course_id+'>'+data.course_name+'</option>');

                    // Populate syllabus
                    var syllabus = '';
                    for (var i = 0; i < data.syllabus_name.length; i++) {
                        var syllabus_name = data.syllabus_name[i];
                        var syllabus_id = data.syllabus_id[i];
                        syllabus += '<option value='+syllabus_id+'>'+syllabus_name+'</option>';
                    }
                    $('#syllabusName').html(syllabus);

                    // Update topics if syllabus is dynamically updated
                    var initialSyllabusId = $('#syllabusName').val();
                    if (initialSyllabusId) {
                        updateTopics(initialSyllabusId);
                    }
                }
            });
        } else {
            $('#courseName').html('<option value="">----select----</option>');
            $('#syllabusName').html('<option value="">----select----</option>');
            $('#task_Name').html('<option value="">----select----</option>');
        }
    });

    // Function to update topics based on syllabus
    function updateTopics(syllabus_id) {
        if (syllabus_id) {
            $.ajax({
                url: 'get_courses.php',
                type: 'POST',
                data: { syllabus_id: syllabus_id },
                dataType: 'json',
                success: function(data) {
                    console.log(data.task_name);
                    // Update topic dropdown
                    var taskOptions = ''; // Add a default option
                    for (var i = 0; i < data.task_name.length; i++) {
                        taskOptions += '<option value="' + data.task_id[i] + '">' + data.task_name[i] + '</option>';
                    }
                    console.log(taskOptions);
                    $('#task_Name').html(taskOptions);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX request failed: ' + textStatus, errorThrown);
                }
            });
        } else {
            $('#task_Name').html('<option value="">----select----</option>');
        }
    }

    // When the syllabus dropdown value changes
    $('#syllabusName').change(function() {
        var syllabus_id = $(this).val();
        updateTopics(syllabus_id);
    });

    //--------------------------------------end assign topic --------------------------------------

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

//edit Assign Task Modal
    $('#editAssignTask').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actAssignTask.php",
            method: 'POST',
            data: formData,
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
                        $('#editAssignTaskModal').modal('hide'); // Close the modal
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
                    text: 'An error occurred while Edit Updated Task data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
   
});

function goEditTask(taskId)
{ 
    $('#editid').val(taskId);
    
    
    var studentId = $("#stuName_" + taskId).text();
    var courseName = $("#courName_" + taskId).text();
    var syllName = $("#syllName_" + taskId).text();
    var taskName = $("#taskName_" + taskId).text();
    // var startDate = $("#startDate_" + taskId).text();
    // var endDate = $("#endDate_" + taskId).text();
    // alert(studentId);
    // alert(courseName);
    // alert(syllName);

                $('#editStudentName').html('<option value'+studentId+'>'+studentId+'</option>');
                //$('#editCourseName').val(courseName);
                $('#editCourseName').html('<option value'+courseName+'>'+courseName+'</option>');
                $('#editSyllabusName').html('<option value'+syllName+'>'+syllName+'</option>');
                $('#editTaskName').html('<option value'+taskName+'>'+taskName+'</option>');
                // $('#editStartdate').html('<option value'+startDate+'>'+startDate+'</option>');
                // $('#editEnddate').html('<option value'+taskName+'>'+taskName+'</option>');
                // $('#editstartdate').val(response.at_date);
                // $('#editenddate').val(response.at_complete_date);
    
}
function goViewAssignTask(id)
{
    //location.href = "clientDetail.php?clientId="+id;
    $.ajax({
        url: 'assignTaskDetail.php',
        method: 'POST',
        data: {
            id: id
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#StuContent').hide();
          $('#assignTaskDetail').html(response);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}
</script>
</body>

</html>



      


