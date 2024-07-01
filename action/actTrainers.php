<?php
    
    include("../db/dbConnection.php");
    session_start();
    if(isset($_REQUEST['hdnAction']) && $_REQUEST['hdnAction'] == 'addTrainer')
    {
        //print_r($_REQUEST); 
        $name           = $_REQUEST['name'];
        $mobile         = $_REQUEST['mobile'];    
        $email          = $_REQUEST['email'];
        $address        = $_REQUEST['address'];
        $bg             = $_REQUEST['bg'];
        $size           = $_REQUEST['size'];
        $aadhar         = $_REQUEST['aadhar'];
        $pan            = $_REQUEST['pan'];
        $category       = $_REQUEST['category'];
        $star           = $_REQUEST['star']; 
        $bank           = $_REQUEST['bank']; 
        $guardian        = $_REQUEST['guardian']; 
        $contact        = $_REQUEST['contact']; 

        $query = "INSERT INTO tbl_trainer(name,mobile,email,address,bg,size,aadhar,pan,category,star,bank,guardian,contact) VALUES('$name','$mobile','$email','$address','$bg','$size','$aadhar','$pan','$category','$star','$bank','$guardian','$contact')"; 
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Trainer details added successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in adding Trainer details!";
        }
        header("Location:../trainers.php");
    }
    if(isset($_REQUEST['hdnAction']) && $_REQUEST['hdnAction'] == 'editTrainer')
    {
       // print_r($_REQUEST);  //exit;
        $trainerId           = $_REQUEST['hdnTrainerId'];
        $name           = $_REQUEST['name'];
        $mobile         = $_REQUEST['mobile'];    
        $email          = $_REQUEST['email'];
        $address        = $_REQUEST['address'];
        $bg             = $_REQUEST['bg'];
        $size           = $_REQUEST['size'];
        $aadhar         = $_REQUEST['aadhar'];
        $pan            = $_REQUEST['pan'];
        $category       = $_REQUEST['category'];
        $star           = $_REQUEST['star']; 
        $bank           = $_REQUEST['bank']; 
        echo $guardian        = $_REQUEST['guardian'];  
        $contact        = $_REQUEST['contact']; 

           $query = "UPDATE tbl_trainer SET name = '$name' , mobile = '$mobile', email = '$email' , address = '$address' , bg = '$bg' , size = '$size' , aadhar = '$aadhar' , pan = '$pan' , category = '$category' , star = '$star' , bank = '$bank' , guardian = '$guardian', contact = '$contact' WHERE id = '$trainerId'";   
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Trainer details updated successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in updating Trainer details!";
        }
        header("Location:../trainers.php");
    }
    
    if(isset($_REQUEST['deleteId']))
    {
        $id = $_REQUEST['deleteId'];
        $query = "UPDATE tbl_trainer SET status = 'Inactive' WHERE id = $id";
        $res = mysqli_query($conn , $query); 
        if($res)
        {
            $_SESSION['message'] = "Trainer details has been deleted successfully!";
        }
        else
        {
            $_SESSION['message'] = "Unexpected error in deleting trainer details!";
        }
        header("Location:../trainers.php");
    }
    
    
?>