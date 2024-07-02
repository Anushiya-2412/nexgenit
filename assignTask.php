<!-- Modal -->
<div class="modal fade" id="assignModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form name="frmAddStudent" id="assignTask" >
                <input type="hidden" name="hdnAction" value="assignTask">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Assign Task</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row p-3">
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="studentName" class="form-label"><b>Student Name</b></label>
                                <select class="form-control" id="studentName" name="studentName" required="required">
                                    <option value="">----select----</option>
                                    <?php  
                                    $select_student = "SELECT `stu_id`, `first_name`, `last_name` FROM `student_tbl` WHERE entity_id = 3 AND stu_status = 'Active';";
                                    $res_student = mysqli_query($conn, $select_student); 
                                    while($row_student = mysqli_fetch_array($res_student, MYSQLI_ASSOC)) { 
                                        $studentId = $row_student['stu_id'];
                                        $first_name = $row_student['first_name'];
                                        $last_name = $row_student['last_name'];
                                        $name = $first_name . " " . $last_name;
                                        echo '<option value="' . $studentId . '">' . $name . '</option>';
                                    }
                                    ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="courseName" class="form-label"><b>Course Name</b></label>
                                <select class="form-control" id="courseName" name="courseName" required="required">
                                    <option value="">----select----</option>
                                </select>
                        
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="syllabusName" class="form-label"><b>Syllabus Name</b></label>
                                <select class="form-control" id="syllabusName" name="syllabusName" required="required">
                                    <option value="">----select----</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="trainer" class="form-label"><b>Trainer</b></label>
                                <select class="form-control" id="trainer" name="trainer" required="required">
                                    <option value="">----select----</option>
                                    <?php 
                                        $select_trainer="SELECT employee_tbl.*, emp_additional_tbl.* FROM employee_tbl
                                         LEFT JOIN emp_additional_tbl ON emp_additional_tbl.emp_id = employee_tbl.emp_id WHERE employee_tbl.emp_status='Active' AND emp_additional_tbl.emp_role='Trainer'";
                                         $res_trainer=mysqli_query($conn,$select_trainer);
                                         while($row_trainer=mysqli_fetch_array($res_trainer,MYSQLI_ASSOC))
                                         {
                                            $emp_id=$row_trainer['emp_id'];
                                            $emp_fname=$row_trainer['emp_first_name'];
                                            $emp_lname=$row_trainer['emp_last_name'];
                                            $ename=$emp_fname." ".$emp_lname;
                                            echo '<option value="' . $emp_id . '">' . $ename . '</option>';
                                         }
                                    ?>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-sm-12">
                            <div class="form-group pb-3">
                                <label for="taskName" class="form-label"><b>Task Name</b></label>
                                <select class="form-control" id="task_Name" name="taskName[]" required="required" multiple>
                                    <option value="">----select----</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="startdate" class="form-label"><b>Duration</b></label>
                                <input type="number" class="form-control" name="duration" id="duration" required="required" placeholder="Enter the duration">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="assignTaskBtn" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div> <!-- end modal content-->
    </div> <!-- end modal dialog-->
</div> <!-- end modal-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    //Handles to calculate the duration
$(document).ready(function() {
    $('#task_Name').change(function() {
        var selectedTaskIds = $(this).val();

        if (selectedTaskIds.length > 0) {
            $.ajax({
                url: "action/actAssignTask.php",
                type: 'POST',
                data: { taskIds: selectedTaskIds },
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    if (response.success) {
                        $('#duration').val(response.total_duration);
                    } else {
                        console.error('Error: ' + response.message);
                        $('#duration').val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error: ' + error);
                    $('#duration').val('');
                }
            });
        } else {
            $('#duration').val('');
        }
    });
});


</script>