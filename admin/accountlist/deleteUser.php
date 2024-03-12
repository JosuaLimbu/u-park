<?php
include 'connect.php';
if(isset($_POST['deleteid'])){
    $id = $_POST['deleteid'];

    $sql="delete from `tbl_account` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        echo "Deleted successfull";
    }else{
        die(mysqli_error($con));
        }
}
    
?>