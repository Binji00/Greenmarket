<html>
<body>
<?php

include 'connectRead.php';
    try{
        $mysql = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwd);
    } catch (PDOException $e){
        echo "SQL Error: ".$e->getMessage();
    }

?>
</body>
</html>