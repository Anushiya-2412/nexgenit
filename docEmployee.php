
<!-- Modal -->
<div class="modal fade" id="docEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Add Employee Documents</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                <form name="frmDocEmployee" id="docEmployee" class="form-horizontal">
                                                    <div class="modal-body">
                                                            <input type="hidden" name="hdnAction" value="docEmployee">
                                                            <input type="hidden" name="userName" id="userName" value="">
                                                            <input type="hidden" name="empDocId" id="empDocId" value="">
                                                            <div class="row mb-3">
                                                                <label for="aadhar" class="col-3 col-form-label">Aadhar Card</label>
                                                                <div class="col-9">
                                                                    <input type="file" class="form-control" id="aadhar" name="aadhar" required>
                                                                    <a id="aadharLink" href="#" target="_blank"><span id="aadharImg"></span></a>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="pan" class="col-3 col-form-label">Pan Card</label>
                                                                <div class="col-9">
                                                                    <input type="file" class="form-control" id="pan" name="pan">
                                                                    <a id="panLink" href="#" target="_blank"><span id="panImg"></span></a>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="bank" class="col-3 col-form-label">Bank Account</label>
                                                                <div class="col-9">
                                                                    <input type="file" class="form-control" id="bank" name="bank">
                                                                    <a id="bankLink" href="#" target="_blank"><span id="bankImg"></span></a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="docSubmit">Submit</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>