<?php 
    include("db/sqlconnection.php");

    

        $productname =$_POST['productnamee'];
        $quantity =$_POST['quantity'];
        $inquantity =$_POST['inquantity'];
        $outquantity =$_POST['outquantity'];
       
        
        
    
     $res = mysqli_queryINSERT INTO `tbl_product` (`product_name`, `product_quantity`, `in_quantity`, `out_quantity`, `modified_by`, `modified_date`, `status`) VALUES ($productname, $quantity,$inquantity, $outquantity, '545', '2024-02-22 12:59:28.000000', 'Active');
      
     
?>
<script>
     window.location.href = "clients.php";
</script>