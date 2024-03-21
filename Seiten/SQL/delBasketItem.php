<?php
include 'checkLogin.php';
$loggedIn = $_SESSION['loggedin'];
$userID = $_SESSION['SESS_ID'];
$page = '404.php';

if (isset($_GET['prodID']) && !empty($_GET['prodID']) && $loggedIn == 0)
{
    $prodID = $_GET['prodID'];
    $page = 'warenkorb.php';

    //Start SQL
    include 'connectDel.php';
    if ($connectDel->connect_error) {
        die("Connection failed: " . $connectDel->connect_error);
    }
    	
    $resultOld = $connect->query("SELECT * FROM basket WHERE b_user_id = $userID AND b_product_id = $prodID");

    if(isset($_GET['qty']))
    {   
        // Delete Anz
        $delQty = $_GET['qty'];
    }
    else
    {
        $sqlDelete = ("DELETE FROM basket WHERE b_user_id = $userID AND b_product_id = $prodID");
        $connectDel->query($sqlDelete);
    }






    // if(mysqli_num_rows($resultOld) == 0)
    // {
    //     $sql = "INSERT INTO basket (b_user_id, b_product_id, b_quantity)
    //     VALUES ($userID, $prodID, $qty)";

    //     if ($connect->query($sql) === TRUE) {
    //         echo "New record created successfully";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $connect->error;
    //     }
    // }
    // else
    // {
    //     $resOld = mysqli_fetch_assoc($resultOld);
    //     $newQty = $resOld['b_quantity'] + $qty;
    //     $sqlUpdate = ("UPDATE basket SET b_quantity = $newQty WHERE b_user_id = $userID AND b_product_id = $prodID");
    //     if ($connect->query($sqlUpdate) === TRUE) {
    //         echo "Update successfully";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $connect->error;
    //     }

    // }

    //SQL Insert product to basket
    $connectDel->close();
}

else if ($loggedIn != 0)
{
    $page = 'login.php';
}





if($page == '404.php')
{
    header("location: ../ERROR/404.php");
}
else if($page == '$delQty.php')
{
    header("location: ../Unterseiten/$delQty.php");
}
else if($page == 'login.php')
{
    header("location: ../Account/login.php");
}
else if($page == 'warenkorb.php')
{
    header("location: ../Unterseiten/warenkorb.php");
}
else
{
    header("location: ../ERROR/404.php");
}
?>