<?php
    // Connect SQL
    include('../SQL/connectRead.php');
    session_start();

    // SESSION Email and Password
    if(isset($_SESSION['SESS_EMAIL']) && (isset($_SESSION['SESS_PASSWORD'])))
    {
        $email = $_SESSION['SESS_EMAIL'];
        $password = $_SESSION['SESS_PASSWORD'];
    
        $email    = strip_tags(mysqli_real_escape_string($connect,trim($email)));
        $password = strip_tags(mysqli_real_escape_string($connect,trim($password)));
    
        //Create query
        $qry="SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result=mysqli_query($connect, $qry);

        $qry="SELECT * FROM seller WHERE email='$email' AND password='$password'";
        $resultSeller=mysqli_query($connect, $qry);
    
        //Check whether the query was successful or not
        if($result != null && $resultSeller != null) {
            if(mysqli_num_rows($result) > 0) {
                //Login Successful
                $member = mysqli_fetch_assoc($result);
                $_SESSION['SESS_ID'] = $member['id'];
                $_SESSION['SESS_COMPANY'] = null;
                $_SESSION['SESS_FIRSTNAME'] = $member['firstname'];
                $_SESSION['SESS_LASTNAME'] = $member['lastname'];
                $_SESSION['SESS_EMAIL'] = $member['email'];
                $_SESSION['SESS_PASSWORD'] = $member['password'];
                $_SESSION['SESS_STATUS'] = $member['status'];
                $_SESSION['loggedin'] = 0;
                session_write_close();
            }
            else if(mysqli_num_rows($resultSeller) > 0) {
                //Login Successful
                $member = mysqli_fetch_assoc($resultSeller);
                $_SESSION['SESS_ID'] = $member['seller_id'];
                $_SESSION['SESS_COMPANY'] = $member['company'];
                $_SESSION['SESS_FIRSTNAME'] = $member['firstname'];
                $_SESSION['SESS_LASTNAME'] = $member['lastname'];
                $_SESSION['SESS_EMAIL'] = $member['email'];
                $_SESSION['SESS_PASSWORD'] = $member['password'];
                $_SESSION['SESS_STATUS'] = $member['status'];
                $_SESSION['loggedin'] = 0;
                session_write_close();
                }
            else {
                $_SESSION['loggedin'] = 1;
                die("Query failed");
            }
        }
        else {
            $_SESSION['loggedin'] = 2;
            die("Query failed");
        }
    }
    else
    {
        $_SESSION['loggedin'] = 3;
        // header("location: ../Account/login.php");
    }

?>