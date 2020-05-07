<?php

class Post extends Db_object{

    protected static $db_table = "posts";
    protected static $db_table_fields = array("category_id", "sub_category_id", "title", "date", "image", "content", "tags", "comment", "status", "view_counts");
    public $id;
    public $category_id;
    public $sub_category_id;
    public $title;
    public $date;
    public $image;
    public $content;
    public $tags;
    public $comment;
    public $status;
    public $view_counts;
    public $upload_directory = "images";
    public $image_placeholder = "http://placehold.it/400x400&text=image";
    

    public static function count_all_sub_cat_posts($sub_id) {

        global $database;

        $sql = "SELECT COUNT(*) FROM posts WHERE sub_category_id = " .$sub_id;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);
        
    }







} // End of Class






?>