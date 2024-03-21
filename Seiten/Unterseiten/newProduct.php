<?php
    include '../SQL/getStatus.php';
    // $mainImgName = ''.$_SESSION['SESS_ID'].''."-".''.date().'';
    $mainImgName = ''.$_SESSION['SESS_ID'].''.date('_Y-m-d_H-i-s').'';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkt hinzufügen</title>
    <link href="../../style.css" type="text/css" rel="stylesheet">
    
</head>
<body>
    
<!-- Header -->
<?php include '../blocks/header.php'?>
<section>
    <div class="bigBlock">
        <div class="titel1" style="text-align: left; width: 100%;">Produkt hinzufügen</div>

        <form method="POST" enctype="multipart/form-data" action="../SQL/addProduct.php">
            <hr class="lineInvisible">
            <input class="addProdInput" type="text" required name="productname" placeholder="Produktname">
            <input class="addProdInput" type="text" required name="price" placeholder="Preis">
            <input class="addProdInput" type="text" required name="brand" placeholder="Marke">
            <input class="addProdInput" type="text" required name="manufacturer" placeholder="Hersteller">
            <hr class="lineInvisible">
            <input class="addProdInput" type="text" required name="category" placeholder="Hauptkategorie (Nummer)">
            <input class="addProdInput" type="text" required name="barcode" placeholder="Barcode">
            <input class="addProdInput" type="text" required name="processingTime" placeholder="Bearbeitungszeit">
            <hr class="lineInvisible">
            <input class="addProdInputSmall" type="text" required name="height" placeholder="Höhe">
            <input class="addProdInputSmall" type="text" required name="width" placeholder="Breite">
            <input class="addProdInputSmall" type="text" required name="depth" placeholder="Tiefe">
            <select class="addProdInputSmall" name="dimensionsUnit">
                <option>mm</option>
                <option selected>cm</option>
                <option>m</option></select>
            <hr class="lineInvisible">
            <input class="addProdInputSmall" type="text" required name="weight" placeholder="Gewicht">
            <select class="addProdInputSmall" name="weightUnit">
                <option>g</option>
                <option>kg</option>
                <option>t</option></select>
            <hr class="lineInvisible">
            <textarea class="addProdInput" type="text" required name="info" style="width: 100%; height: 150px" placeholder="Produktinformationen"></textarea>
            <hr class="lineInvisible">
            <input type="file" name="$mainImgName" accept=".png, .jpg, .jpeg" id="$mainImgName" action="../SQL/addProductImg.php" class="addProdInput">
            <hr class="lineInvisible">
            <button type="submit" name="submit" id="submitLogin" class="submitLogin" style="width: 23.5%; margin: 0px; height: 50px; margin-top: 10px; margin-left: 10px;">Hinzufügen</button>
            
        </form>
</section>  
</div>
<!-- Footer -->
<?php include '../blocks/footer.php'?>

</body>
</html>