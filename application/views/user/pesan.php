<?php
if (!isset($_SESSION)) {
session_start();

}
//cek session 
if($_SESSION["email"]==""){
    header("location:".base_url("index.php/auth/login"));
    
}

else{
    header("location:".base_url("index.php/auth/form_pesan"));
}



?>