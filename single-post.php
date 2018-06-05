<?php 

include "header.php";
include "db-connection.php";


?>

<?php

    $id=$_GET["id"];
    // pripremamo upit
    $sql = "SELECT posts.id, posts.Title, posts.Body, posts.Author as p_Author, posts.Created_at, comments.id as c_id, comments.Author as c_Author, comments.Text, comments.Post_id  FROM posts LEFT JOIN comments on posts.id=comments.Post_id where posts.id=?";
    $statement = $connection->prepare($sql);

    // izvrsavamo upit
    $statement->execute(array($id));

    // zelimo da se rezultat vrati kao asocijativni niz.
    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // punimo promenjivu sa rezultatom upita
    $postsFull = $statement->fetchAll();

    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
        echo '<pre>';
        //var_dump($postsFull);
        echo '</pre>';
    $posts=$postsFull[0];
    //var_dump($posts);
    $comments=[];
    foreach($postsFull as $comment)
    {
        array_push($comments,["author" => $comment["c_Author"], "text" => $comment["Text"]]);
        //var_dump($comments);
    }
?>




<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">



                <h2 class="blog-post-title"><?php echo ($posts["Title"]) ?></h2>
                <p class="blog-post-meta"><?php echo ($posts["Created_at"]) . " " ?><a href="#"><?php echo ($posts["p_Author"]) ?></a></p>

                <p><?php echo ($posts["Body"]) ?></p>
                <hr>
                <p><?php echo ($posts["Body"]) ?></p>

        <div class="comment">
            <h2 >Comments</h2>

                <?php  foreach($comments as $comment) { ?>

                    <ul>
                        <li><?php echo ($comment["author"]) ?></li>
                        <li><?php echo ($comment["text"]) ."<hr>" ?></li>
                    </ul>
                <?php } ?>
        </div>
                
            </div><!-- /.blog-post -->


    
        

        </div><!-- /.blog-main -->

        <?php include "sidebar.php"; ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php  include "footer.php";  ?>