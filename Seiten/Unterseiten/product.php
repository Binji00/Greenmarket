<?php
include '../SQL/checkLogin.php';
$loggedIn = $_SESSION['loggedin'];

$page = '404.php';
$productID;
$orderQTY = 1;

if(isset($_GET['prodID']) && !empty($_GET['prodID']))
{
    $productID = $_GET['prodID'];
    
    //SQL
    include '../SQL/connectRead.php';

    //SQL product
    $query = "SELECT * FROM product WHERE product_id = $productID";
    $result = $connect->query($query);
    $product = mysqli_fetch_assoc($result);

    if(isset($product['product_name']))
    {
        $page = 'product.php';
        $product_name = $product['product_name'];
        //echo "ID: $productID Name: $product_name";
    }
    else
    {
        $page = '404.php';
        header("location: ../ERROR/404.php");
    }
    //SQL seller
    $sellerID = $product['product_sellerID'];
    $query = "SELECT * FROM seller WHERE seller_id = $sellerID";
    $result = $connect->query($query);
    $seller = mysqli_fetch_assoc($result);
    
}

require_once($page);
if($page == '404.php')
{
    header("location: ../ERROR/404.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_name']?></title>
    <link href="../../style.css" type="text/css" rel="stylesheet">
</head>
<body>
<!-- Header -->
<?php include '../blocks/header.php'?>

<section>
    <?php 
        $price = number_format(
        $product['product_price'], // zu konvertierende zahl
        2,     // Anzahl an Nochkommastellen
        ",",   // Dezimaltrennzeichen
        "."    // 1000er-Trennzeichen 
        );
    ?>
    <a stylesheet="../../style.css">
        <div class="bigBlock">
            <div class="one_product_checkout">
                <i id="preis'.$productID.'" class="one_productPrice" style="margin-left: 3%;"><?php echo $price?>€</i><br>
                <div class="basketButtonBlock">
                    <a id="addBasketButton" class="basketButton" href="../SQL/addToBasket.php?prodID=<?php echo $productID?>&qty=<?php echo $orderQTY?>">Zu Warenkorb hinzufügen</a>
                </div>
            </div>
            <div class="one_product">
                <div class="one_blockImg">
                    <img class="one_productImg"  src="ProductPictures/<?php echo $productID?>-0.png">
                </div>
                <div class="one_product_textBlock">
                    <a id="titel'.$productID.'" class="one_productName"><?php echo $product['product_name']?></a><br>
                    <b class="one_productInfo" style="padding-left: none;">Händler:</b>
                    <a id="seller'.$sellerID.'" class="one_productInfo" href="seller.php?id=<?php echo $seller['seller_id']?>"><?php echo $seller['company']?></a><br>
                    <b class="one_productInfo" style="padding-left: none;">Preis:</b>
                    <a id="preis'.$productID.'" class="one_productPrice"><?php echo $price?>€</a><br><br>
                    <b class="one_productInfo" style="padding-bottom: 3px;">Artikelinformationen:</b>
                    <a id="info'.$productID.'" class="one_productInfo"><?php echo $product['product_info']?></a>
                </div>
            </div>
            
        </div>
    </a>
</section>
<!-- Footer -->
<?php include '../blocks/footer.php'?>

</body>
</html>

<?php


?>