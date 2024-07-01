<!-- Modal -->
<div class="modal fade" id="addEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Add New Employee </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="frmAddEmployee" id="addEmployee" class="form-horizontal">
                                                            <input type="hidden" name="hdnAction" value="addEmployee">
                                                            <div class="row mb-3">
                                                                <label for="fname" class="col-3 col-form-label">First Name</label>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces" id="fname" name="fname" placeholder="Enter Employee First Name" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="lname" class="col-3 col-form-label">Last Name</label>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" pattern="^\S.*$" title="Please enter a value with no leading or trailing spaces"+ id="lname" name="lname" placeholder="Enter Employee Last Name" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="mobile" class="col-3 col-form-label">Mobile No.</label>
                                                                <div class="col-9">
                                                                    <input type="tel" class="form-control" pattern="[0-9]{10}" id="mobile" name="mobile" placeholder="Enter Mobile No" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="pemail" class="col-3 col-form-label">Personal Email</label>
                                                                <div class="col-9">
                                                                    <input type="email" class="form-control" id="pemail" name="pemail" placeholder="Enter Email" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="cemail" class="col-3 col-form-label">Company Email</label>
                                                                <div class="col-9">
                                                                    <input type="email" class="form-control" id="cemail" name="cemail" placeholder="Enter Email" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="dob" class="col-3 col-form-label">Date of Birth</label>
                                                                <div class="col-9">
                                                                <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Date of Birth" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="address" class="col-3 col-form-label">Address</label>
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="jDate" class="col-3 col-form-label">Joining Date</label>
                                                                <div class="col-9">
                                                                    <input type="date" class="form-control" id="jDate" name="jDate" placeholder="Enter Date of Joining">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="role" class="col-3 col-form-label">Role</label>
                                                                <div class="col-9">
                                                                    <select class="form-control" id="role" name="role" required>
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
                                                                <label for="ms" class="col-3 col-form-label">Marital Status</label>
                                                                <div class="col-9">
                                                                    <select name="ms" id="ms" class="form-control" required>
                                                                        <option>---Select---</option>
                                                                        <option value="Married">Married</option>
                                                                        <option value="Unmarried">Unmarried</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>