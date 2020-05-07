<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<?php 

    $post_id = $_GET['id'];

    $sql = "SELECT * FROM posts WHERE id = ". $post_id;
    $posts = Post::find_by_query($sql);

?>

<div class="container">

    <div class="col-md-10 offset-md-1 mt-5">
        <?php foreach($posts as $post): ?>
            <h2 class="text-secondary"><?php echo $post->title; ?></h2>
            <p class="text-secondary float-right"><span class="glyphicon glyphicon-time"></span><?php echo $post->date; ?></p>
                <div class="col-md-9 offset-md-1 mt-5">
                <a href="post.php?p_id=<?php echo $post_id; ?>"></a>

                <?php include('includes/markdown/show_markdown_link.php') ?>

                <div class="note_content markdown-body"><?php echo htmlentities($post->content); ?></div>

         <?php  endforeach; ?>
                </div>
        <?php //include "includes/sidebar.php"; ?>
    </div>
</div>


<?php include('includes/footer.php') ?>