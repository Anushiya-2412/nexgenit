<?php
include("db/dbConnection.php");

// Check if employee id is provided
if(isset($_POST['id']) && $_POST['id'] != '') {
    $empId = $_POST['id'];

    // Prepare and execute the SQL query
    $selQuery = "SELECT 
        employee_tbl.*, 
        emp_additional_tbl.* ,
        admin_tbl.*
    FROM 
        employee_tbl
    LEFT JOIN 
        emp_additional_tbl 
    ON 
        emp_additional_tbl.emp_id = employee_tbl.emp_id 
    LEFT JOIN admin_tbl 
        ON admin_tbl.user_id = employee_tbl.emp_user_id
    WHERE 
        employee_tbl.emp_id = '$empId';";
    
    $result1 = $conn->query($selQuery);

    if($result1) {
        // Fetch employee details
        $row = mysqli_fetch_array($result1 , MYSQLI_ASSOC);
        $name = $row['emp_first_name'] . ' ' . $row['emp_last_name'];
        $mobile = $row['emp_mobile'];
        $personal_email = $row['emp_personal_email'];
        $company_email = $row['emp_company_email'];
        $username = $row['username'];
        $pass = $row['pass'];
        
        $address = $row['emp_address'];
        $jDate = date_format(date_create($row['emp_joining_date']), "d-F-Y");
    } else {
        echo "Error executing query: " . $conn->error;
    }
} else {
    // If employee id is not provided, redirect to employees.php
    header("Location: employees.php");
    exit(); // Ensure script stops executing after redirection
}
?>

    <form name="frm" method="post">
        <input type="hidden" name="hdnAction" value="">
        <div class="modal-header p-2">
            <h4 class="modal-title" id="myModalLabel">Employee Details</h4>
            <div class="modal-footer p-2">
            <button type="button" class="btn btn-danger" onclick="javascript:location.href='employee.php'">Back</button>               
        </div>
        </div>  
         
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Name</h4> 
                        <span class="detail"><?php echo $name;?></span>
                    </div>
                </div>  
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Mobile</h4> 
                        <span class="detail"><?php echo $mobile;?></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Personal Email</h4> 
                        <span class="detail"><?php echo $personal_email;?></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Company Email</h4> 
                        <span class="detail"><?php echo $company_email;?></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>User Name</h4> 
                        <span class="detail"><?php echo $username;?></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Password</h4> 
                        <span class="detail"><?php echo $pass;?></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Joining Date</h4> 
                        <span class="detail"><?php echo $jDate;?></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card p-3">
                        <h4>Address</h4> 
                        <span class="detail"><?php echo $address;?></span>
                    </div>
                </div>
            </div>
        </div>
        
    </form>   
</div>
