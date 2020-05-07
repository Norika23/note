<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<?php 

    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page =20;
    $items_total_count = Post::count_all();
    $paginate = new Paginate($page,$items_per_page,$items_total_count);

    $sql = "SELECT * FROM posts WHERE status = 'published' ORDER BY id DESC LIMIT {$items_per_page} OFFSET {$paginate->offset()} ";
    $posts = Post::find_by_query($sql);

?>

<div class="container">
    <div class="col-md-11 mt-4">
        <?php foreach($posts as $post): ?>
            <h4><a class="text-secondary" href="post.php?id=<?php echo $post->id; ?>"><?php echo $post->title; ?></a></h4>
            <h6 class="text-secondary float-right"><?php echo $post->date; ?></h6><br>
            <hr>
        <?php  endforeach; ?>
           
        <?php //include "includes/sidebar.php"; ?>

        <ul class="pagination justify-content-center">
            <?php
                if($paginate->page_total() > 1) {
                    if($paginate->has_previous()){
                        echo "<li class='page-item'><a class='page-link' href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                    }
                    for ($i=1; $i <= $paginate->page_total(); $i++) { 
                        if($i == $paginate->current_page) {
                            echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                        }
                    }
                    if($paginate->has_next()){
                        echo "<li class='page-item'><a class='page-link' href='index.php?page={$paginate->next()}'>Next</a></li>";
                    }
                }
            ?>
        </ul>   
    </div>
</div>

            

<?php include('includes/footer.php') ?>