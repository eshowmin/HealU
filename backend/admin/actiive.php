<?php 

session_start();
include('assets/inc/config.php');
include('assets/inc/checklogin.php');
check_login();
$aid=$_SESSION['ad_id'];

  $id = $_GET['pat_id'];
  $status = $_GET['statuss'];
  $query = "UPDATE his_patients SET statuss=$status WHERE pat_id=$id";
  $stmt = $mysqli->prepare($query);
  $rc=$stmt->bind_param('si', $status, $id);
  $stmt->execute();
  header('location:his_admin_manage_doctor_charge.php');
?>