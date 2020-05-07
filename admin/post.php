<?php include('includes/admin_header.php') ?>
<?php include('includes/admin_navbar.php') ?>
<?php

    if(isset($_POST['delete'])) {
        $posts = Post::find_by_id($_POST['delete']);
        $session->message("The comment with {$posts->id} user has been deleted");
        $posts->delete();
    }

    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page =20;
    $items_total_count = Post::count_all();
    $paginate = new Paginate($page,$items_per_page,$items_total_count);

    if(isset($_POST['submit'])) {
        $sql = "SELECT * FROM posts WHERE sub_category_id = ". $_POST['selected_sub_category'];
        $posts = Post::find_by_query($sql);
    } else {
        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT {$items_per_page} OFFSET {$paginate->offset()} ";
        $posts = Post::find_by_query($sql);
    }


?>


<div class="col-md-10">

    <h1 class="">Posts </h1>
    
    <p class="bg-success"><?php echo $message; ?></p>

    <a class="btn btn-primary float-right" href="add_post.php">Add New</a> 
    <form class="form-inline" method="post"> 
        <div class="col-4  pl-0" >                         
            <select class="form-control" name="selected_sub_category" id="">
                <option value="">Select Options</option>
                <?php 
                    $sql = "SELECT * FROM sub_categories";
                    $sub_categories = $database->query($sql);
                    while($row = mysqli_fetch_assoc($sub_categories)){
                        $id = $row['id'];
                        $name = $row['name'];
                        echo "<option name='selected_sub_category' value='$id'>$name</option>";
                    }
                ?>
            </select>    
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
   </form>

    <form action="" method='post'>
        <table class="table table-bordered table-hover">                     
            <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>        
                <th>Sub Category</th>
                <th>Title</th>
                <!-- <th>Image</th>
                <th>Tags</th> -->
                <th>Date</th>
                <th>Status</th>
                <!-- <th>Content</th> -->
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <!-- <th>Views</th> -->
                </tr>
            </thead>
        <tbody>
        <?php foreach($posts as $post): ?>
        <tr>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
            
            <td><?php echo $post->id; ?></td>
            <?php
                $sql = "SELECT * FROM sub_categories WHERE id = ".$post->sub_category_id;
                $sub_category_name = $database->query($sql);
                $row = mysqli_fetch_assoc($sub_category_name);         
            ?>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $post->title; ?></td>
            <td><?php echo $post->date; ?></td>
            <td><?php echo $post->status; ?></td>
            <!-- <td><?php echo substr($post->content,0,30); ?></td> -->
            <td><a class='btn btn-primary' href="../post.php?id=<?php echo $post->id; ?>">View Post</a></td>
            <td><a class='btn btn-info' href="edit_post.php?id=<?php echo $post->id; ?>">Edit</a></td>
            <td><button name="delete" type="submit" value="<?php echo $post->id; ?>" class="btn btn-danger">Delete</button></td>

            
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </form>

    <ul class="pagination justify-content-center">
            <?php
                if($paginate->page_total() > 1) {
                    if($paginate->has_previous()){
                        echo "<li class='page-item'><a class='page-link' href='post.php?page={$paginate->previous()}'>Previous</a></li>";
                    }
                    for ($i=1; $i <= $paginate->page_total(); $i++) { 
                        if($i == $paginate->current_page) {
                            echo "<li class='page-item active'><a class='page-link' href='post.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='post.php?page={$i}'>{$i}</a></li>";
                        }
                    }
                    if($paginate->has_next()){
                        echo "<li class='page-item'><a class='page-link' href='post.php?page={$paginate->next()}'>Next</a></li>";
                    }
                }
            ?>
        </ul>   
</div>

<?php include('includes/admin_footer.php') ?>