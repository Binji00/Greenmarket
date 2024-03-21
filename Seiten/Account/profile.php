<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="../../style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php include '../blocks/header.php'?>
<?php 
    include '../SQL/checkLogin.php';
    if($_SESSION['loggedin'] != 0)
    {
        header("location: login.php?reason=".$_SESSION['loggedin']."");
    }

    ?>
<section>
    <div class="bigBlock">
        <h1>Profil von <?php echo $_SESSION['SESS_FIRSTNAME']; echo " "; echo $_SESSION['SESS_LASTNAME']; ?></h1>
        <h1>Status <?php echo $_SESSION['SESS_STATUS']; echo " "; echo $_SESSION['SESS_LASTNAME']; ?></h1>

        <a class="fussButton" href="logout.php" style="float: left;">Logout</a>
        <a class="fussButton" style="visibility: true; float: left;" href="../Unterseiten/newProduct.php">Produkt Hinzufügen</a>




    </div>
</section>
<?php include '../blocks/footer.php'?>
</body>
</html>