<?php 
    session_start();
    session_destroy();
    header("location:".base_url("index.php/auth/login"));
?>