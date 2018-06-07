<?php


include "db-connection.php";
$id=$_GET["id"];

if(isset($_POST["postButton"]))
{
    if(empty($_POST["name"]) || empty($_POST["comment"]))
    {
        $error= "All fields are required";
        header("Location: single-post.php?id=$id&error=$error");
        exit;
    }
    else
    {
        $name=$_POST["name"];
        $comment=$_POST["comment"];
        try 
        {
            
            $sql = "INSERT INTO comments (Author, Text, Post_id)
            VALUES ('$name', '$comment', '$id')";
            // use exec() because no results are returned
            $connection->exec($sql);
            //echo "New record created successfully";
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;

        header("Location: single-post.php?id=$id");
        exit;
    }


    


}






 ?>