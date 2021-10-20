<?php
    class LearningMaterialDAO{

        #Insert new Learning Material 
        public function insert_learning_material($section_id, $class_id, $course_id, $description, $type, $document_name){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = "INSERT into learning_material (`section_id`, `class_id`,`course_id`, `description`, `type`, `document_name`) values (:section_id, :class_id, :course_id,:description, :type, :document_name)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":section_id", $section_id);
            $stmt->bindParam(":class_id", $class_id);
            $stmt->bindParam(":course_id", $course_id);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":type", $type);
            $stmt->bindParam(":document_name", $document_name);
            $status= $stmt->execute();
              
            $stmt = null;
            $pdo = null;
            return $status;
        }

        #Update Learning Material
        public function update_learning_material($section_id, $class_id ,$course_id, $description, $type, $document_name, $learning_material_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $query = 'UPDATE learning_material SET section_id=:section_id, class_id=:class_id, course_id=:course_id, description=:description, type=:type, document_name = :document_name where learning_material_id = :learning_material_id';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":section_id", $section_id);
            $stmt->bindParam(":class_id", $class_id);
            $stmt->bindParam(":course_id", $course_id);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":type", $type);
            $stmt->bindParam(":document_name", $document_name);
            $stmt->bindParam(":learning_material_id", $learning_material_id);
        
            $status= $stmt->execute();
            $stmt = null;
            $pdo = null;
        
            return $status;
        }

        #Select Learning Material by course
        public function select_learning_material_by_course($class_id, $course_id, $section_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = "select * from learning_material lm inner join section s on lm.class_id = s.class_id and lm.section_id = s.section_id and lm.course_id = s.course_id where lm.class_id=:class_id and s.section_id = :section_id and s.course_id = :course_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':class_id', $class_id);
            $stmt->bindParam(':course_id', $course_id);
            $stmt->bindParam(':section_id', $section_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $learning_material= null;
            if($row = $stmt->fetch()){   
                $learning_material = new LearningMaterial($row["learning_material_id"],$row["section_id"],$row["class_id"],$row["course_id"],$row["description"],$row["type"],$row["document_name"]);
            }
            $stmt = null;
            $pdo = null;
            return $learning_material;
        }

        public function select_learning_material_by_id($learning_material_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = "select * from learning_material where learning_material_id = :learning_material_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':learning_material_id', $learning_material_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $learning_material= null;
            if($row = $stmt->fetch()){   
                $learning_material = new LearningMaterial($row["learning_material_id"],$row["section_id"],$row["class_id"],$row["course_id"],$row["description"],$row["type"],$row["document_name"]);
            }
            $stmt = null;
            $pdo = null;
            return $learning_material;
        }


        public function delete_learning_material($learning_material_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = "DELETE FROM learning_material WHERE learning_material_id = :learning_material_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':learning_material_id', $learning_material_id);
            $status= $stmt->execute();
            $stmt = null;
            $pdo = null;
            return $status;
        }

    }
?>