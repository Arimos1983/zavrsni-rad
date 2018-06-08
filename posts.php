<?php 

include "header.php";
include "db-connection.php";


?>

<?php

    // pripremamo upit
    $sql = "SELECT users.id as u_id, users.First_Name, users.Last_Name, posts.id, posts.Title, posts.Body, posts.Created_at, posts.User_id FROM users INNER JOIN posts on users.id=posts.User_id ORDER BY created_at DESC";
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

                <h2 class="blog-post-title"><?php echo ($user["Title"]) ?></h2>
                <p class="blog-post-meta"><?php echo ($user["Created_at"]) . " " ?><a href="#"><?php echo ($user["First_Name"] ." " . $user["Last_Name"]) ?></a></p>

                <p><?php echo ($user["Body"]) ?></p>
                <hr>
                <p><?php echo ($user["Body"]) ?></p>
                <h2>Heading</h2>
                <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <h3>Sub-heading</h3>
                <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                <pre><code>Example code block</code></pre>
                <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                <h3>Sub-heading</h3>
                <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <ul>
                    <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
                    <li>Donec id elit non mi porta gravida at eget metus.</li>
                    <li>Nulla vitae elit libero, a pharetra augue.</li>
                </ul>
                <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
                <ol>
                    <li>Vestibulum id ligula porta felis euismod semper.</li>
                    <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
                    <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
                </ol>
                <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
                <?php } ?>
            </div><!-- /.blog-post -->


    
        

        </div><!-- /.blog-main -->

        <?php include "sidebar.php"; ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php  include "footer.php";  ?>

