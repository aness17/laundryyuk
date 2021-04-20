<?php

if (!isset($_SESSION)) {

    session_start();
    
    }
$email_cs =$_POST['email'];
$passwd_cs = $_POST['password'];

$user= $this->db->get_where('user', ['email' => $email_cs])->row_array();
if (isset($_POST['submit'])) {
    if ($passwd_cs==$user['password']){
        //Membuat Session
        $_SESSION["email"] = $emai_csl; 
        echo "Anda Berhasil Login $email_cs";
        
    } else {
        // Tampilkan Pesan Error
        echo '<p>Username Atau Password Tidak Benar</p>';
        header("location:".base_url("index.php/auth/login"));

       
    }
}

elseif(isset($_POST['google_login'])){

}
else { 
    header("location:".base_url("index.php/auth/login"));
}

?>