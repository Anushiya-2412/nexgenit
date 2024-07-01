<!-- Modal -->
<div class="modal fade" id="editEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Employee Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form name="frmEditEmployee" id="editEmployee" action="action/actEmployees.php" method="post" novalidate>
                                                            <input type="hidden" name="hdnAction" value="hdneditEmployee">
                                                            <input type="hidden" name="empId" id="empId">
                                                            <div class="row mb-3">
                                                                <label for="editFname" class="col-3 col-form-label">First Name</label>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" id="editFname" name="fname" placeholder="Enter Employee First Name" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="editLname" class="col-3 col-form-label">Last Name</label>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" id="editLname" name="lname" placeholder="Enter Employee Last Name" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="editMobile" class="col-3 col-form-label">Mobile No.</label>
                                                                <div class="col-9">
                                                                    <input type="number" class="form-control" id="editMobile" pattern="[0-9]{10}" name="mobile" placeholder="Enter Mobile No" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="personalEmail" class="col-3 col-form-label">Personal Email</label>
                                                                <div class="col-9">
                                                                    <input type="email" class="form-control" id="personalEmail" name="pemail" placeholder="Enter Email" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="companyEmail" class="col-3 col-form-label">Company Email</label>
                                                                <div class="col-9">
                                                                    <input type="email" class="form-control" id="companyEmail" name="cemail" placeholder="Enter Email" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="editDob" class="col-3 col-form-label">Date of Birth</label>
                                                                <div class="col-9">
                                                                    <input type="date" class="form-control" id="editDob" name="dob" placeholder="Enter Date of Birth" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="editAddress" class="col-3 col-form-label">Address</label>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" id="editAddress" name="address" placeholder="Enter Address" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="editJDate" class="col-3 col-form-label">Joining Date</label>
                                                                <div class="col-9">
                                                                    <input type="date" class="form-control" id="editJDate" name="jDate" placeholder="Enter Date of Joining">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="editRole" class="col-3 col-form-label">Role</label>
                                                                <div class="col-9">
                                                                    <select class="form-control" id="editRole" name="role" required>
                                                                        <option value="">Select The Role</option>
                                                                        <option value="Team Leader">Team Leader</option>
                                                                        <option value="Jr.Developer">Jr. Developer</option>
                                                                        <option value="HR">HR</option>
                                                                        <option value="CEO">CEO</option>
                                                                        <option value="Sr.Developer">Sr. Developer</option>
                                                                        <option value="UI/UX Designer">UI/UX Designer</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="editMs" class="col-3 col-form-label">Marital Status</label>
                                                                <div class="col-9">
                                                                    <select name="ms" id="editMs" class="form-control">
                                                                        <option>---Select---</option>
                                                                        <option value="Married">Married</option>
                                                                        <option value="Unmarried">Unmarried</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="updateBtn">Submit</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>