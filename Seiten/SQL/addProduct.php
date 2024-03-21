<?php
    include '../SQL/getStatus.php';

    if($_SESSION['canAddProduct'] != 0)
    {
        header("location: ../Account/profile.php");
        exit();
    }

    $productname = $_POST['productname'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $manufacturer = $_POST['manufacturer'];
    $category = $_POST['category'];
    $barcode = $_POST['barcode'];
    $processingTime = $_POST['processingTime'];
    $height = $_POST['height'];
    $width = $_POST['width'];
    $depth = $_POST['depth'];
    $dimensionsUnit = $_POST['dimensionsUnit'];
    $weight = $_POST['weight'];
    $weightUnit = $_POST['weightUnit'];
    $info = $_POST['info'];
    $mainImg = $_FILES['file']['$mainImgName'];
    
    $sellerID = $_SESSION['SESS_ID'];


    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }





    echo 
    '   <a>Produktname: '.$productname.'</a><br>
        <a>Preis: '.$price.'</a><br>
        <a>Marke: '.$brand.'</a><br>
        <a>Hersteller: '.$manufacturer.'</a><br>
        <a>Kategorie: '.$category.'</a><br>
        <a>Barcode: '.$barcode.'</a><br>
        <a>Bearbeitungszeit: '.$processingTime.' Tage</a><br>
        <a>Höhe: '.$height.''.$dimensionsUnit.'</a><br>
        <a>Weite: '.$width.''.$dimensionsUnit.'</a><br>
        <a>Tiefe: '.$depth.''.$dimensionsUnit.'<a><br>
        <a>Gewicht: '.$weight.''.$weightUnit.'</a><br>
        <a>Produktinformationen: '.$info.'</a><br>
        <a>Main Img Name: '.$mainImgName.'</a><br>
    ';
    $_POST = null;

    //Write Start
    include '../SQL/connectWrite.php';

    $query   = "SELECT * FROM product WHERE product_sellerID = $sellerID AND product_name = $productname AND product_price = $price AND product_brandID = $brand AND product_manufacturerID = $manufacturer AND product_categoryID = $category AND product_barcode = $barcode";
    $tbl = mysqli_query($connectWrite, $query);
    echo "********";
    echo mysqli_num_rows($tbl);
    echo "********";

    if(mysqli_num_rows($tbl)==0)
    {
      if (!$connectWrite) {
        die("Connection failed: " . mysqli_connect_error());
      }
      
      $sql = "INSERT INTO product (product_sellerID, product_name, product_price, product_brandID, product_manufacturerID, product_categoryID, product_barcode, product_info)
      VALUES ('$sellerID', '$productname', '$price', '$brand', '$manufacturer', '$category', '$barcode', '$info')";
      
      if (mysqli_query($connectWrite, $sql)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connectWrite);
      }
    }
    else {
        echo "Dieses Produkt haben sie bereits erstellt.";
    }
    mysqli_close($connectWrite);

    // if (!$connectWrite) {
    //     die("Connection failed: " . mysqli_connect_error());
    //   }
      
    //   $sql = "INSERT INTO product (product_name, product_info)
    //   VALUES ('test', '123') INTO productdetails (productDetails_height, productDetails_width) VALUES ('1', '2')";
      
    //   if (mysqli_query($connectWrite, $sql)) {
    //     echo "New record created successfully";
    //   } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($connectWrite);
    //   }
    //   mysqli_close($connectWrite);


    // //Write End
    // mysqli_close($connectWrite);


    // $msg =null;
    // include '../SQL/connectWrite.php';
    
    // if(isset($_POST['firstname']) && (!empty($_POST['firstname'])) && isset($_POST['lastname']) && (!empty($_POST['lastname'])) && isset($_POST['email']) && (!empty($_POST['email'])) && isset($_POST['phonenumber']) && (!empty($_POST['phonenumber'])) && isset($_POST['password']) && (!empty($_POST['password'])))
    // {
    //     $firstname = $_POST['firstname'];
    //     $lastname = $_POST['lastname'];
    //     $email = $_POST['email'];
    //     $phonenumberNF = $_POST['phonenumber'];
    //     $password = hash('sha256', $_POST['password']. $salt);

    //     //Format Phonenumber
    //     if(!($phonenumberNF[0] == "0" && $phonenumberNF[1] == "0"))
    //     {
    //         if(($phonenumberNF[0] == "+") && ($phonenumberNF[1] != "4" || $phonenumberNF[2] != "9"))
    //         {
    //             echo "fehler";
    //         }
    //         else
    //         {
    //             $search = array('|^0|','|/|', '| |', '|\.|');
    //             $repl = array("+49", '', '', '');
    //             $phonenumber = preg_replace($search, $repl, $phonenumberNF);
    //         }
    //     }
    //     else
    //     {
    //         echo "fehler";
    //     }
        
    //     $firstname  = strip_tags(mysqli_real_escape_string($connectWrite,trim($firstname)));
    //     $lastname   = strip_tags(mysqli_real_escape_string($connectWrite,trim($lastname)));
    //     $email      = strip_tags(mysqli_real_escape_string($connectWrite,trim($email)));
    //     $phonenumber= strip_tags(mysqli_real_escape_string($connectWrite,trim($phonenumber)));
    //     $password   = strip_tags(mysqli_real_escape_string($connectWrite,trim($password)));

    //     $query   = "SELECT * FROM user WHERE email='".$email."'";
    //     $tbl      = mysqli_query($connectWrite, $query);
    //     if(!mysqli_num_rows($tbl)>0)
    //     {
    //         if (!$connectWrite) {
    //             die("Connection failed: " . mysqli_connect_error());
    //           }
              
    //           $sql = "INSERT INTO user (firstname, lastname, email, phonenumber, password)
    //           VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$password')";
              
    //           if (mysqli_query($connectWrite, $sql)) {
    //             echo "New record created successfully";
    //             header("location: login.php");
    //             exit();
    //           } else {
    //             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    //           }
    //           mysqli_close($connectWrite);
    //     }
    //     else {
    //         echo "'$email' wird bereits verwendet.";
    //     }
    //     // }
    // }
    // else



?>