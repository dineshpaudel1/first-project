<?php 
$id = $_GET['id'];
try{
  $conn = new mysqli('localhost','root','','gym');
  $sql = "delete from trainer where id=$id";
  $conn->query($sql);
  if ($conn->affected_rows == 1 ) {
    echo "User delete success";
  }
  header('location:trainer.php?action=1');
}
catch(Exception $e){
   die('Database  Error : ' .$e->getMessage());
}
 ?>