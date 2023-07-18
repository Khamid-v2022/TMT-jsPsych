<?php 

class DBObject {
 
    // database connection and table name
    private $conn;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create Trial
    public function createTrial($item){
        // query to insert record
        $query = "INSERT INTO `trial`
                SET
                    `success`=:success,
                    `trial_type`=:trial_type, 
                    `time_elapsed`=:time_elapsed, 
                    `internal_node_id`=:internal_node_id";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
   
        // bind values
        $stmt->bindParam(":success", $item['success']);
        $stmt->bindParam(":trial_type", $item['trial_type']);
        $stmt->bindParam(":time_elapsed", $item['time_elapsed']);
        $stmt->bindParam(":internal_node_id", $item['internal_node_id']);

        // execute query
        if($result = $stmt->execute()){
            return $this->conn->lastInsertId();
        }

        return false;
    }

    public function createTrialData($item){
        // query to insert record
        $query = "INSERT INTO `trial_data`
                SET
                    `trial_id`=:trial_id, 
                    `trial_type`=:trial_type,
                    `trial_index`=:trial_index,
                    `time_elapsed`=:time_elapsed,
                    `screen_focus`=:screen_focus,
                    `internal_node_id`=:internal_node_id,
                    `rt`=:rt,
                    `response_type`=:response_type,
                    `key_press`=:key_press,
                    `avg_frame_time`=:avg_frame_time,
                    `click_x`=:click_x,
                    `click_y`=:click_y,
                    `position`=:position,
                    `cursor_time`=:cursor_time,
                    `file_name`=:file_name";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        $position = json_encode($item->position);
        $cursor_time = json_encode($item->cursor_time);
   
        // bind values
        $stmt->bindParam(":trial_id", $item->trial_id);
        $stmt->bindParam(":trial_type", $item->trial_type);
        $stmt->bindParam(":trial_index", $item->trial_index);
        $stmt->bindParam(":time_elapsed", $item->time_elapsed);
        $stmt->bindParam(":screen_focus", $item->screen_focus);
        $stmt->bindParam(":internal_node_id", $item->internal_node_id);
        $stmt->bindParam(":rt", $item->rt);
        $stmt->bindParam(":response_type", $item->response_type);
        $stmt->bindParam(":key_press", $item->key_press);
        $stmt->bindParam(":avg_frame_time", $item->avg_frame_time);
        $stmt->bindParam(":click_x", $item->click_x);
        $stmt->bindParam(":click_y", $item->click_y);
        $stmt->bindParam(":position", $position);
        $stmt->bindParam(":cursor_time", $cursor_time);
        $stmt->bindParam(":file_name", $item->file_name);


        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}

?>
