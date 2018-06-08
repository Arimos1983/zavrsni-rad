
<?php 

include "header.php";
include "db-connection.php";


?>

<?php

    // pripremamo upit
    $sql = "SELECT users.id, users.First_Name, users.Last_Name, posts.id as p_id, posts.Title, posts.Body, posts.Created_at, posts.User_id FROM users INNER JOIN posts on users.id=posts.User_id ORDER BY created_at DESC";
    $statement = $connection->prepare($sql);

    // izvrsavamo upit
    $statement->execute();

    // zelimo da se rezultat vrati kao asocijativni niz.
    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // punimo promenjivu sa rezultatom upita
    $users = $statement->fetchAll();

    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
        echo '<pre>';
        //var_dump($posts);
        echo '</pre>';

?>



<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">

<?php
    foreach ($users as $user) {
?>

                <h2 class="blog-post-title"><a href="single-post.php?id=<?php echo ($user["p_id"]) ?>"><?php echo ($user["Title"]) ?></a></h2>
                <p class="blog-post-meta"><?php echo ($user["Created_at"]) . " " ?>
                <a href="#" ><?php echo ($user["First_Name"] ." " . $user["Last_Name"]) ?></a></p>

                <p><?php echo ($user["Body"]) ?></p>
                <hr>
                <p><?php echo ($user["Body"]) ?></p>
                
                <?php } ?>
            </div><!-- /.blog-post -->


    
        

        </div><!-- /.blog-main -->

        <?php include "sidebar.php"; ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php  include "footer.php";  ?>


