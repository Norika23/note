<?php 
include('includes/admin_header.php');
include('includes/admin_navbar.php');

//ボタン押した後の機能

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

if(isset($_POST['edit_cat'])) {
     $sql = "UPDATE categories set name ='".$_POST['edit_name'] ."' WHERE id = ". $_GET['edit_id'];
     $database->query($sql);
}

if(isset($_POST['edit_sub'])) {
    //UPDATE `sub_categories` SET `cat_id` = '12', `name` = '困っていること2' WHERE `sub_categories`.`id` = 6;
     $sql = "UPDATE sub_categories set cat_id =".$_POST['cat_id'] .", name = '".$_POST['edit_sub_name'] ."'  WHERE id = ". $_GET['edit_sub_id'];
     $database->query($sql);
}

 ?>

<!-- HTMLの始まり -->

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
    <!-- categoryがeditされたら -->
        <?php 
        if(isset($_GET['edit_id'])) {
            $sql = "SELECT * FROM categories WHERE id = ".$_GET['edit_id'];
            $fettch_category_name = $database->query($sql);
            $row = mysqli_fetch_assoc($fettch_category_name);
        ?>
        <br>
            <h1>Edit Category</h1>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="edit_name" required value="<?php echo $row['name']; ?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary float-right" type="submit" name="edit_cat" value="Edit Category">
                </div>
            </form>
        <?php } ?>

<!-- categoryのtable部分 -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>        
                    <th>Category Title</th>
                    <th>Delete</th> 
                    <th>Edit</th> 
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
                    echo "<td><a href='category.php?edit_id={$id}'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<!-- sub_category部分 -->
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
            <label for="category" class="control-label col-xs-2">　Sub Category</label>
            <div class="form-group col-5">
                <input type="text" class="form-control" name="sub_title" required>
                <input class="btn btn-primary float-right" type="submit" name="sub_submit" value="Add Sub Category">
            </div>
            <div class="form-group">

            </div>
        </form>
<!--  sub_categoryがeditされたら -->
<?php if(isset($_GET['edit_sub_id'])) { ?>
<br>
<h1>Edit Sub Category</h1>
        <form action="" method="post">
            <div class="form-group col-4">
                <label for="category" class="control-label col-xs-2">Category</label>
                <select class="form-control" id="number"  name='cat_id'>
                <?php 
                    $sql = "SELECT * FROM categories";
                    $categories = $database->query($sql);
                    while($row = mysqli_fetch_assoc($categories)){
                        if($row['id'] == $_GET['edit_cat_id']) {
                            echo "<option selected value='{$row['id']}'>{$row['name']}</option>";
                        } else {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }  
                    }
                ?>
                </select>
            </div>

            <?php  
                $sql = "SELECT * FROM sub_categories where id = ".$_GET['edit_sub_id'];
                $fettch_sub_category_name = $database->query($sql);
                $row = mysqli_fetch_assoc($fettch_sub_category_name);
            ?>

                <label for="category" class="control-label col-xs-2">　Sub Category</label>
                <div class="form-group col-5">
                    <input type="text" class="form-control" name="edit_sub_name" required value="<?php echo $row['name']; ?>">
                    <input class="btn btn-primary float-right" type="submit" name="edit_sub" value="Add Sub Category">
                </div>
                <div class="form-group">

            </div>
        </form>
<?php } ?>
<!-- subcategoryのtable -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>        
                    <th>Category Title</th>
                    <th>Sub Category Title</th>
                    <th>Delete</th> 
                    <th>Edit</th> 
            </thead>
            <tbody>
            <?php  
                $sql = "SELECT * FROM sub_categories";
                $select_categories = $database->query($sql);
                while($row = mysqli_fetch_assoc($select_categories)) {
                    $id = $row['id'];
                    $cat_id = $row['cat_id'];
                    $name = $row['name'];
                    echo "<td>{$id}</td>";
                    $sql2 = "SELECT * FROM categories WHERE id = ".$cat_id;
                    $cat_name = $database->query($sql2);
                    $row2 = mysqli_fetch_assoc($cat_name);
                    echo "<td>{$row2['name']}</td>";
                    echo "<td>{$name}</td>";
                    echo "<td><a href='category.php?delete_sub={$id}'>Delete</a></td>";
                    echo "<td><a href='category.php?edit_cat_id={$cat_id}&edit_sub_id={$id}'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('includes/admin_footer.php') ?>