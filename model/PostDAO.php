<?php
    class PostDAO{

        # Add a new user to the database
        public function add($thread_id, $p_description, $engineer_id, $post_time, $post_date){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into post (thread_id, p_description, engineer_id, post_time, post_date) 
                    values (:thread_id, :p_description, :engineer_id, :post_time, :post_date)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":thread_id",$thread_id);
            $stmt->bindParam(":p_description",$p_description);
            $stmt->bindParam(":engineer_id",$engineer_id);
            $stmt->bindParam(":post_time",$post_time);
            $stmt->bindParam(":post_date",$post_date);
            $status = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $status;
        }
        
    }
?>