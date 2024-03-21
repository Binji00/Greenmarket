<?php

$page = '404.php';
$sellerID;

if(isset($_GET['id']) && !empty($_GET['id']))
{
    $sellerID = $_GET['id'];
    //SQL
    include '../SQL/connectRead.php';

    //SQL seller
    $query = "SELECT * FROM seller WHERE seller_id = $sellerID";
    $result = $connect->query($query);
    $seller = mysqli_fetch_assoc($result);

    if(isset($seller['seller_id']))
    {
        $page = 'product.php';
        $company = $seller["company"];
        $companyID = $seller["seller_id"];
    }
    else
    {
        $page = '404.php';
        header("location: ../ERROR/404.php");
    }

}

if($page == '404.php')
{
    header("location: ../ERROR/404.php?id='.$sellerID.'");
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

<!-- Header -->
<?php include '../blocks/header.php'?>
<section>
    <h1>
        Seller: 
        <?php echo $company?></br>
        ID: 
        <?php echo $companyID?>
    </h1>
</section>
<!-- Footer -->
<?php include '../blocks/footer.php'?>

</body>
</html>