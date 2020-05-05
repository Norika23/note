<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<?php 

    $sql = "SELECT * FROM posts ";
    $posts = Post::find_by_query($sql);

?>

<div class="container">
    <div class="col-md-11 mt-4">
            <?php foreach($posts as $post): ?>

            <h4><a class="text-secondary" href="post.php?id=<?php echo $post->id; ?>"><?php echo $post->title; ?></a></h4>

                <!-- <p><?php echo htmlentities(substr($post->content,0,70)); ?> -->
                <!-- <a class="btn btn-primary float-right" href="post.php?id=<?php echo $post->id; ?>">Read More </a> -->
                <h6 class="text-secondary float-right"><?php echo $post->date; ?></h6><br>
            <hr>
            <?php  endforeach; ?>
            </div>
        <?php //include "includes/sidebar.php"; ?>
    </div>
</div>





<?php include('includes/footer.php') ?>