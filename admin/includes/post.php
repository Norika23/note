<?php

class Post extends Db_object{

    protected static $db_table = "posts";
    protected static $db_table_fields = array('category_id', 'sub_category_id', 'title', 'date', 'image', 'content', 'tags', 'comment', 'status', 'view_counts');
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
    
} // End of Class






?>