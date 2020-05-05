<?php include('includes/admin_header.php') ?>
<?php include('includes/admin_navbar.php') ?>
<?php

    $post = Post::find_by_id($_GET['id']);

    if(isset($_POST['update'])) {

        $post->category_id = $_POST['category_id'];
        $post->sub_category_id = $_POST['sub_category_id'];
        $post->title = $_POST['title'];
        // $post->date = date('Y-m-d');
        //$post->image = $_POST['image'];
        $post->content = $_POST['content'];
        // $post->tags = $_POST['tags'];
        // $post->status = $_POST['status'];


        $session->message("The post {$post->title} has been updated");
        //$post->upload_photo();
        $post->save(); 
        //redirect("post.php");

    }

?>


<div class="col-md-9">
<h1>Edit Post</h1>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $post->title; ?>" required>
    </div>

    <div class="form-group">
    <label for="category">Category</label>
        <select class="form-control" id="number"  name='category_id'>
                <?php 
                    $sql = "SELECT * FROM categories";
                    $categories = $database->query($sql);
                    while($row = mysqli_fetch_assoc($categories)){
                        if($row['id'] == $post->category_id) {
                            echo "<option selected value='{$row['id']}'>{$row['name']}</option>";
                        } else {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
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
                        if($row['id'] == $post->sub_category_id) {
                            echo "<option selected value='{$row['id']}'>{$row['name']}</option>";
                        } else {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                    }
                ?>
            </select>
    </div>


    <!-- <div class="form-group">
        <select name="status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div> -->

    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
            <input type="file" name="image">
    </div> -->

    <!-- <div class="form-group">
        <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="tags">
    </div> -->

    <!-- <div class="form-group">
        <label for="content">Post Content</label>
            <textarea class="form-control" name="content" id="body" cols="30" rows="10"><?php //echo $post->content; ?></textarea>
    </div> -->
    <!-- <textarea name="content" id="kv-01" rows="15" class="markdown" required data-bs-version="3" data-theme="fa4" title="Krajee Markdown Editor">
    <?php //echo $post->content; ?></textarea> -->
    <?php include('includes/markdown_editor/editor.php') ?>
    <textarea name="content" id="kv-01" rows="15" class="form-control markdown" required title="Krajee Markdown Editor" data-use-twemoji="true"><?php echo $post->content; ?></textarea>
    <hr>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Publish Post">
        <a class="btn btn-primary float-right" href="includes/markdown_editor/examples/bs4.html">Examples</a>
    </div>

</form>


</div>

<?php include('includes/admin_footer.php') ?>