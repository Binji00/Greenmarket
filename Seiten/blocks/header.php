<?php
    // Connect SQL
    $relFromIndex = 0;
    include '../SQL/connectRead.php';
    include '../SQL/checkLogin.php';
    
    if($_SESSION['loggedin'] == 0)
    {
        $loginText = "Konto";
        $loginHref ="../Account/profile.php";
    }
    else 
    {
        $loginText = "Login";
        $loginHref ="../Account/login.php";
    }


    if(isset($_POST["submit"]))
        {
            require("../SQL/PLZcheck.php");
            $stmt = $mysql->prepare("SELECT PLZ FROM 35erplz WHERE PLZ = :plz"); //Username überprüfen
            $stmt->bindParam(":plz", $_POST["PLZinput"]);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count == 1){
                $row = $stmt->fetch();
                session_start();
                $_SESSION["PLZinput"] = $row["PLZ"];
                echo '"';
                echo $row["PLZ"];
                echo '" ist in der DB enthalten.';
                $resultPLZ = $_POST["PLZinput"];
                echo "<script type='text/javascript'>localStorage.setItem('lastPLZ', $resultPLZ);</script>";
                session_write_close();
                
            }
            elseif (empty($_POST["PLZinput"]))
            {
            }
            else
            {
                echo '"';
                echo $_POST["PLZinput"];
                echo '" ist nicht in der DB enthalten.';
                $message = "Diese Seite befindet sich zurzeit im Aufbau und wird aktuell nur in im Postleitzahlenbereich 35XXX angeboten. Bei Erfolg des Testprogramms werden weitere Regionen freigeschaltet. Wir bitten um Ihr Verständnis.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        else
        {
        }   

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../style.css" type="text/css" rel="stylesheet">

</head>
<body>
<!-- Start PHP -->
<?php
// Start PHP - PLZinput
         
// End PHP - PLZinput

?>
<!-- End PHP -->


<!-- Start HTML -->
<header class="header">
        <a href="../../index.php">
            <img id="Logo" class="logo" src="../../Logo.png"/>
        </a>
        <form method="POST">
        <input class="PLZinput" type="int" id="PLZinput" value="" name="PLZinput" action="../SQL/PLZcheck.php">

            <button type="submit" name="submit" class="SEARCHbutton" style="visibility: visible; " id="submitLupe">
                <img src="../../Bilder/header/magnifying-glass.png" class="SEARCHbuttonIMG" id="PLZcheckIMG"/>
            </button>

        </form>
        <form>
            <input class="Suchfeld" type="int" id="suchfeld" name="suchfeld" placeholder="Suche" action="">
            <button type="submit" name="submit" class="SEARCHbutton">
                <img src="../../Bilder/header/magnifying-glass.png" class="SEARCHbuttonIMG"/>
                
            </button>
        </form>

    <div style="padding-right: 25px;">
        <a href="<?php echo $loginHref ?>" id="loginButton" class="button"><?php echo $loginText ?></a>
        <a href="../Unterseiten/warenkorb.php" class="button">Warenkorb</a>
        <a href="../Unterseiten/shop.php" class="button">Shop</a>
    </div>
</header>

<!-- END HTML -->


<!-- Start JS -->
<script type='text/javascript'>
    // Start JS - PLZinput
    var lastPLZstorage = localStorage.getItem('lastPLZ');
    document.getElementById('PLZinput').value = lastPLZstorage;
    // End JS - PLZinput

    

</script>
<!-- End JS -->

</body>
</html>



