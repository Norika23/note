<?php include('includes/admin_header.php') ?>
<?php include('includes/admin_navbar.php') ?>

<?php

    $post = new Post();

    if(isset($_POST['create'])) {

        $post->category_id = $_POST['category_id'];
        $post->sub_category_id = $_POST['sub_category_id'];
        $post->title = $_POST['title'];
        $post->date = date('Y-m-d');
        //$post->image = $_POST['image'];
        $post->content = $_POST['content'];
        $post->tags = $_POST['tags'];
        $post->status = $_POST['status'];


        //$session->message("The user {$user->username} has been added");
        //$post->upload_photo();
        $post->save(); 
        //redirect("post.php");
    }

?>




<div class="col-md-9">
<h1>New Post</h1>
<?php echo $message; ?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
    <label for="category">Category</label>
        <select class="form-control" id="number"  name='category_id'>
                <?php 
                    $sql = "SELECT * FROM categories";
                    $categories = $database->query($sql);
                    while($row = mysqli_fetch_assoc($categories)){
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                ?>
            </select>
    </div>

    <div class="form-group">
    <label for="category">Sub Category</label>
        <select class="form-control" id="number"  name='sub_category_id'>
                <?php 
                    $sql = "SELECT * FROM sub_categories";
                    $categories = $database->query($sql);
                    while($row = mysqli_fetch_assoc($categories)){
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                ?>
            </select>
    </div>


    <div class="form-group">
        <select name="status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>

    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
            <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
            <textarea class="form-control" name="content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create" value="Publish Post">
    </div>

</form>


</div>

<?php include('includes/admin_footer.php') ?>