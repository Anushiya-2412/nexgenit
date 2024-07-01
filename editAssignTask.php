<?php 

?>
    <!-- Modal -->
    <div class="modal fade" id="editAssignTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmEditAssignTask" id="editAssignTask" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="editAssignTask">
                    <input type="hidden" name="editid" value="" id="editid">
                    
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Edit Task</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>  
                    <div class="modal-body p-3">
                    <div class="row p-3">
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="studentName" class="form-label"><b>Student Name</b></label>
                                <select class="form-control" id="editStudentName" name="editStudentName" required="required">
                                    <option value="">----select----</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="courseName" class="form-label"><b>Course Name</b></label>
                                <select class="form-control" id="editCourseName" name="editCourseName" required="required">
                                    <option value="">----select----</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="syllabusName" class="form-label"><b>Syllabus Name</b></label>
                                <select class="form-control" id="editSyllabusName" name="editSyllabusName" required="required">
                                    <option value="">----select----</option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="taskName" class="form-label"><b>Task Name</b></label>
                                <select class="form-control" id="editTaskName" name="editTaskName[]" required="required" multiple>
                                    <option value="">----select----</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="startdate" class="form-label"><b>Start Date</b></label>
                                <input type="date" class="form-control" name="editStartdate" id="editStartdate" required="required">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group pb-3">
                                <label for="enddate" class="form-label"><b>End Date</b></label>
                                <input type="date" class="form-control" name="editEnddate" id="editEnddate" required="required">
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateBtn">Save changes</button>
                    </div>
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->