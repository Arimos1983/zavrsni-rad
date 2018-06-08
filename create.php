<?php 

include "header.php";
include "db-connection.php";
$error=null;
if(isset($_GET["error"]))
    {
        $error=$_GET["error"];
    }

?>
<script>
    function checkForm(f)
    {
        if(f["author"].value === "" || f["title"].value === "" || f["body"].value === "" )
        {
            alert("All fields are required");
            return false;
        }
        return true;
    }
</script>




<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">
            <h2>Make new post</h2>
            <div class="blog-post">
                
                <form method="post" action="create-post.php" onsubmit="return checkForm(this);">
                    <input type="text" name="author" placeholder="Your name">
                    
                    <?php if($error) { ?>
                        <scope class="alert alert-danger"><?php echo $error; ?></scope>
                    <?php } ?><br>

                    <input style="width:250px" type="text" name="title" placeholder="Article title">
                    <textarea style="width:530px; height:150px" type="text" name="body"  placeholder="Main body"></textarea>
                    <button type="submit" name="newPost"  class="btn btn-default float-right">Post blog</button>
                </form>

                
                
            </div><!-- /.blog-post -->


    
        

        </div><!-- /.blog-main -->

        <?php include "sidebar.php"; ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php  include "footer.php";  ?>
