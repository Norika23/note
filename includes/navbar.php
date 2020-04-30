
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
<div class="container">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">


<?php

  $sql = "SELECT * FROM categories ";
  $categories_query = $database->query($sql);

  while($row = mysqli_fetch_assoc($categories_query)) {

    $id = $row['id'];
    $name =$row['name'];

    echo "<li class='nav-item dropdown'>";
      echo "<a class='nav-link dropdown-toggle' href='#' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>$name</a>";
      echo "<div class='dropdown-menu' aria-labelledby='dropdown01'>";
        $sql = "SELECT * FROM sub_categories WHERE cat_id = $id";
        $sub_categories_query = $database->query($sql);
        while($row2 = mysqli_fetch_assoc($sub_categories_query)) {

          $sub_id = $row2['id'];
          $sub_name = $row2['name'];
          echo "<a class='dropdown-item' href='category.php?id=$sub_id'>$sub_name</a>";
        }
      echo "</div>";
    echo "</li>";

  }


?>

      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="admin/index.php">Admin</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
