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
        // $post->tags = $_POST['tags'];
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
            <input type="text" class="form-control" name="title" required>
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select class="parent form-control" name="category_id" required>
            <option value="" class="msg" disabled selected>Select Category</option>
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
        <label for="sub_category">Sub Category</label>
        <select class="children form-control" name="sub_category_id" disabled required>
                <?php 
                    $sql = "SELECT * FROM sub_categories";
                    $categories = $database->query($sql);
                    while($row = mysqli_fetch_assoc($categories)){
                        echo "<option value='{$row['id']}' data-val='{$row['cat_id']}'>{$row['name']}</option>";
                        
                    }
                ?>
        </select>
    </div>

    <div class="form-group">
        <select name="status" required>
            <option value="">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
            <input type="file" name="image">
    </div>

    <!-- <div class="form-group">
        <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="tags">
    </div> -->

    <!-- <div class="form-group">
        <label for="content">Post Content</label>
            <textarea class="form-control" name="content" id="body" cols="30" rows="10"></textarea>
    </div> -->

    <!-- <textarea id="editor" name="content" rows="8" cols="40">
        </textarea>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css"> -->

        <?php include('includes/markdown_editor/editor.php') ?>
    <textarea name="content" id="kv-01" rows="15" class="form-control markdown" required title="Krajee Markdown Editor" data-use-twemoji="true"></textarea>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create" value="Publish Post">
        <a class="btn btn-primary float-right" href="includes/markdown_editor/examples/bs4.html">Examples</a>
</form>

</div>



<form>

</form>











<?php include('includes/admin_footer.php') ?>