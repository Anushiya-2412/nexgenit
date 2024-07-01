<?php
@session_start();
   // print_r($_REQUEST);
    //print_r($_FILES);
    include("../db/dbConnection.php");
    if(isset($_REQUEST['hdnAction']) && $_REQUEST['hdnAction'] == 'uploadStudent')
    {
        $projectId = $_REQUEST['projectId'];
        $batch     = $_REQUEST['batch'];
        $str        = $_REQUEST['hdnStr'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["fileStudent"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
//if (file_exists($target_file)) {  echo "Sorry, file already exists.";  $uploadOk = 0;}

// Check file size
    if ($_FILES["fileStudent"]["size"] > 500000) {
        $_SESSION['message'] = "Sorry, your file is too large.";
                header("Location:../attendanceDetail.php?projectId=$projectId"); exit;
    }

// Allow certain file formats
    if($fileType != "csv" && $fileType != "txt") {
        $_SESSION['message'] = "Sorry, only CSV files are allowed.";
                header("Location:../attendanceDetail.php?projectId=$projectId"); exit;
    }

    if (!move_uploaded_file($_FILES["fileStudent"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileStudent"]["name"])). " has been uploaded.";
        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
            header("Location:../attendanceDetail.php?projectId=$projectId"); exit;
    }
    $file = $_FILES['fileStudent']['name'];
    $fileName = $target_dir.$file;
    $myfile = fopen($fileName, "r") or die("Unable to oplken file!");
     
    // Output one line until end-of-file
    $i=1;
    $c=1;
        while(!feof($myfile)) {
            $x = fgets($myfile);
            $y = explode(',',$x); //print_r($y); exit;
            if($i == 1)
            {
                //print_r($y); exit;
                
                if($y[0] == 'S.No' && $y[1] == 'Roll No' && $y[2] == 'Name')
                {
                    $c=1;
                }
                else
                {
                    
                    $_SESSION['message'] = " Wrong format."; //echo $y[3]; exit;
                    header("Location:../attendanceDetail.php?projectId=$projectId");
                    exit;
                    //echo 'wrong format';
                    //$c=0; break;
                }
            }
            else
            {
                $rollNo = $y[1];
                $name = $y[2];
                $department = $y[3];
                if($name != '')
                {
                    $q = "INSERT INTO tbl_student(name , rollNo , department) VALUES('$name' , '$rollNo' , '$department')"; //exit;
                    mysqli_query($conn , $q); 
                    $last_id = mysqli_insert_id($conn);
                    
                    $query  = "INSERT INTO tbl_attendance (project , student , batch , attendance) VALUES('$projectId' , '$last_id' , '$batch' , '$str')";
                    $res = mysqli_query($conn , $query); 
                     if($res)
                    {
                        $_SESSION['message'] = "Student details added successfully!";
                    }
                    else
                    {
                        $_SESSION['message'] = "Unexpected error in adding Student details!";
                    }
                }
                
            }
         $i++; 
        }
    
        fclose($myfile);
        header("Location:../attendanceDetail.php?projectId=$projectId");
    
    }
    
    if(isset($_REQUEST['hdnAction']) && $_REQUEST['hdnAction'] == 'addStudent')
    {
        $projectId = $_REQUEST['projectId'];
        $batch     = $_REQUEST['batch'];
        $name       = $_REQUEST['name'];
        $rollNo     = $_REQUEST['rollNo'];
        $department = $_REQUEST['department'];
        $str        = $_REQUEST['hdnStr'];
       
             $q = "INSERT INTO tbl_student(name , rollNo , department) VALUES('$name' , '$rollNo' , '$department')";
        mysqli_query($conn , $q); 
        $last_id = mysqli_insert_id($conn);
        
        $query  = "INSERT INTO tbl_attendance (project , student , batch , attendance) VALUES('$projectId' , '$last_id' , '$batch' , '$str')";
        $res = mysqli_query($conn , $query); 
         if($res)
        {
            $_SESSION['message'] = "Student details added successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in adding Student details!";
        }
        header("Location:../attendanceDetail.php?projectId=$projectId");
       
    }
    
    if(isset($_REQUEST['action']) && $_REQUEST['action'] != '')
    {
        //print_r($_REQUEST);
        
        $action     =   $_REQUEST['action'];
        $projectId  = $_REQUEST['projectId'];
        $day        = $_REQUEST['day'];
        $batch      = $_REQUEST['batch'];
        
        $Q = "SELECT * FROM tbl_attendance WHERE project = '$projectId' AND batch = '$batch'";
        $res  = mysqli_query($conn , $Q);
        //while($row = mysqli_fetch_array($resQuery , MYSQLI_ASSOC)) {
        $studList = array();
        while($row = mysqli_fetch_array($res , MYSQLI_ASSOC))
        {
            //echo $row['attendance']; echo '<br>';
            $id = $row['id'];
            $attend = $row['attendance'];
            $st = explode("|",$attend);
        
        
        $i=1;
        $new = array();
        foreach($st as $a=>$b)
        {
        	if($day == $i)
            {
            	$m = explode(":",$b);
                $m[2] = 1;
                if($action == "getAttendanceList")
                {
                    $studList[] = $id;
                }
                else{
                    if($m[0] == 0 || $m[1] == 0)
                    {
                        $studList[] = $id; 
                    }
                }
                
                $b = implode(":",$m);
            }
            array_push($new,$b);
            $i++;
        }
        $newString = implode("|",$new);
        
        $upQ = "UPDATE tbl_attendance SET attendance = '$newString' WHERE id = '$id'"; 
        mysqli_query($conn , $upQ );
        }
        
        
        //header("Location:../attendanceDetail.php?projectId=$projectId");
        //header("Location:../test.php");
        
        if($action == 'freeze')
        {
            $_SESSION['message'] = "Attendance details submitted successfully!";
            header("Location:../attendanceDetail.php?projectId=$projectId");
        }
        else
        {
        $filename = 'AttendanceForDay_'.$day.'.doc';
header("Content-Type: application/force-download");
header( "Content-Disposition: attachment; filename=".basename($filename));
header( "Content-Description: File Transfer");
@readfile($filename);

?> 
 
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word"
        xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"=        xmlns="http://www.w3.org/TR/REC-html40">
        <head><meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
        <title></title>
        <!--[if gte mso 9]>
        <xml>
        <w:WordDocument>
        <w:View>Print
        <w:Zoom>100
        <w:DoNotOptimizeForBrowser/>
        </w:WordDocument>
        </xml>
        <![endif]-->
        <style>
        @page
        {
            font-family: Arial;
            size:215.9mm 279.4mm;  /* A4 */
            margin:14.2mm 17.5mm 14.2mm 16mm; /* Margins: 2.5 cm on each side */
        }
        h2 { font-family: Arial; font-size: 18px; text-align:center; }
        p.para {font-family: Arial; font-size: 13.5px; text-align: justify;}
                table, th, td {
                  border: 1px solid black;
                  border-collapse: collapse;
                }
        </style>
        </head>
        <body>
        <h2><?php if($action == "getAttendanceList") { echo "Attendance"; } else { echo "Absent"; } ?> List for Day <?php echo $day; ?></h2><br/>
         
         <table>
             <tr>
                 <th>S.No</th>
                 <th>Name</th>
                 <th>Roll No.</th>
                 <th>Department</th>
                 <th>Attendance <hr> FN     AN </th>
             </tr>
         
        <?php
             $attList = implode(",",$studList);
             if($attList == "")
             {
                 $attList = 0; ?>
                 <tr><td colspan="5">No Records found</td></tr>
                 <?php
             } else { 
        //print_r($studList);
        $abQ =  "SELECT a.attendance , b.name , b.id, b.rollNo , b.department  from `tbl_attendance` as a inner join tbl_student as b on a.student = b.id where a.id in($attList)";
        $resAb = mysqli_query($conn , $abQ);
        $sNo = 1;
        while($rowA = mysqli_fetch_array($resAb , MYSQLI_ASSOC))
        {
            ?>
                <tr>
                 <td><?php echo $sNo;  $sNo++; ?></td>
                 <td><?php echo $rowA['name'];?></td>
                 <td><?php echo $rowA['rollNo'];?></td>
                 <td><?php echo $rowA['department'];?></td>
                 <td>
                    <?php
                        $attend = $rowA['attendance'];
                        $stL = explode("|",$attend);
        $ai=1;
        
        foreach($stL as $a=>$b)
        {
        	if($day == $ai)
            {
            	$m = explode(":",$b);
                echo "&nbsp;&nbsp;";
                if($m[0] == 0){echo "A";}else{echo "P";}
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                if($m[1] == 0){echo "A";}else{echo "P";}
                
            }
           
            $ai++;
        }
                    ?>
                 </td>
             </tr>
            <?php
        }
             }
        ?>
        </table>
        </body> 
        </html>
        <?php
    }
    }
?>