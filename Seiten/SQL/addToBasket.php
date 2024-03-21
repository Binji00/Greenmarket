<?php
include '../SQL/checkLogin.php';
$loggedIn = $_SESSION['loggedin'];
$userID = $_SESSION['SESS_ID'];
$page = '404.php';

if (isset($_GET['prodID']) && !empty($_GET['prodID']) && isset($_GET['qty']) && !empty($_GET['qty']) && $loggedIn == 0)
{
    $prodID = $_GET['prodID'];
    $qty = $_GET['qty'];
    $page = 'product.php';
    
    //Start SQL
    include '../SQL/connectWrite.php';
    if ($connectWrite->connect_error) {
        die("Connection failed: " . $connectWrite->connect_error);
    }

    $resultOld = $connectWrite->query("SELECT * FROM basket WHERE b_user_id = $userID AND b_product_id = $prodID");
    if(mysqli_num_rows($resultOld) == 0)
    {
        $sql = "INSERT INTO basket (b_user_id, b_product_id, b_quantity)
        VALUES ($userID, $prodID, $qty)";

        if ($connectWrite->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connectWrite->error;
        }
    }
    else
    {
        $resOld = mysqli_fetch_assoc($resultOld);
        $newQty = $resOld['b_quantity'] + $qty;
        $sqlUpdate = ("UPDATE basket SET b_quantity = $newQty WHERE b_user_id = $userID AND b_product_id = $prodID");
        if ($connectWrite->query($sqlUpdate) === TRUE) {
            echo "Update successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connectWrite->error;
        }

    }
    //SQL Insert product to basket
    $connectWrite->close();
}

else if ($loggedIn != 0)
{
    $page = 'login.php';
}
if($page == '404.php')
{
    header("location: ../ERROR/404.php");
}
else if($page == 'login.php')
{
    header("location: ../Account/login.php");
}
else if($page == 'product.php')
{
    header("location: ../Unterseiten/product.php?prodID=$prodID");
}
else
{
    header("location: ../ERROR/404.php");
}
?>