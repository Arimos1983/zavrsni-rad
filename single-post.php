<?php 

include "header.php";
include "db-connection.php";
$error=null;


?>

<?php

    
    $id=$_GET["id"];
    //var_dump($id);
    if(isset($_GET["error"]))
    {
        $error=$_GET["error"];
    }
    // pripremamo upit
    $sql = "SELECT users.id, users.First_Name, users.Last_Name, posts.id as p_id, posts.Title, posts.Body, posts.Created_at, posts.User_id, comments.id as c_id, comments.Author, comments.Text, comments.Post_id FROM users INNER JOIN posts on users.id=posts.User_id LEFT JOIN comments on posts.id=comments.Post_id WHERE posts.id=?";
    $statement = $connection->prepare($sql);

    // izvrsavamo upit
    $statement->execute(array($id));

    // zelimo da se rezultat vrati kao asocijativni niz.
    // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // punimo promenjivu sa rezultatom upita
    $usersFull = $statement->fetchAll();

    // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
        echo '<pre>';
        //var_dump($usersFull);
        echo '</pre>';
    $posts=$usersFull[0];
    //var_dump($posts);
    $comments=[];
    foreach($usersFull as $comment)
    {
        array_push($comments,["cid" => $comment["c_id"],"author" => $comment["Author"], "text" => $comment["Text"]]);
        //var_dump($comments);
    } 
?>




<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">



                <h2 class="blog-post-title"><?php echo ($posts["Title"]) ?></h2>
                <!--Dugme za brisanje posta -->
                <form onsubmit="return confirm('Dali ste sigurni da hocete da obrisete vas post');" method="post" action="delete-post.php?id=<?php echo ($posts["id"]) ?>"><button class="btn btn-default float-right">Delete post</button></form></li>
                <p class="blog-post-meta"><?php echo ($posts["Created_at"]) . " " ?><a href="#"><?php echo ($posts["First_Name"] ." " . $posts["Last_Name"]) ?></a></p>

                <p><?php echo ($posts["Body"]) ?></p>
                <hr>
                <p><?php echo ($posts["Body"]) ?></p>

                    
                        <h2 >Comments</h2>
                        <div> <!--Forma za postavljanje novih komentara  -->
                            <form method="post" action="create-comment.php?id=<?php echo ($posts["p_id"]) ?>">
                                <input type="text" name="name" placeholder="Your name">
                                <?php if($error) { ?>
                                    <scope class="alert alert-danger"><?php echo $error; ?></scope>
                                <?php } ?>
                                <button type="submit" name="postButton"  class="btn btn-default float-right">Post comment</button><br>
                                <textarea style="width:530px; height:150px" type="text" name="comment"  placeholder="Comment"></textarea>
                            </form>
                        </div>

                        <!--Dugme za skrivanje komentara-->
                        <button id="button" type="button" class="btn btn-default" onclick="myFunction()">Hide comments</button>
                        
                            <script> 
                            function myFunction() {
                                var x = document.getElementById("hide");
                                var b = document.getElementById("button")
                                if (x.style.display === "none") 
                                {
                                    x.style.display = "block";
                                    b.innerHTML= "Hide comments";
                                } 
                                else 
                                {
                                    x.style.display = "none";
                                    b.innerHTML= "Show comments";
                                }
                                } 
                            </script>

                        <div class="comment" id="hide">
                                <?php  foreach($comments as $comment) { ?>

                                    <ul id="hideComments">
                                        <li><?php echo ($comment["author"]) ?>

                                        <!--Dugme za brisanje komentara-->
                                        <form method="post" action="delete-comment.php?cid=<?php echo ($comment["cid"]) ?>&id=<?php echo ($posts["p_id"]) ?>"><button class="btn btn-default float-right">Delete comment</button></form></li>
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