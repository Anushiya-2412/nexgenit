                                   <!-- Modal -->
    <div class="modal fade" id="addSyllabusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmAddStudent" id="addSyllabus">
                    <input type="hidden" name="hdnAction" value="addSyllabus">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Subject</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="Course" class="form-label"><b>Course</b></label>
                                    <select class="form-control" id="course" name="course" required="required">
                                        <option>----select----</option>

                                        <?php  
                                        $select_course="SELECT * FROM `course_tbl` WHERE course_status='Active'AND entity_id=3";
                                        $res_course = mysqli_query($conn , $select_course); 
                                             while($row = mysqli_fetch_array($res_course , MYSQLI_ASSOC)) { 
                                                $course_id = $row['course_id'];
                                                $course_name = $row['course_name'];
                                                
                                               
                                                echo '<option value="' . $course_id . '">' . $course_name . '</option>';
                                             }
                                        ?> 
                                        
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="topicName" class="form-label"><b>Subject Name</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Subject name" name="syllabusName" id="syllabusName" required="required">
                                </div>
                            </div>
                           
                            
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->