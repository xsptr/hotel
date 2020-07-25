<?php
error_reporting(0);

include "../config/koneksi.php";
$pass=md5($_POST[pass]);

$query= "SELECT * FROM tbladmin WHERE username='$_POST[username]' AND password='$pass'and status ='Y'";

$login = mysqli_query($db_conn, $query);
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  
  // inisialisasi session /////////
  
  ("username");
  ("password");
  ("status");

  $_SESSION[username]     = $r[username];
  $_SESSION[password]     = $r[password];
  $_SESSION[status]       = $r[status];
  
  
  header('location:home.php');
}
else{
  echo "<SCRIPT language=Javascript>
  alert('Login Anda Gagal,  username dan password tidak valid.')
  </script>";
  echo "
  <meta http-equiv='refresh' content='0; url=../index.php'/>";
}
?>
