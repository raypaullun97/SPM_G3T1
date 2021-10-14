<?php
    class Assign_EngineerDAO{

        # Add engineer to class into the database
        public function addEngineer($engineer_id,$course_id, $class_id,$status){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into learner_enrollment (engineer_id,course_id, class_id, status) 
                    values (:engineer_id, :course_id ,:class_id, :status)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":engineer_id",$engineer_id);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->bindParam(":class_id",$class_id);
            $stmt->bindParam(":status",$status);
            $status = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $status;
        }
        public function retrieveAllenrollment(){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from learner_enrollment";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            $enrollment = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $enrollment = new Assign_Engineer($row["engineer_id"],$row["course_id"],$row["class_id"],$row["status"]);
            }
            
            $stmt = null;
            $pdo = null;
            return $enrollment;
        }       
        public function updateEnrollment($engineer_id, $course_id,$class_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "UPDATE learner_enrollment SET engineer_id=:engineer_id, course_id=:course_id, class_id=:class_id, status=:status  WHERE enrollmentid_id=:enrollment_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":engineer_id",$engineer_id,PDO::PARAM_STR);
            $stmt->bindParam(":course_id",$course_id,PDO::PARAM_STR);
            $stmt->bindParam(":class_id",$class_id,PDO::PARAM_STR);
            $stmt->bindParam(":status",$status,PDO::PARAM_STR);

            $is_update_ok = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $is_update_ok;
        }
    }
?>