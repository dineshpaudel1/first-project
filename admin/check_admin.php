<?php 
session_start();
if (!isset($_SESSION['adminname'])) {
	header('location:adm_login.php');
}
 ?>