<?php


include "db-connection.php";
$id=$_GET["id"];


try {
        
        $sql = "DELETE FROM comments WHERE Post_id=$id";
        $connection->exec($sql);
        $sql = "DELETE FROM posts WHERE id=$id";
        $connection->exec($sql);
        
    }
    
catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

header("Location: index.php");
exit;
    


    









 ?>