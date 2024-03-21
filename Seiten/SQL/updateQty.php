<?php
    // $newQty = $_POST["Qty"];
    // $userID = $_GET['user'];
    // $prodID = $_GET['prod'];

    // echo 'User: ';
    // echo $userID;
    // echo '<hr style="width=100%">';
    // echo 'Product: ';
    // echo $prodID;
    // echo '<hr style="width=100%">';
    // echo 'NewQty: ';
    // echo $newQty;

    
    // if(!$newQty == 0)
    // {
    //     include 'connectWrite.php';
    //     if ($connectWrite->connect_error) {
    //         die("Connection failed: " . $connectWrite->connect_error);
    //     }

    //     $sqlUpdate = ("UPDATE basket SET b_quantity = newQty WHERE b_user_id = $userID and b_product_id = $prodID");
    //     if ($connectWrite->query($sqlUpdate) === TRUE) 
    //     {
    //         echo "Update successfully";
    //     } 
    //     else 
    //     {
    //         echo "Error: " . $sql . "<br>" . $connectWrite->error;
    //     }
    //     $connectWrite->close();
    // }
    // else
    // {
    //     include 'connectDel.php';
    //     if ($connectDel->connect_error) {
    //         die("Connection failed: " . $connectDel->connect_error);
    //     }






    //     $connectDel->close();
    // }


?>

<?php
include 'checkLogin.php';
$loggedIn = $_SESSION['loggedin'];
$userID = $_SESSION['SESS_ID'];
$page = '404.php';

if (isset($_GET['prod']) && !empty($_GET['prod']) && $loggedIn == 0)
{
    $newQty = $_POST["Qty"];
    $prodID = $_GET['prod'];

    echo 'User: ';
    echo $userID;
    echo '<hr style="width=100%">';
    echo 'Product: ';
    echo $prodID;
    echo '<hr style="width=100%">';
    echo 'NewQty: ';
    echo $newQty;

    $page = 'warenkorb.php';

    //Start SQL
    if(!$newQty == 0)
    {
        include 'connectWrite.php';

        $sqlUpdate = ("UPDATE basket SET b_quantity = $newQty WHERE b_user_id = $userID and b_product_id = $prodID");
        if ($connectWrite->query($sqlUpdate) === TRUE) 
        {
            echo "Update successfully";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $connectWrite->error;
        }
        $connectWrite->close();
    }
    else
    {
        include 'connectDel.php';

        $sqlDelete = ("DELETE FROM basket WHERE b_user_id = $userID AND b_product_id = $prodID");
        $connectDel->query($sqlDelete);

        $connectDel->close();
    }
    
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