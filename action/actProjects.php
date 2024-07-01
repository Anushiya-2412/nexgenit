<?php
    
    
    include("../db/dbConnection.php");
    session_start();
    if(isset($_REQUEST['hdnAction']) && $_REQUEST['hdnAction'] == 'addProject')
    {
        //print_r($_REQUEST);  ;
         
        $project           = $_REQUEST['project'];
        $client         = $_REQUEST['client'];
        $sDate           = $_REQUEST['sDate']; 
        $hours        = $_REQUEST['hours'];
        $yob        = $_REQUEST['yob'];
        $eo        = $_REQUEST['eo'];
        $note        = $_REQUEST['note'];
        
        //$session        = $_REQUEST['session'];//$module   = $duration*$session;// $trainer= $batch        = $_REQUEST['batch'];//$value      = $_REQUEST['value'];

        $query = "INSERT INTO tbl_project(project,client,sDate,hours,yob,eo,note) VALUES('$project','$client','$sDate','$hours','$yob','$eo','$note')";    
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Project details added successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in adding Project details!";
        }
        header("Location:../projects.php");
    }
     if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'addIncome')
    {
        //print_r($_REQUEST); exit ; 
         
        $projectId           = $_REQUEST['projectId'];
        $value         = $_REQUEST['value'];

        $query = "UPDATE tbl_project SET value = '$value' WHERE id = '$projectId'";    
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Project value added successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in adding Project value!";
        }
        header("Location:../projects.php");
    }
    
    if(isset($_REQUEST['deleteId']))
    {
        $id = $_REQUEST['deleteId'];
        $query = "UPDATE tbl_project SET status = 'Inactive' WHERE id = $id";
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Project details has been deleted successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in deleting project details!";
        }
        header("Location:../projects.php");
    }
    
    if(isset($_POST['projectId']) && $_POST['projectId'] != '')
    {
         $projectId = $_POST['projectId'];
        $duration = $_REQUEST['duration'];
        for($i=1; $i<=$duration; $i++)
        {
            $f = "duration_".$i;
            $durationArray[] =  $_REQUEST[$f];  
        }
        $session = $_REQUEST['session'];
        for($i=1; $i<=$session; $i++)
        {
            $f = "session_".$i;
            $sessionArray[] =  $_REQUEST[$f]; 
        }
        $module = $_REQUEST['hdnModule'];
        for($i=1; $i<=$module; $i++)
        {
            $f = "module_".$i;
            $moduleArray[] =  $_REQUEST[$f]; 
        }
        $batch = $_REQUEST['batch'];
        for($i=1; $i<=$batch; $i++)
        {
            $f = "batch_".$i;
            $batchArray[] =  $_REQUEST[$f]; 
        }
        $trainer = $_REQUEST['hdnTrainer'];
        for($i=0; $i<$trainer; $i++)
        {
            $f = "trainer_".$i;
            $trainerArray[] =  $_REQUEST[$f]; 
        }
        $durationList = implode("|",$durationArray); 
        $sessionList  = implode("|",$sessionArray);
        $moduleList  = implode("|",$moduleArray);
        $batchList  = implode("|",$batchArray);
        $trainerList  = implode(",",$trainerArray);
        
        $updateQuery = "UPDATE tbl_project SET duration = '$duration' , session = '$session' , module = '$module' , batch = '$batch' , trainer = '$trainer'  WHERE id = '$projectId'";
        mysqli_query($conn , $updateQuery); 
        $query = "UPDATE tbl_schedule SET daysList = '$durationList' , sessionList = '$sessionList' , moduleList = '$moduleList' , batchList = '$batchList' , trainerList = '$trainerList' WHERE project = '$projectId'";
        
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Project details has been added successfully!";
             header("Location:../schedule.php?projectId=$projectId");
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in adding project details!";
            header("Location:../projects.php");
        }
       
        
    }
    
?>