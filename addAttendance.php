                                   <!-- Modal -->
        <div class="modal fade" id="addStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmAddStudent" id="addStudent" enctype="multipart/form-data">
                    <input type="hidden" name="hdnAction" value="addStudent">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Student</h4>
                       
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                        <div class="col-12">
                        <label for="fname" class="form-label"><b>Select Attendance</b></label>
                        <select class="form-control col-12 " id="attendanceType" name="attendanceType" required="required">
                                        <option>----select----</option>
                                        <option value="employee">Employees</option>
                                        <option value="student">Students</option>
                                    </select>
                        </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="fname" class="form-label"><b>First Name</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Student First Name" name="fname" id="fname" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="lname" class="form-label"><b>Last Name</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Student Last Name" name="lname" id="lname" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="Course" class="form-label"><b>Course</b></label>
                                    <select class="form-control" id="course" name="course" required="required">
                                        <option>----select----</option>

                                        <?php  
                                        $select_course="SELECT * FROM `course_tbl` WHERE course_status='Active';";
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
                                    <label for="Course" class="form-label"><b>Months Duration </b></label>
                                    <select class="form-control" id="month" name="month" required="required">
                                        <option>----select----</option>
                                        <option value="3">3 Months</option>
                                        <option value="6">6 Months</option>
                                        <option value="12">12 Months</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="gender" class="form-label"><b>Gender</b></label>
                                    <select class="form-control" id="gender" name="gender" required="required">
                                         <option>----select----</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="dob" class="form-label"><b>Date of Birth</b></label>
                                    <input type="date" class="form-control" placeholder="Enter Date of Birth" name="dob" id="dob" required="required">
                                </div>
                            </div>
                           
                            
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="location" class="form-label"><b>Location</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Location" name="location" id="location" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="mobile" class="form-label"><b>Mobile No</b></label>
                                    <input type="number" class="form-control" placeholder="Enter Mobile No" name="mobile" id="mobile" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="email" class="form-label"><b>Email</b></label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="aadhar" class="form-label"><b>Aadhar Number</b></label>
                                    <input type="text" class="form-control" placeholder="Enter Aadhar Number" name="aadhar" id="aadhar">
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