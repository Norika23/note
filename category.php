<?php include('includes/header.php') ?>
<?php include('includes/navbar.php') ?>

<?php 

    $sub_id = $_GET['id'];
    
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page =20;
    $items_total_count = Post::count_all_sub_cat_posts($sub_id);
    $paginate = new Paginate($page,$items_per_page,$items_total_count);

    $sql = "SELECT * FROM posts WHERE sub_category_id = ". $sub_id . " AND status = 'published' ORDER BY id DESC  LIMIT {$items_per_page} OFFSET {$paginate->offset()}";
    $posts = Post::find_by_query($sql);

?>

<div class="container mt-4">
    <div class="col-md-11">
            <?php foreach($posts as $post): ?>
                <h4><a class="text-secondary"  href="post.php?id=<?php echo $post->id; ?>"><?php echo $post->title; ?></a></h4>
                <h6 class="text-secondary float-right"><?php echo $post->date; ?></h6><br>
                <hr>
            <?php  endforeach; ?>
            <ul class="pagination justify-content-center">
            <?php
                if($paginate->page_total() > 1) {
                    if($paginate->has_previous()){
                        echo "<li class='page-item'><a class='page-link' href='category.php?id={$sub_id}&page={$paginate->previous()}'>Previous</a></li>";
                    }
                    for ($i=1; $i <= $paginate->page_total(); $i++) { 
                        if($i == $paginate->current_page) {
                            echo "<li class='page-item active'><a class='page-link' href='category.php?id={$sub_id}&page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='category.php?id={$sub_id}&page={$i}'>{$i}</a></li>";
                        }
                    }
                    if($paginate->has_next()){
                        echo "<li class='page-item'><a class='page-link' href='category.php?id={$sub_id}&page={$paginate->next()}'>Next</a></li>";
                    }
                }
            ?>
        </ul>   
        <?php //include "includes/sidebar.php"; ?>
    </div>
</div>





<?php include('includes/footer.php') ?>