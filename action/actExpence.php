<?php

    include("../db/dbConnection.php");
    session_start();
    if(isset($_REQUEST['hdnAction']) && $_REQUEST['hdnAction'] == 'addExpense')
    {
       // print_r($_REQUEST); 
       // print_r($_FILES);
        $destFile = '';
        if(isset($_FILES['bill']))
        {
              $errors= array();
              $file_name = $_FILES['bill']['name'];
              $file_size =$_FILES['bill']['size'];
              $file_tmp =$_FILES['bill']['tmp_name'];
              $file_type=$_FILES['bill']['type'];
              $file_ext=strtolower(end(explode('.',$_FILES['bill']['name']))); 
              
              $extensions= array("jpeg","jpg","png");
              
              if(in_array($file_ext,$extensions)=== false){
                 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
              }
              
              if($file_size > 2097152){
                 $errors[]='File size must be less than 2 MB';
              }
              
              if(empty($errors)==true){
                  $imagePath = '../bills/';
                  $destFile = $file_name;
                  if(file_exists($imagePath.$file_name))
                  {
                       $uniquesavename = time().uniqid(rand());  
                      $destFile = $uniquesavename . '.' . $file_ext;  
                      move_uploaded_file($file_tmp, $imagePath.$destFile);
                     // echo "file ". $file_name. " already exists!"; exit;
                  }
                  else
                  {
                      move_uploaded_file($file_tmp, $imagePath.$destFile);
                  }
                 
                
              }else{
                 print_r($errors);
                 $_SESSION['message'] = "Unexpected error in adding Expense details!";
                 header("Location:../expenseDetail.php?projectId=$projectId");
              }
        }
        
        $projectId           = $_REQUEST['projectId'];
        $trainer         = $_REQUEST['trainer'];
        $expense           = $_REQUEST['expense'];
        if($expense == 'Others') { $expense           = $_REQUEST['others'];}
        $amount        = $_REQUEST['amount'];
         
        $query = "INSERT INTO tbl_expense(project,trainer,expense,amount,bill) VALUES('$projectId','$trainer','$expense','$amount','$destFile')";    
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Expense details added successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in adding Expense details!";
        }
        if($projectId == 0) { header("Location:../expenses.php?projectId=$projectId"); } 
        else {header("Location:../expenseDetail.php?projectId=$projectId");}
    }
      if(isset($_REQUEST['deleteId']))
    {
        $id = $_REQUEST['deleteId'];
        $projectId = $_REQUEST['projectId'];
        $query = "UPDATE tbl_expense SET status = 'Inactive' WHERE id = $id";
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Expense details has been deleted successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in deleting Expense details!";
        }
        if($projectId == 0) { header("Location:../expenses.php?projectId=$projectId"); } 
        else {header("Location:../expenseDetail.php?projectId=$projectId");}
        
    }
    
    
    ?>