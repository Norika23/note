<?php include('includes/admin_header.php') ?>
<?php include('includes/admin_navbar.php') ?>
<?php

    $posts = Post::find_all();

?>


<div class="col-md-9">
    <h1 class="">Posts </h1> 
    <a class="btn btn-primary" href="add_post.php">Add New</a>
    <form action="" method='post'>
        <table class="table table-bordered table-hover">                     
            <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>        
                <th>Sub Category</th>
                <th>Title</th>
                <!-- <th>Status</th>
                <th>Image</th>
                <th>Tags</th> -->
                <th>Date</th>
                <th>Content</th>
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
            <td><?php echo substr($post->content,0,30); ?></td>
            <td><a class='btn btn-primary' href="../post.php?id=<?php echo $post->id; ?>">View Post</a></td>
            <td><a class='btn btn-info' href="edit_post.php?id=<?php echo $post->id; ?>">Edit</a></td>
            <td><a class='btn btn-danger' href="edit_post.php?id=<?php echo $post->id; ?>">Delete</a></td>

            
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </form>


</div>

<?php include('includes/admin_footer.php') ?>