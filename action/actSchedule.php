<?php
    include("../db/dbConnection.php");
    session_start();
    //print_r($_REQUEST); exit;
    if(isset($_REQUEST['hdnProjectId']) && $_REQUEST['hdnProjectId'] != '')
    {
        $projectId = $_REQUEST['hdnProjectId'];
        $schedule = '';
        $i=0;
        foreach($_REQUEST as $a=>$b)
        {
            if($a != "hdnProjectId") { 
            if(fmod($i,2) == 0) { $j = "|"; }
            else { $j = ","; }
            if($i==0) { $schedule = $b;}
            else { $schedule = $schedule.$j.$b; }
            $i++;
            }
        }
        //echo $schedule;
        $query = "UPDATE tbl_schedule SET schedule = '$schedule' WHERE project = '$projectId'";
        $res  = mysqli_query($conn,$query);
        if($res)
        {
            $_SESSION['message'] = "Schedule details added successfully!";
            $upProject = "UPDATE tbl_project SET project_status = 'Ongoing' WHERE id = '$projectId'";
            $resPro  = mysqli_query($conn,$upProject);
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in adding Schedule details!";
        }
        header("Location:../schedule.php");
    }
    
      
?>