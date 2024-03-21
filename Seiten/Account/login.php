<?php
    $msg =null;
    include '../SQL/connectRead.php';
    $salt = "35$070822.Liefert";
    
    if(isset($_SESSION['SESS_MEMBER_ID']))
    {
        header("location: profile.php");
    }

    if(isset($_POST['email']) && (!empty($_POST['email'])) && isset($_POST['password']) && (!empty($_POST['password'])))
    {
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']. $salt);

        $email    = strip_tags(mysqli_real_escape_string($connect,trim($email)));
        $password = strip_tags(mysqli_real_escape_string($connect,trim($password)));
    
        //Create query
        $qry="SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result=mysqli_query($connect, $qry);

        $qry="SELECT * FROM seller WHERE email='$email' AND password='$password'";
        $resultSeller=mysqli_query($connect, $qry);
    
        //Check whether the query was successful or not
        if($result  && $resultSeller) {
            if(mysqli_num_rows($result) > 0) {
                //Login Successful
                session_start();
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
                header("location: profile.php");
                exit();
            }
            else if(mysqli_num_rows($resultSeller) > 0) {
                //Login Successful
                session_start();
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
                header("location: profile.php");
                exit();
                }
            else {
                //Login failed
                //error message 
            }
        }
        else {
            //Login failed
            //error message
        }
}
        
        
    
    
    // if(isset($_POST['email']) && (!empty($_POST['email'])))
    // {
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];

    //     $email    = strip_tags(mysqli_real_escape_string($connect,trim($email)));
    //     $password = strip_tags(mysqli_real_escape_string($connect,trim($password)));

    //     $query   = "SELECT * FROM user WHERE email='".$email."'";
    //     $tbl      = mysqli_query($connect, $query);
    //     if(mysqli_num_rows($tbl)>0)
    //     {   
    //         $row = mysqli_fetch_array($tbl);
    //         $password_hash = $row['password'];
    //         if(password_verify($password, $password_hash))
    //         {
    //             $msg = 'Passwort Korrekt - Sie wurden eingeloggt.';
    //         }
    //         else
    //         {
    //             $msg = 'Passwort nicht Korrekt - bitte versuchen Sie es erneut.';
    //         }
    //     }
    //     else
    //     {
    //         $msg = 'Email nicht Korrekt - bitte versuchen Sie es erneut.';
    //     }
    // }
    // else
    // {

    // }
   
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../../style.css" type="text/css" rel="stylesheet">
    
</head>
<body>
    
<!-- Header -->
<?php include '../blocks/header.php'?>
<section>
    <div class="block-one-third-middle">
        <div class="titel1">Login</div>
        <?php
        if(isset($msg))
        {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    ?>

        <form method="POST" enctype="multipart/form-data" action="login.php">
            <input class="loginInput" type="email" name="email" placeholder="E-Mail Adresse">
            <input class="loginInput" type="password" name="password" placeholder="Passwort">
            <button type="submit" name="submit" id="submitLogin" class="submitLogin">Anmelden</button>
            <button type="submit" class="submitRegister" formaction="register.php">Registrieren</button>
        </form>
        
    </div>
</section>
<!-- Footer -->
<?php include '../blocks/footer.php'?>

</body>
</html>