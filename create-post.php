<?php 


include "db-connection.php";


if(isset($_POST["newPost"]))
{
    if(empty($_POST["author"]) || empty($_POST["title"]) || empty($_POST["body"]) )
    {
        $error= "All fields are required";
        header("Location: create.php?error=$error");
        exit;
    }
    else
    {
        $author=$_POST["author"];
        $title=$_POST["title"];
        $body=$_POST["body"];
        try 
        {
            
            $sql = "INSERT INTO posts (Title, Body, Author)
            VALUES ('$title', '$body', '$author')";
            // use exec() because no results are returned
            $connection->exec($sql);
            //echo "New record created successfully";
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;

        header("Location: index.php");
        exit;
    }


    


}




?>




