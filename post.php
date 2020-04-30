<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<?php 

    $post_id = $_GET['id'];

    $sql = "SELECT * FROM posts WHERE id = ". $post_id;
    $posts = Post::find_by_query($sql);

?>

<div class="container">

        <div class="">
            <?php foreach($posts as $post): ?>
            <h2><?php echo $post->title; ?></h2>

                <p class="float-right"><span class="glyphicon glyphicon-time"></span><?php echo $post->date; ?></p>

                <a href="post.php?p_id=<?php echo $post_id; ?>"></a>
                
                
                <p><?php echo $post->content; ?></p>
                <a class="btn btn-primary float-right" href="post.php?p_id=<?php echo $post_id; ?>">Read More </a>
                <br>
<hr>
            <?php  endforeach; ?>
        </div>
        <?php //include "includes/sidebar.php"; ?>
    </div>
</div>





<?php include('includes/footer.php') ?>