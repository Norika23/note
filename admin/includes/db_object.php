<?php

    class Db_object {

        public $errors = array();
        public $upload_errors_array = array(

            UPLOAD_ERR_OK           => "There is no error",
            UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
            UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
            UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
            UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."	
        
            );

        //protected static $db_table = "users";

        public static function find_all() {

            return static::find_by_query("SELECT * FROM " . static::$db_table . " ORDER BY id DESC ");
    
        }
    

    public function set_file($file) {

        for($i = 0; $i < count($file["name"]); $i++ ){

            if(empty($file) || !$file || !is_array($file)) {

                $this->errors[] = "There was no file uploaded here";
                return false;

             } elseif($file['error'][$i] != 0) {

                $this->errors[] = $this->upload_errors_array[$file['error'][$i]];
                return false;

            } else {
                if(!is_array($this->image)){
                    $this->image = array();
                }
                $this->image[] = $file['name'][$i];
                //$this->image[] = basename($file['name'][$i]);
                $this->tmp_path[] = $file['tmp_name'][$i];
                
            }
        }
        return true;
    }
    
        public static function find_by_id($id) {
    
            global $database;
    
            $the_result_array = static::find_by_query("SELECT * FROM  " . static::$db_table . " WHERE id = $id LIMIT 1");
    
            return !empty($the_result_array) ? array_shift($the_result_array) : false;
  
        }
    

        public static function find_by_query($sql) {

            global $database;
    
            $result_set = $database->query($sql);
            $the_object_array = array();
    
            while($row = mysqli_fetch_array($result_set)) {
    
                $the_object_array[] = static::instantiation($row);
    
            }
    
            return $the_object_array;
    
        }



    public static function instantiation($the_record) {

        $calling_class = get_called_class();

        $the_object = new $calling_class;

        foreach($the_record as $the_attribute => $value) {

            if($the_object->has_the_attribute($the_attribute)) {

                $the_object->$the_attribute = $value;

            }

        }

        return $the_object;
    }


    private function has_the_attribute($the_attribute) {

        $object_properties = get_object_vars($this);

        return array_key_exists($the_attribute, $object_properties);

    }

    
    protected function properties() {

        $properties = array();

        foreach(static::$db_table_fields as $db_field) {

            if(property_exists($this, $db_field)) {

                $properties[$db_field] = $this->$db_field;

            }

        }

        return $properties;

    }


    protected function clean_properties() {

        global $database;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            
            $clean_properties[$key] = $database->escape_string($value);

        }

        return $clean_properties;

    }

    public function save() {

        return isset($this->id) ? $this->update() : $this->create();

    }


    public function create() {

        global $database;

        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$db_table . " (". implode(",",array_keys($properties)) . ")";
        $sql .= " VALUES ('" . implode("','",array_values($properties)) . "')";


        if($database->query($sql)) {

            $this->id = $database->the_insert_id();

            return true;

        } else {

            return false;

        }

    }


    public function update() {

        global $database;

        $properties = $this->clean_properties();

        $properties_pairs = array();

        foreach($properties as $key => $value) {

            $properties_pairs[] = "{$key}='{$value}'   ";

        }

        $sql = "UPDATE " . static::$db_table . "  SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id = " .  $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false ;

    }


    public function delete() {

        global $database;

        $sql = "DELETE FROM " . static::$db_table . "  ";
        $sql .= "WHERE id = " . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false ;

    }


    public static function count_all() {

        global $database;

        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);
        
    }



    public function upload_photo() {

        if(!empty($this->errors)) {

            return false;

         }

        for($i = 0; $i < count($_FILES["image"]["name"]); $i++ ){

            if(empty($this->image[$i]) || empty($this->tmp_path[$i])) {

                $this->errors[] = "the file was not available";
                return false;

            } 

             $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->image[$i];

            if(file_exists($target_path)) {

                $this->errors[] = "The file {$this->image[$i]} already exists";
                return false;

            } 

            if(move_uploaded_file($this->tmp_path[$i], $target_path)) {

                unset($this->tmp_path[$i]);
                    
            } else {

                $this->errors[] = "the file directory was not have permission";
                return false;

            }

        }
        // implode("," , $this->image);

       return true; 
    }


    public function image_path_and_placeholder() {
        
        return empty($this->image) ? $this->image_placeholder : $this->upload_directory.DS.$this->image;

    }

    public function thumb_image_path_and_placeholder() {
        
        return empty($this->thumb_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->thumb_image;

    }
        
    public function delete_photo() {

        if($this->delete()) {

            $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->image;

            return unlink($target_path) ? true : false;

        } else {

            return false;

        }

        

    }

    public function picture_path_one() {
        
        $this->image = explode(',',$this->image);
        return $this->upload_directory.DS.$this->image[0];

    }

    public function picture_path_all($i) {
        
        //$this->image = explode (',',$this->image);

        //for($i = 0; $i < count($this->image); $i++ ){

        return $this->upload_directory.DS.$this->image[$i];

        //}

    }


    public function ajax_save_user_image($thumb_image, $id, $db_table) {

        global $database;

        $thumb_image = $database->escape_string($thumb_image);
        $id = $database->escape_string($id);

        $this->thumb_image = $thumb_image;
        $this->id = $id;

        $sql = "UPDATE " . $db_table . " SET thumb_image = '{$this->thumb_image}' ";
        $sql .= " WHERE id = {$this->id} ";
        $update_image = $database->query($sql);

        echo $this->thumb_image_path_and_placeholder();

    }

    public function ajax_delete_user_image($thumb_image, $id, $db_table) {

        global $database;

        $thumb_image = $database->escape_string($thumb_image);
        $id = $database->escape_string($id);

        $this->thumb_image = $thumb_image;
        $this->id = $id;

        $sql = "UPDATE " . $db_table . " SET thumb_image = '{$this->thumb_image}' ";
        $sql .= " WHERE id = {$this->id} ";
        $update_image = $database->query($sql);

        echo $this->thumb_image_path_and_placeholder();

    }


} //end


?>