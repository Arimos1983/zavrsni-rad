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


<aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Latest posts</h4>
                <?php foreach ($users as $user) { ?>

                    <ul >
                        <li><a href="single-post.php?id=<?php echo ($user["id"]) ?>" ><?php echo ($user["Title"]) ?></a></li>
                    </ul>
                    
                <?php } ?>
            </div>
        <!-- <div class="sidebar-module">
                <h4>Archives</h4>
                <ol class="list-unstyled">
                    <li><a href="#">March 2014</a></li>
                    <li><a href="#">February 2014</a></li>
                    <li><a href="#">January 2014</a></li>
                    <li><a href="#">December 2013</a></li>
                    <li><a href="#">November 2013</a></li>
                    <li><a href="#">October 2013</a></li>
                    <li><a href="#">September 2013</a></li>
                    <li><a href="#">August 2013</a></li>
                    <li><a href="#">July 2013</a></li>
                    <li><a href="#">June 2013</a></li>
                    <li><a href="#">May 2013</a></li>
                    <li><a href="#">April 2013</a></li>
                </ol>
            </div>
            <div class="sidebar-module">
                <h4>Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                </ol>
            </div> -->
        </aside><!-- /.blog-sidebar -->