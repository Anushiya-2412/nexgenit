<?php
include("db/dbConnection.php");

// Check if employee id is provided
if(isset($_POST['id']) && $_POST['id'] != '') {
    $clientId = $_POST['id'];

    // Prepare and execute the SQL query
    $selQuery = "SELECT * FROM client_tbl WHERE client_id='$clientId'";
    
    $result1 = $conn->query($selQuery);

    if($result1) {
        // Fetch employee details
        $row = mysqli_fetch_array($result1 , MYSQLI_ASSOC);
       $name=$row['client_name'];
       $company=$row['client_company'];
       $location=$row['client_location'];
       $email=$row['client_email'];
       $mobile=$row['client_phone'];
       $gst=$row['client_gst'];

    } else {
        echo "Error executing query: " . $conn->error;
    }
} else {
    // If employee id is not provided, redirect to employees.php
    header("Location: clients.php");
    exit(); // Ensure script stops executing after redirection
}
?>
                 
      <div class="table-responsive">
          <form name="frm" method="post">
              <input type="hidden" name="hdnAction" value="">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Client Details</h4>
            </div>  
           <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Name</h4> 
                                <span class="detail"><?php echo $name;?></span>
                            </div>
                        </div>  
                         <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Company Name</h4>
                                <span class="detail"><?php echo  $company;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Place</h4>
                                <span class="detail"><?php echo $location;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Email Id</h4>
                                <span class="detail"><?php echo $email;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Mobile No.</h4>
                                <span class="detail"><?php echo  $mobile;?></span>
                            </div>
                        </div>
                        <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>GST No.</h4>
                                <span class="detail"><?php echo $gst;?></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="javascript:location.href='clients.php'" >Back</button>
               
            </div> 
            </form>   
      </div>
    
