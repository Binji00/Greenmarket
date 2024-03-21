<?php
    $msg =null;
    include '../SQL/connectWrite.php';
    $salt = "35$070822.Liefert";
    
    if(isset($_POST['firstname']) && (!empty($_POST['firstname'])) && isset($_POST['lastname']) && (!empty($_POST['lastname'])) && isset($_POST['email']) && (!empty($_POST['email'])) && isset($_POST['phonenumber']) && (!empty($_POST['phonenumber'])) && isset($_POST['password']) && (!empty($_POST['password'])))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumberNF = $_POST['phonenumber'];
        $password = hash('sha256', $_POST['password']. $salt);

        //Format Phonenumber
        if(!($phonenumberNF[0] == "0" && $phonenumberNF[1] == "0"))
        {
            if(($phonenumberNF[0] == "+") && ($phonenumberNF[1] != "4" || $phonenumberNF[2] != "9"))
            {

            }
            else
            {
                $search = array('|^0|','|/|', '| |', '|\.|');
                $repl = array("+49", '', '', '');
                $phonenumber = preg_replace($search, $repl, $phonenumberNF);
            }
        }

        $firstname  = strip_tags(mysqli_real_escape_string($connectWrite,trim($firstname)));
        $lastname   = strip_tags(mysqli_real_escape_string($connectWrite,trim($lastname)));
        $email      = strip_tags(mysqli_real_escape_string($connectWrite,trim($email)));
        $phonenumber= strip_tags(mysqli_real_escape_string($connectWrite,trim($phonenumber)));
        $password   = strip_tags(mysqli_real_escape_string($connectWrite,trim($password)));

        $query   = "SELECT * FROM user WHERE email='".$email."'";
        $tbl      = mysqli_query($connectWrite, $query);
        if(!mysqli_num_rows($tbl)>0)
        {
            if (!$connectWrite) {
                die("Connection failed: " . mysqli_connect_error());
              }
              
              $sql = "INSERT INTO user (firstname, lastname, email, phonenumber, password)
              VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$password')";
              
              if (mysqli_query($connectWrite, $sql)) {
                echo "New record created successfully";
                mysqli_close($connectWrite);
                header("location: login.php");
                exit();
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connectWrite);
              }
              mysqli_close($connectWrite);
        }
        else {
            echo "'$email' wird bereits verwendet.";
        }
        mysqli_close($connectWrite);
        




        // $email = $_POST['email'];
        // $password = $_POST['password'];

        // $email    = strip_tags(mysqli_real_escape_string($connectWrite,trim($email)));
        // $password = strip_tags(mysqli_real_escape_string($connectWrite,trim($password)));

        // $query   = "SELECT * FROM user WHERE email='".$email."'";
        // $tbl      = mysqli_query($connectWrite, $query);
        // if(mysqli_num_rows($tbl)>0)
        // {   
        //     $row = mysqli_fetch_array($tbl);
        //     $password_hash = $row['password'];
        //     if(password_verify($password, $password_hash))
        //     {
        //         $msg = 'Passwort Korrekt - Sie wurden eingeloggt.';
        //     }
        //     else {
        //         $msg = 'Passwort nicht Korrekt - bitte versuchen Sie es erneut.';
        //     }
        // }
        // else{ 
        //     $msg = 'Email nicht Korrekt - bitte versuchen Sie es erneut.'; 
        // }
    }
    else



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
    <link href="../../style.css" type="text/css" rel="stylesheet">
    
</head>
<body>
    
<!-- Header -->
<?php include '../blocks/header.php'?>
<section>
    <div class="block-one-third-middle">
        <div class="titel1">Registrieren</div>
        <?php
        if(isset($msg))
        {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    ?>

        <form method="POST" enctype="multipart/form-data" action="register.php">
            <input class="loginInput" type="text" require name="firstname" placeholder="Vorname">
            <input class="loginInput" type="text" require name="lastname" placeholder="Nachname">
            <input class="loginInput" type="email" require name="email" placeholder="E-Mail Adresse">
            <input class="loginInput" type="tel" require name="phonenumber" placeholder="Telefonnummer">
            <input class="loginInput" minlength="8" type="password" require name="password" placeholder="Passwort">
            <button type="submit" name="submit" id="submitLogin" class="submitLogin">Registrieren</button>
            <button type="submit" class="submitLogin" formaction="login.php">Anmelden</button>

        </form>
        
    </div>
</section>
<!-- Footer -->
<?php include '../blocks/footer.php'?>

</body>
</html>