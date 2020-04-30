<?php 
include('includes/admin_header.php');
include('includes/admin_navbar.php');

if(isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    $sql = "INSERT INTO categories (name) VALUES ('$cat_title')";
    $database->query($sql);
}

if(isset($_POST['sub_submit'])) {
    $sub_title = $_POST['sub_title'];
    $cat_id = $_POST['cat_id'];
    $sql = "INSERT INTO sub_categories (cat_id, name) VALUES ($cat_id, '$sub_title')";
    $database->query($sql);
}

if(isset($_GET['delete'])) {
    $sql = "DELETE FROM categories WHERE id = ".$_GET['delete'];
    $database->query($sql);
}

if(isset($_GET['delete2'])) {
    $sql = "DELETE FROM sub_categories WHERE id = ".$_GET['delete'];
    $database->query($sql);
}

 ?>
    <div class="col-sm-3">
    <h1>Add Category</h1>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="cat_title" required>
            </div>
            <div class="form-group">
                <input class="btn btn-primary float-right" type="submit" name="submit" value="Add Category">
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>        
                    <th>Category Title</th>
                    <th>Delete</th> 
                    <!-- <th>Edit</th>  -->
            </thead>
            <tbody>
            <?php  
                $sql = "SELECT * FROM categories";
                $select_categories = $database->query($sql);
                while($row = mysqli_fetch_assoc($select_categories)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    echo "<td>{$id}</td>";
                    echo "<td>{$name}</td>";
                    echo "<td><a href='category.php?delete={$id}'>Delete</a></td>";
                    // echo "<td><a href='category.php?edit={$id}'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="col-sm-5 offset-md-1">
    <h1>Add Sub Category</h1>
        <form action="" method="post">
            <div class="form-group col-4">
                <label for="category" class="control-label col-xs-2">Category</label>
                <select class="form-control" id="number"  name='cat_id'>
                <?php 
                    $sql = "SELECT * FROM categories";
                    $categories = $database->query($sql);
                    while($row = mysqli_fetch_assoc($categories)){
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                ?>
                </select>
            </div>
            <label for="category" class="control-label col-xs-2">Sub Category</label>
            <div class="form-group col-5">
                <input type="text" class="form-control" name="sub_title" required>
                <input class="btn btn-primary float-right" type="submit" name="sub_submit" value="Add Sub Category">
            </div>
            <div class="form-group">

            </div>
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>        
                    <th>Category Title</th>
                    <th>Sub Category Title</th>
                    <th>Delete</th> 
                    <!-- <th>Edit</th>  -->
            </thead>
            <tbody>
            <?php  
                $sql = "SELECT * FROM sub_categories";
                $select_categories = $database->query($sql);
                while($row = mysqli_fetch_assoc($select_categories)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    echo "<td>{$id}</td>";
                    $sql = "SELECT * FROM categories WHERE id = ".$id;
                    $cat_name = $database->query($sql);
                    $row2 = mysqli_fetch_assoc($cat_name);
                    echo "<td>{$row2['name']}</td>";
                    echo "<td>{$name}</td>";
                    echo "<td><a href='category.php?delete_sub={$id}'>Delete</a></td>";
                    // echo "<td><a href='category.php?edit={$id}'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('includes/admin_footer.php') ?>