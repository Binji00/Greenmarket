<?php
$page = '404.php';
$categoryID;

if(isset($_GET['cat']))
{
    $categoryID = $_GET['cat'];
    
    //SQL category
    include '../SQL/connectRead.php';
    $query = "SELECT DISTINCT name FROM kategorien WHERE id = $categoryID";
    $result = $connect->query($query);
    $cat = mysqli_fetch_assoc($result);
    if(isset($cat['name']))
    {
        $page = 'productList.php';
        $category = $cat['name'];
        //echo "ID: $categoryID Name: $category";
    }
    else
    {
        $page = '404.php';
        header("location: ../ERROR/404.php");
    }
}
else
{
    $page = '404.php';
    header("location: ../ERROR/404.php");
}

$qry="SELECT COUNT(*) from product WHERE product_categoryID = $categoryID";
$conn = mysqli_query($connect, $qry);
$AnzProduct = $conn->fetch_column();

$query = "SELECT * FROM product WHERE product_categoryID = $categoryID ORDER BY product_name";
$result = $connect->query($query);

for($i = 1; $i <= $AnzProduct; $i++)
{
    $product[$i] = $result->fetch_array(MYSQLI_NUM);
}

require_once($page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorie: <?php echo "$category" ?></title>
    <link href="../../style.css" type="text/css" rel="stylesheet">
    
</head>
<body>

<!-- Header -->
<?php include '../blocks/header.php'?>
<section>
    <h1>Produktliste: <?php echo "$category ($categoryID)" ?></h1>
    <?php 

        for ($i = 1; $i <= $AnzProduct; $i++)        
        {
                $preis = number_format(
                $product[$i][2], // zu konvertierende zahl
                2,     // Anzahl an Nochkommastellen
                ",",   // Dezimaltrennzeichen
                "."    // 1000er-Trennzeichen 
                );

                $block = 
                '<a stylesheet="../../style.css" href="product.php?prodID='.$product[$i][0].'">
                            <div class="product">
                                <div class="blockImg">
                                    <img class="productImg" src="ProductPictures/'.$product[$i][0].'-0.png">
                                </div>
                                <div style="padding: 10px;">
                                    <a id="titel'.$i.'" class="productName" href="product.php?prodID='.$product[$i][0].'">'.$product[$i][1].'</a></br>
                                </div>
                                <a id="preis'.$i.'" class="productPrice">'.$preis.'€</a>
                            </div>
                        </a>';
                echo $block;
        }
    ?>
</section>
<!-- Footer -->
<?php include '../blocks/footer.php'?>

</body>
</html>