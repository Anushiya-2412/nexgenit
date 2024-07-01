<?php
session_start();
    include("db/dbConnection.php");
    
    $selQuery = "SELECT a.*,b.*,c.* FROM payment_tbl as a 
    LEFT JOIN 
    student_tbl AS b
     ON a.stu_id =b.stu_id 
     LEFT JOIN course_tbl AS c
      ON b.course_id = c.course_id 
      WHERE b.entity_id =3 
      AND a.payment_status ='Active';";
    $resQuery = mysqli_query($conn , $selQuery); 
    
?>  

<!DOCTYPE html>
<html lang="en">

<?php include ("head.php")  ?>
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

            <div class="d-none" id="clientDetail">
                <form name="frm" method="post">
                    <input type="hidden" name="hdnAction" value="">
                    <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Payment Details</h4>
                    <div class="modal-footer p-2">
                    <button type="button" class="btn btn-danger" onclick="javascript:location.href='payment.php'" >Back</button>
                    </div> 
                    </div>  
                <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="card p-3">
                                        <h4>Name</h4> 
                                        <span class="detail" id="name"></span>
                                    </div>
                                </div>  
                                <div class="col-sm-3 ">
                                    <div class="card p-3">
                                        <h4>Course Name</h4>
                                        <span class="detail" id="course_name"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3 ">
                                    <div class="card p-3">
                                        <h4>Charge</h4>
                                        <span class="detail" id="charge"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card p-3">
                                        <h4>Course Duration</h4>
                                        <span class="detail" id="course_duration"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card p-3">
                                        <h4>Amount Received</h4>
                                        <span class="detail" id="amount_received"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card p-3">
                                        <h4>Balance</h4>
                                        <span class="detail" id="balance"></span>
                                    </div>
                                </div>
                                
                                
                                </div>
                            </div>
                            <h3 class="modal-title p-2" id="myModalLabel">Payment History</h3>
                            <table id="scroll-horizontal-datatable1" class="table table-striped w-100 nowrap">
                            <thead>
                                <tr class="bg-light">
                                            <th scope="col-1">S.No.</th>
                                            <th scope="col">Payment Date</th>
                                            <th scope="col">Amount Received</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Download</th>
                                            
                            </tr>
                            </thead>
                            <tbody id="paymentHistoryBody">                                
                                
                            </tbody>
                        </table>
                    </form>  
                </div>

                <!-- Start Content-->
                <div class="container-fluid" id="paymentContent">

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

                                </div>
                                <h4 class="page-title">Payment</h4>   
                            </div>
                        </div>
                    </div>

             <?php include "addPayment.php"?> <!---add Client popup--->

             <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Course Fees </th>
                                    <th scope="col">Month Duration</th>
                                    <th scope="col">Balance Fees</th> 
                                    <th scope="col">Action</th>
                                    
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; while($row = mysqli_fetch_array($resQuery , MYSQLI_ASSOC)) { 
                        $id              = $row['pay_id']; 
                        $first_name           = $row['first_name']; 
                        $last_name         = $row['last_name'];
                        $name         = $first_name . $last_name; 
                        $course_name      = $row['course_name'];
                        $course_month     = $row['course_month'];
                        $amount_received       =$row['amount_received']; 
                        // $email        =$row['client_email'];
                          
                        if($course_month ==3){
                            $course_fees = $row['course_fees_3'];  
                        }elseif($course_month ==6){
                            $course_fees = $row['course_fees_6'];  
                        }else{
                            $course_fees = $row['course_fees_12'];  
                        }

                        $balance = $course_fees - $amount_received ;
                        
                        ?>
                     <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $course_name; ?></td>
                        <td><?php echo $course_fees; ?></td>
                        <td><?php echo $course_month; ?>Mounts</td>
                        <td><?php echo $balance; ?></td>
                    
                        <td>
                            <button type="button" class="btn btn-circle btn-warning text-white modalBtn" onclick="goEditEmp(<?php echo $id; ?>);" data-bs-toggle="modal" data-bs-target="#editPayment"><i class='bi bi-pencil-square'></i></button>
                            <button class="btn btn-circle btn-success text-white modalBtn" onclick="goViewPayment(<?php echo $id; ?>);"><i class="bi bi-eye-fill"></i></button>
                            
                        </td>
                      </tr>
                      <?php } ?>
                        
                    </tbody>
                  </table>


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
    <?php include "theme.php"?>  

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

</body>



</html>



<script>
    

$(document).ready(function() {

function resetForm(formId) {
  document.getElementById(formId).reset(); // Reset the form
}

  //--- start edit form update --------------------------
  $('#editpaymentform').off('submit').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var formData = new FormData(this);
        $.ajax({
            url: "action/actPayment.php",
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
                        $('#editPayment').modal('hide'); // Close the modal
                        
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
 
});

//-----start edit Payment-------------------------------------

function goEditEmp(editId)
{ 
      $.ajax({
        url: 'action/actPayment.php',
        method: 'POST',
        data: {
          editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {

            $('#payeditid').val(response.pay_id);
            let name = response.first_name + " " + response.last_name;
            $('#studentname').val(name);
            $('#coursename').val(response.course_name);
            $('#coursefees').val(response.course_fees);
            $('#monthduration').val(response.course_month + " Months");
            $('#balancefees').val(response.amount_received);

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
//-----end edit Payment-------------------------------

function goViewPayment(id)
{
    $.ajax({
        url: 'paymentDetail.php',
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            console.log(response);
          $('#paymentContent').hide();
          $('#clientDetail').removeClass('d-none');
          $('#balance').text(response.student.balance);
          $('#course_duration').text(response.student.course_duration);
          $('#charge').text(response.student.charge);
          $('#course_name').text(response.student.course_name);
          $('#name').text(response.student.name);
          $('#amount_received').text(response.student.amount_received);
          $('#paymentStatus').text(response.student.pay_status);


          var paymentHistory = response.payment_history;
          console.log(paymentHistory);
            var html = '';
            for (var i = 0; i < paymentHistory.length; i++) {
                var payment = paymentHistory[i];
                html += '<tr>';
                html += '<td>' + (i + 1) + '</td>'; // S.No.
                html += '<td>' + payment.payment_date + '</td>'; // Payment Date
                html += '<td>' + payment.amount_received + '</td>'; // Amount Received
                html += '<td>' + payment.payment_method + '</td>'; // Payment Method
                html += '<td><input type="button" value="Download" class="btn btn-primary" onclick="gotoDetailPayment(' + payment.payHisId + ')"></td>'; // Action button
                html += '</tr>';
            }
            $('#paymentHistoryBody').html(html); // Append HTML to table body
            
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}

//---------------------------------
function gotoDetailPayment(id) {
    alert(id);
    window.location.href = "saveinvoice.php?payHisId="+id;
     // Ensure the alert is shown
}





</script>





