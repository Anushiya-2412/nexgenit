<?php
include("db/dbConnection.php");

// Check if employee id is provided
if(isset($_POST['id']) && $_POST['id'] != '') {
    $syllabus_id = $_POST['id'];

    // Prepare and execute the SQL query
    $selQuery = "SELECT syllabus_tbl.*,
    topic_tbl.*,
    course_tbl.*
     FROM syllabus_tbl
    LEFT JOIN topic_tbl on syllabus_tbl.syllabus_id=topic_tbl.syllabus_id
    LEFT JOIN course_tbl on syllabus_tbl.course_id=course_tbl.course_id
    WHERE topic_tbl.syllabus_id = '$syllabus_id'";
    
    $result1 = $conn->query($selQuery);

    
} else {
    // If employee id is not provided, redirect to employees.php
    header("Location: syllabus.php");
    exit(); // Ensure script stops executing after redirection
}
?>

          <!-- <form name="frm" method="post">
              <input type="hidden" name="hdnAction" value=""> -->
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Subjects Topic List</h4>
              <div class="modal-footer p-2">
              <button type="button" class="btn btn-danger" onclick="javascript:location.href='syllabus.php'" >Back</button>
            </div>
            </div>   
           <!-- <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card p-3">
                                <h4>Name</h4> 
                                <span class="detail"><?php echo $name;?></span>
                            </div>
                        </div>  
                         <div class="col-sm-3 ">
                            <div class="card p-3">
                                <h4>Course Name</h4>
                                <span class="detail"><?php echo  $course ;?></span>
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
                                <h4>Aadhar Number</h4>
                                <span class="detail"><?php echo $aadhar;?></span>
                            </div>
                        </div>
                    </div>
            </div>
            </form>    -->
            <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
                    <thead>
                        <tr class="bg-light">
                                    <th scope="col-1">S.No.</th>
                                    <th scope="col">Syllabus</th>
                                    <th scope="col">Topic</th>
                                    <th scope="col">Topic Duration</th>
                                    <th scope="col">Course</th>
                                    
                                    
                      </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; while($row = mysqli_fetch_array($result1 , MYSQLI_ASSOC)) { 
                        $id = $row['syllabus_id']; 
                        $e_id = $row['entity_id'];
                        $syllabu=$row['syllabus_name'];
                        $topic=$row['topic_name']; 
                        $topic_duration=$row['topic_duration'];
                        $course=$row['course_name'];         
                        
                        ?>
                     <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $syllabu; ?></td>
                        <td><?php echo $topic; ?></td>
                        <td><?php echo $topic_duration; ?></td>
                        <td><?php echo $course; ?></td>
                       
                    
                        
                      </tr>
                      <?php } ?>
                        
                    </tbody>
                  </table>

    
