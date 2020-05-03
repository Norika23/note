<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<?php 

    $post_id = $_GET['id'];

    $sql = "SELECT * FROM posts WHERE id = ". $post_id;
    $posts = Post::find_by_query($sql);

?>

<div class="container">

<div class="col-md-9 offset-md-1 ">
            <?php foreach($posts as $post): ?>
            <h2><?php echo $post->title; ?></h2>
<div class="col-md-9 offset-md-1 ">
                <p class="float-right"><span class="glyphicon glyphicon-time"></span><?php echo $post->date; ?></p>

                <a href="post.php?p_id=<?php echo $post_id; ?>"></a>
                
                
                <p><?php echo $post->content; ?></p>
                <br>
<hr></div>
            <?php  endforeach; ?>
        </div></div>
        <?php //include "includes/sidebar.php"; ?>
    </div>
</div>





<?php include('includes/footer.php') ?>