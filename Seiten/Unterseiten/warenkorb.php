<?php
include '../SQL/checkLogin.php';
$userID = $_SESSION['SESS_ID'];
$qty;

if(!isset($_SESSION['SESS_ID']))
{
    header("location: ../Account/login.php");
}

$queryCount="SELECT COUNT(*) from basket WHERE b_user_id = $userID";
$conn = mysqli_query($connect, $queryCount);
$CountProductInBasket = $conn->fetch_column();

$queryGetID = "SELECT * FROM product, basket WHERE b_product_id = product_id AND b_user_id = $userID ORDER BY product_name";
$result = $connect->query($queryGetID);
for($i = 1; $i <= $CountProductInBasket; $i++)
{
    $product[$i] = $result->fetch_array(MYSQLI_NUM);
}
$totalShippingCosts = 0;

//Calculate total price
$total = 0;
for($i = 1; $i <= $CountProductInBasket; $i++)
{
    $total = $total + ($product[$i][2] * $product[$i][13]);
}
$total = $total + $totalShippingCosts;
$total = number_format(
    $total, // zu konvertierende zahl
    2,     // Anzahl an Nochkommastellen
    ",",   // Dezimaltrennzeichen
    "."    // 1000er-Trennzeichen 
    );

$queryGetAnzSeller = "SELECT COUNT(DISTINCT product_sellerID) FROM product, basket WHERE b_product_id = product_id AND b_user_id = $userID";
$result = mysqli_query($connect, $queryGetAnzSeller);
$totalSeller = $result->fetch_column();

$queryGetSeller = "SELECT DISTINCT seller_id, company FROM product, basket, seller WHERE b_product_id = product_id AND b_user_id = $userID AND product_sellerID = seller_id";
$result = $connect->query($queryGetSeller);
for($i = 0; $i < $totalSeller; $i++)
{
    $allSeller[$i] = $result->fetch_array(MYSQLI_NUM);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warenkorb</title>
    <link href="../../style.css" type="text/css" rel="stylesheet">
    
</head>
<body>

<!-- Header -->
<?php include '../blocks/header.php'?>

<section>
    <a stylesheet="../../style.css">
    <div class="bigBlock">
        <h1>Warenkorb von <?php echo $_SESSION['SESS_FIRSTNAME']; ?></h1>
        <div class="one_product_checkout">
            <i id="preis'.$productID.'" class="basket_summe">Teilsumme: </i>
            <i id="preis'.$productID.'" class="basket_summe" style="text-align: right;"><?php echo $total ?>€</i><br>
            <i id="preis'.$productID.'" class="basket_summe">Anzahl der Händler: </i>
            <i id="preis'.$productID.'" class="basket_summe" style="text-align: right;"><?php echo $totalSeller ?></i><br>
            <i id="preis'.$productID.'" class="basket_summe">Versandkosten: </i>
            <i id="preis'.$productID.'" class="basket_summe" style="text-align: right;"><?php echo $totalShippingCosts ?>€</i><br>


            <i id="preis'.$productID.'" class="basket_summe">Gesamtsumme: </i>
            <i id="preis'.$productID.'" class="basket_summe" style="text-align: right;"><?php echo $total ?>€</i><br>
            
            
            <div class="basketButtonBlock">
                <a id="addBasketButton" class="basketButton">Zur Kasse</a>
            </div>
        </div>
        <div class="basketProductBlock">
            <?php 
                for($i = 0; $i < $totalSeller; $i++)
                {
                    echo '<hr class="basketProduct2Line">';
                    echo '<div style="float: left;">'.$allSeller[$i][1].'</div>';
                    

                    $T_sellerID = $allSeller[$i][0];
                    $queryCount="SELECT COUNT(product_id) FROM product, basket WHERE b_product_id = product_id AND b_user_id = $userID AND product_sellerID = $T_sellerID";
                    $conn = mysqli_query($connect, $queryCount);
                    $T_total_product_from_seller = $conn->fetch_column();

                    $queryProductBySeller = "SELECT * FROM product, basket WHERE b_product_id = product_id AND b_user_id = $userID AND product_sellerID = $T_sellerID ORDER BY product_name";
                    $result = $connect->query($queryProductBySeller);
                    for($j = 1; $j <= $T_total_product_from_seller; $j++)
                    {
                        $T_productBS[$j] = $result->fetch_array(MYSQLI_NUM);
                    }
                    for ($h = 1; $h <= $T_total_product_from_seller; $h++)        
                    {
                        $T_preis = number_format(
                        $T_productBS[$h][2], // zu konvertierende zahl
                        2,     // Anzahl an Nochkommastellen
                        ",",   // Dezimaltrennzeichen
                        "."    // 1000er-Trennzeichen 
                        );
                        $block = 
                        '<a stylesheet="../../style.css" href="product.php?prodID='.$T_productBS[$h][0].'">
                                    <div class="basketProduct">
                                        <div>
                                            <img class="basketImgBlock" src="ProductPictures/'.$T_productBS[$h][0].'-0.png">
                                        </div>
                                        <div style="padding: 10px;">
                                            <a id="titel'.$h.'" class="productName" href="product.php?prodID='.$T_productBS[$h][0].'">'.$T_productBS[$h][1].'</a></br>
                                        </div>
                                        <a id="preis'.$h.'" class="productPrice">'.$T_preis.'€</a><br>
                                        <form action="../SQL/updateQty.php?user='.$T_productBS[$h][11].'&prod='.$T_productBS[$h][12].'" method="post">
                                            <input class="PLZinput" style="width: 5%;" name="Qty" value="'.$T_productBS[$h][13].'">
                                            <button type="submit" name="submit" class="SEARCHbutton" style="visibility: visible; " id="submitLupe">
                                                    <img src="../../Bilder/Icons/save.png" class="SEARCHbuttonIMG" id="PLZcheckIMG"/>
                                            </button>
                                        </form>
                                        <a href="../SQL/delBasketItem.php?prodID='.$T_productBS[$h][0].'" class="fussButton">L&ouml;schen</a>
                                    </div>
                                </a>';
                        echo $block;

                        if($h < $T_total_product_from_seller)
                        {
                            echo '<hr class="basketProduct1Line">';
                        }
                    }

                }

            ?>
        </div>
        
        
    </div>
</a>
</section>













<!-- Footer -->
<?php include '../blocks/footer.php'?>

</body>
</html>