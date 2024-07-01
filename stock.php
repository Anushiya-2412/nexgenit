
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
                <div class="container-fluid">

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
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            Add New Stock
                                        </button>
                                    </div>
                                </div>
                                <h4 class="page-title">Stocks</h4>   
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row g-4">
                        <div class="col-12">
                            <div class="mb-4">

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Stock Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div> <!-- end modal header -->
                                                    <div class="modal-body">

                                                                <form name="Stockfrm" class="form-horizontal" >
                                                                       
                                                                    <div class="row mb-3">
                                                                        <label for="date" class="col-3 col-form-label">Date</label>
                                                                        <div class="col-9">
                                                                            <input type="date" class="form-control" id="date">
                                                                        </div>
                                                                    </div>         

                                                                    <div class="row mb-3">
                                                                        <label for="product name" class="col-3 col-form-label"> Product Name</label>
                                                                        <div class="col-9">
                                                                            <input type="text" class="form-control" id="productname" placeholder="Product Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="quantity" class="col-3 col-form-label">Quantity</label>
                                                                        <div class="col-9">
                                                                            <input type="number" class="form-control" id="quantity" placeholder="Enter the Quantity">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="instock" class="col-3 col-form-label">In-Stock</label>
                                                                        <div class="col-9">
                                                                            <input type="number" class="form-control" id="in-quantity" placeholder="Enter the Quantity">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="outstock" class="col-3 col-form-label">Delivery-Date</label>
                                                                        <div class="col-9">
                                                                            <input type="date" class="form-control" id="ddate" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="outstock" class="col-3 col-form-label">Out-Stock</label>
                                                                        <div class="col-9">
                                                                            <input type="number" class="form-control" id="out-quantity" placeholder="Enter the Quantity">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                   
                                                                </form>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" onclick="validateForm()">Submit</button>
                                                    </div> <!-- end modal footer -->
                                                </div> <!-- end modal content-->
                                            </div> <!-- end modal dialog-->
                                        </div> <!-- end modal-->

                                        <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                                            <thead>
                                                <tr>
                                                    <th>S.NO</th>
                                                    <th>Date</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>In-Stock</th>
                                                    <th>Delivery-Date</th>
                                                    <th>Out-Stock</th>
                                                    <th style="text-align: center;">Action</th>
                                                 </tr>
                                            </thead>
                                            <tbody> 
                                                <tr>
                                                    <td>1</td>
                                                    <td>01-04-2024</td>
                                                    <td>Sunrise</td>
                                                    <td>500</td>
                                                    <td>350</td>
                                                    <td>07-04-2024</td>
                                                    <td>150</td>
                                                    <td>
                                                      
                                                            <button type="button" class="btn btn-warning">Edit</button>
                                                            <button type="button" class="btn btn-danger">Delete</button>
                                                            <button type="button" class="btn btn-success">Submit</button>
                                                        
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>01-02-2024</td>
                                                    <td>Bru</td>
                                                    <td>600</td>
                                                    <td>400</td>
                                                    <td>05-02-2024</td>
                                                    <td>200</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning">Edit</button>
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                        <button type="button" class="btn btn-success">Submit</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>01-02-2024</td>
                                                    <td>Coffee Seeds</td>
                                                    <td>50kg</td>
                                                    <td>25kg</td>
                                                    <td>10-02-2024</td>
                                                    <td>25kg</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning">Edit</button>
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                        <button type="button" class="btn btn-success">Submit</button>
                                                   </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>01-02-2024</td>
                                                    <td>MILK</td>
                                                    <td>10Li</td>
                                                    <td>8li</td>
                                                    <td>09-02-2024</td>
                                                    <td>2li</td>
                                                    <td>
                                                       
                                                            <button type="button" class="btn btn-warning">Edit</button>
                                                            <button type="button" class="btn btn-danger">Delete</button>
                                                            <button type="button" class="btn btn-success">Submit</button>
                                                        
                                                    </td>
                                                </tr>                         
                                            </tbody>
                                        </table>

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

    <!-- Theme Settings -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
            <h5 class="text-white m-0">Theme Settings</h5>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            <div data-simplebar class="h-100">
                <div class="card border-0 mb-0 p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <h5 class="my-3 fs-16 fw-bold">Color Scheme</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light" value="light">
                            <label class="form-check-label" for="layout-color-light">Light</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark" value="dark">
                            <label class="form-check-label" for="layout-color-dark">Dark</label>
                        </div>
                    </div>

                    <div>
                        <h5 class="my-3 fs-16 fw-bold">Menu Color</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-light" value="light">
                                <label class="form-check-label" for="leftbar-color-light">Light</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-dark" value="dark">
                                <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-brand" value="brand">
                                <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-size">
                        <h5 class="my-3 fs-16 fw-bold">Sidebar Size</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-default" value="default">
                                <label class="form-check-label" for="leftbar-size-default">Default</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-compact" value="compact">
                                <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-small" value="condensed">
                                <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-full" value="full">
                                <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-fullscreen" value="fullscreen">
                                <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen Layout</label>
                            </div>
                        </div>
                    </div>

                    <div id="layout-position">
                        <h5 class="my-3 fs-16 fw-bold">Layout Position</h5>

                        <div class="btn-group checkbox" role="group">
                            <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="fixed">
                            <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                            <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                            <label class="btn btn-soft-primary w-sm ms-0" for="layout-position-scrollable">Scrollable</label>
                        </div>
                    </div>

                    <div id="sidebar-user">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <label class="fs-16 fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="sidebar-user" id="sidebaruser-check">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="offcanvas-footer border-top p-3 text-center">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                </div>
                <div class="col-6">
                    <a href="#" role="button" class="btn btn-primary w-100">Buy Now</a>
                </div>
            </div>
        </div>
    </div>  

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

    <!-- Datatable Demo Aapp js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

    <script>
       
         /* document.addEventListener("DOMContentLoaded", function () {
            var jsonString = '[{"First name":"Yuri","Last name":"Berry","Position":"Chief Marketing Officer (CMO)","Office":"New York","Age":40,"Start date":"2009/06/25","Salary":"$675,000","Extn.":6154,"E-mail":"y.berry@datatables.net"},{"First name":"Caesar","Last name":"Vance","Position":"Pre-Sales Support","Office":"New York","Age":21,"Start date":"2011/12/12","Salary":"$106,450","Extn.":8330,"E-mail":"c.vance@datatables.net"},{"First name":"Tiger","Last name":"Nixon","Position":"System Architect","Office":"Edinburgh","Age":61,"Start date":"2011/04/25","Salary":"$320,800","Extn.":5421,"E-mail":"t.nixon@datatables.net"}]';
    
            var jsonData = JSON.parse(jsonString);
    
            var dynamicTableBody = document.getElementById('dynamic-table-body');
            var tableContent = '';
    
            jsonData.forEach(function (item) {
                tableContent += '<tr>';
                tableContent += '<td>' + item["Product Name"] + '</td>';
                tableContent += '<td>' + item["Quantity"] + '</td>';
                tableContent += '<td>' + item["Location"] + '</td>';
                tableContent += '</tr>';
            });
    
            dynamicTableBody.innerHTML = tableContent;

        });*/
        function validateForm() {
    var date = document.getElementById('date').value;
    var pname = document.getElementById('productname').value;
    var qty = document.getElementById('quantity').value;
    var instockInput = document.getElementById('in-quantity');
    var outstock = document.getElementById('out-quantity').value;

    // Parse quantity values to integers
    var parsedQty = parseInt(qty);
    var parsedOutstock = parseInt(outstock);

    // Calculate instock by subtracting outstock from quantity
    var instock = parsedQty - parsedOutstock;

    // Display instock value
    instockInput.value = instock;

    // Array to store the fields with errors
    var errorFields = [];

    // Check if each field is empty or if quantity is not a number
    if (date === "") {
        errorFields.push('Date');
    }

    if (pname === "") {
        errorFields.push('Product Name');
    }

    // Check if quantity is not a number
    if (isNaN(parsedQty) || qty === "") {
        errorFields.push('Quantity');
    }
    if (isNaN(instock) || isNaN(parsedOutstock) || outstock === "") {
        errorFields.push('Out-Stock Quantity');
    }

    // If there are errors, display alert messages for each error
    if (errorFields.length > 0) {
        var errorMessage = "Please fill in the following fields correctly:\n";
        for (var i = 0; i < errorFields.length; i++) {
            errorMessage += "- " + errorFields[i] + "\n";
        }
        alert(errorMessage);
        return false; // Prevent form submission
    } else {
        alert("One more row added...");
        return true; // Allow form submission
    }
}



        
       
    </script>

</body>

</html>