<?php


include "db-connection.php";
$id=$_GET["id"];
$cid=$_GET["cid"];

try {
        
        $sql = "DELETE FROM comments WHERE id=$cid";

        // use exec() because no results are returned
        $connection->exec($sql);
        //echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

        header("Location: single-post.php?id=$id");
        exit;
    


    









 ?>