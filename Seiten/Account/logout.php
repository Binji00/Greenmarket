<?php
    session_start();
    session_destroy();
    session_write_close();
    header("location: login.php");
?>