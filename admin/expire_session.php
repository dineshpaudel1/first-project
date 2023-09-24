<?php
if (!isset($_SESSION['start_time']) || (time() - $_SESSION['start_time']) > 1*60*60) {
    session_destroy();
    header("Location: adm_login.php");
    exit();
}
?>