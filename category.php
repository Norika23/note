<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<?php 

    $sub_id = $_GET['id'];

    $sql = "SELECT * FROM posts WHERE sub_category_id = ". $sub_id;
    $posts = Post::find_by_query($sql);

?>

<div class="container">

        <div class="">
            <?php foreach($posts as $post): ?>
            <h3><a href="post.php?id=<?php echo $post->id; ?>"><?php echo $post->title; ?></a></h3>

                <p class="float-right"><span class="glyphicon glyphicon-time"></span><?php echo $post->date; ?></p>

                <a href="post.php?id=<?php echo $post->id; ?>"></a>
                
                
                <p><?php echo substr($post->content,0,70); ?>
                <a class="btn btn-primary float-right" href="post.php?id=<?php echo $post->id; ?>">Read More </a>
                <br>
<hr>
            <?php  endforeach; ?>
        </div>
        <?php //include "includes/sidebar.php"; ?>
    </div>
</div>





<?php include('includes/footer.php') ?>