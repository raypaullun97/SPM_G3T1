<?php 
    class LearningMaterialDAO{

        #Insert new Learning Material 
        public function insert_learning_material_complete($learning_material_id, $engineer_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = "INSERT into learning_material_complete values (:learning_material_id, :engineer_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":learning_material_id", $learning_material_id);
            $stmt->bindParam(":engineer_id", $engineer_id);
            $status= $stmt->execute();
            $stmt = null;
            $pdo = null;
            return $status;
        }

        public function retrieve_learning_material_complete($learning_material_id, $engineer_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = "select * from learning_material_complete where learning_material_id = :learning_material_id and engineer_id =:engineer_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":learning_material_id", $learning_material_id);
            $stmt->bindParam(":engineer_id", $engineer_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $learning_material_complete= null
            if($row = $stmt->fetch()){   
                $learning_material_complete = new LearningMaterialComplete($row["learning_material_id"],$row["engineer_id"]);
            }
            $stmt = null;
            $pdo = null;
            return $learning_material_complete;
        }
    }
?>