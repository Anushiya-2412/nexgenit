
<?php
session_start();
    include("db/dbConnection.php");
    
    $selQuery = "SELECT employee_tbl.*, emp_additional_tbl.* FROM employee_tbl
LEFT JOIN emp_additional_tbl ON emp_additional_tbl.emp_id = employee_tbl.emp_id WHERE employee_tbl.emp_status='Active'";
    
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

                <!-- Start Content-->
                
                <div id="employeeDetail">
                <div class="container-fluid" id="employeeTblCon">

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
                                        <button type="button" class="btn btn-info" id="addEmpBtn" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                                            Add New Employee
                                        </button>
                                    </div>
                                </div>
                                <h4 class="page-title">Employee</h4>   
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
<?php include("addEmployee.php");?>
<?php include("editEmployee.php");?>
<?php include("docEmployee.php");?>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="mb-4">
                                        <!-- Data table Start-->
                                        <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>

                                            </thead>
                                            <tbody> 
                                            <?php $i=1; while($row = mysqli_fetch_array($resQuery , MYSQLI_ASSOC)) { 
                            
                            $emp_id   = $row['emp_id'];     
                           $emp_first_name  = $row['emp_first_name'];  
                            $emp_last_name   = $row['emp_last_name'];  
                              $email          = $row['emp_company_email'];
                           $address        = $row['emp_address'];   
                          $role        = $row['emp_role'];   
                           $jDate    = $row['emp_joining_date'];
                           $mobile   =$row['emp_mobile'];
                       $date=date_create($jDate);
                       $name=$emp_first_name.' '.$emp_last_name;

                      date_format($date,"Y/m/d H:i:s");
                      ?>
                   <tr>
                       <td><?php echo $i; $i++; ?></td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $mobile; ?></td>
                      <td><?php echo $email; ?></td>
                      <td><?php echo $role; ?></td>
                      <td>
                          <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="goEditEmp(<?php echo $emp_id; ?>);" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class='bi bi-pencil-square'></i></button>
                          <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewEmp(<?php echo $emp_id; ?>);" ><i class='bi bi-eye-fill'></i></button>
                          <button type="button" id="docEmp" class="btn btn-circle btn-primary text-white modalBtn" onclick="goDocEmp(<?php echo $emp_id; ?>);" data-bs-toggle="modal" data-bs-target="#docEmployeeModal"><i class='bi bi-file-earmark-text'></i></button>
                          <button class="btn btn-circle btn-danger text-white" onclick="goDeleteEmployee(<?php echo $emp_id; ?>);"><i class='bi bi-trash'></i></button>
                          
                      </td>
                    </tr>
                    <?php } ?>                        
                                            </tbody>
                                        </table>
                                        <!-- Data table End-->

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

<script>

$(document).ready(function () {
  $('#addEmpBtn').click(function () {
      resetForm('addEmployee');
  });

  $('#editEmployee').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actEmployees.php",
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
                        $('#editEmployeeModal').modal('hide'); // Close the modal
                        
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
                    text: 'An error occurred while Edit employee data.'
                });
                // Re-enable the submit button on error
                $('#updateBtn').prop('disabled', false);
            }
        });
    });
    //----end edit page update--------------------------------
    $('#docEmployee').off('submit').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "action/actEmployees.php",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000
                        }).then(function() {
                            window.location.href="employee.php";
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
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while uploading documents.'
                    });
                }
            });
        });
});

function resetForm(formId) {
    document.getElementById(formId).reset(); // Reset the form
}

    document.addEventListener('DOMContentLoaded', function() {
    $('#addEmployee').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actEmployees.php",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000
                    }).then(function() {
                        $('#addEmployeeModal').modal('hide'); // Close the modal
                        $('.modal-backdrop').remove(); // Remove the backdrop
                        setTimeout(function() {
                          $('#scroll-horizontal-datatable').load(location.href + ' #scroll-horizontal-datatable > *', function() {
                               
                               $('#scroll-horizontal-datatable').DataTable().destroy();
                               
                                $('#scroll-horizontal-datatable').DataTable({
                                    "paging": true, // Enable pagination
                                    "ordering": true, // Enable sorting
                                    "searching": true // Enable searching
                                });
                            });
                        }, 300); // Add a small delay to ensure the modal is fully hidden
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
                    text: 'An error occurred while adding employee data.'
                });
                // Re-enable the submit button on error
                $('#submitBtn').prop('disabled', false);
            }
        });
    });
});

function goEditEmp(id) 
  
  {
    $.ajax({
        url: 'ajaxEdit.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#empId').val(response.empId);
          $('#editFname').val(response.first_name);
          $('#editLname').val(response.last_name);
          $('#editMobile').val(response.mobile);
          $('#personalEmail').val(response.personal_email);
          $('#companyEmail').val(response.company_email);
          $('#editDob').val(response.emp_dob);
          $('#editAddress').val(response.address);
          $('#editJDate').val(response.emp_joining_date);
          $('#editRole').val(response.emp_role);
          $('#editMs').val(response.married_status);
   
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}

function goDocEmp(id) 
  
  {
    $.ajax({
        url: 'getDocEmp.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#empDocId').val(response.empId);
          $('#userName').val(response.username);
          var baseUrl = window.location.origin + "/nexgenIT/document/employees/"; 
          var aadharUrl = baseUrl + response.aadhar;
          var panUrl = baseUrl + response.pan;
          var bankUrl = baseUrl + response.bank;
                    
            // Set the href attribute and text content of the a tags with the constructed URLs
            $('#aadharLink').attr('href', aadharUrl).find('#aadharImg').text(response.aadhar);
            $('#panLink').attr('href', panUrl).find('#panImg').text(response.pan);
            $('#bankLink').attr('href', bankUrl).find('#bankImg').text(response.bank);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}

function goViewEmp(id) 
  {
    $.ajax({
        url: 'employeeDetail.php',
        method: 'POST',
        data: {
            id: id
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#employeeTblCon').hide();
          $('#employeeDetail').html(response);
         

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}


function goDeleteEmployee(deleteId)
{
    //alert(id);
    if(confirm("Are you sure you want to delete employee?"))
    {
      $.ajax({
        url: 'action/actEmployees.php',
        method: 'POST',
        data: {
          deleteId: deleteId
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