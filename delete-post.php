<?php


include "db-connection.php";
$id=$_GET["id"];


try {
        
        $sql = "DELETE FROM comments WHERE Post_id=$id";

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