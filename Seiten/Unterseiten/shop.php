<?php
    include '../SQL/connectRead.php';

    $qry="SELECT COUNT(*) from kategorien";
    $conn = mysqli_query($connect, $qry);
    $AnzKategorien = $conn->fetch_column();

    
    // $result = mysqli_query("SELECT id, name FROM kategorien");
    $query = "SELECT id, name FROM kategorien ORDER BY name";
    $result = $connect->query($query);

    for($i = 1; $i <= $AnzKategorien; $i++)
    {
        $rowCat[$i] = $result->fetch_array(MYSQLI_NUM);
    }

    // for($j = 1; $j <= $AnzKategorien; $j++)
    // {
    //     $qry="SELECT name from kategorien ORDER BY name";
    //     $result=mysqli_query($connect, $qry);
    //     $kategorie = mysqli_fetch_array($result);
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="../../style.css" type="text/css" rel="stylesheet">
    
</head>
<body>

<!-- Header -->
<?php include '../blocks/header.php'?>

<section>
    <h1>Shop</h1>

    <?php 

        for ($i = 1; $i <= $AnzKategorien; $i++)        
        {
                $block = '
                    <a stylesheet="../../style.css">
                        <div class="blockCategory">
                            <a id="k'.$i.'" href="productList.php?cat='.$rowCat[$i][0].'" class="categoryName">'.$rowCat[$i][1].'</a>
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