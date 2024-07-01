    
 <!-- Modal -->
        <div class="modal fade" id="editPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="frmeditPayment" id="editpaymentform">
                    <input type="hidden" name="hdnAction" value="editPayment">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel">Add Fees Payment</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="name" class="form-label"><b>Student Name</b></label>
                                    <input type="text" class="form-control"  name="studentname" id="studentname" disabled>
                                    <input type="hidden" class="form-control"  name="payeditid" id="payeditid" required="required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="Company" class="form-label"><b>Course Name </b></label>
                                    <input type="text" class="form-control"  name="coursename" id="coursename" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="location" class="form-label"><b>Course Fees</b></label>
                                    <input type="text" class="form-control" name="coursefees" id="coursefees" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="mobile" class="form-label"><b>Month Duration</b></label>
                                    <input type="text" class="form-control"  name="monthduration" id="monthduration" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="email" class="form-label"><b>Balance Fees</b></label>
                                    <input type="number" class="form-control" name="balancefees" id="balancefees" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="addfees" class="form-label"><b>Add Fees </b></label>
                                    <input type="text" class="form-control" placeholder="Enter Add Fees" name="addfees" id="addfees">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="paymentmtd" class="form-label"><b>Paymnet Status</b></label>
                                    <select name="paymentStatus" id="paymentStatus" class="form-control">
                                        <option value="">---select---</option>
                                        <option value="Partially Paid">Partially Paid</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                        
                                        
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="date" class="form-label"><b>Date </b></label>
                                    <input type="date" class="form-control"  name="date" id="date">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group pb-3">
                                    <label for="paymentmtd" class="form-label"><b>Paymnet Method </b></label>
                                    <select name="paymentmtd" id="paymentmtd" class="form-control">
                                        <option value="Cash">Cash</option>
                                        <option value="Online Payment">Online Payment </option>
                                        <option value="'Net Banking">Net Banking</option>
                                        
                                    </select>
                                    
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


