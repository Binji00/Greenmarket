<?php
    include 'checkLogin.php';

    if($_SESSION['loggedin'] == 0 && $_SESSION['SESS_STATUS'] != null)
    {
        if(in_array($_SESSION['SESS_STATUS'], array(42, 2)))
        {
            $_SESSION['canAddProduct'] = 0;
        }
        else
        {
            $_SESSION['canAddProduct'] = 1;
        }
    }
    else
    {
        header("location: ../Account/profile.php?error-in-getStatus-else-condition");
    }









?>