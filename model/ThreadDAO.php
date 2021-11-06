<?php
    class ThreadDAO{

        # Add a new user to the database
        public function add($forum_id, $description, $engineer_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into thread (forum_id, description, engineer_id) 
                    values (:forum_id, :description, :engineer_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":forum_id",$forum_id);
            $stmt->bindParam(":description",$description);
            $stmt->bindParam(":engineer_id",$engineer_id);
            $status = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $status;
        }
        
    }
?>