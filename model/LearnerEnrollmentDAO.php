<?php
    class LearnerEnrollmentDAO{

        # Add a new user to the database
        public function add($engineer_id, $course_id, $class_id, $status){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into learner_enrollment (engineer_id, course_id, class_id, status) 
                    values (:engineer_id, :course_id, :class_id, :status)";
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
        public function updateStatus($enrollment_id, $status) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "UPDATE learner_enrollment SET status=:status WHERE enrollment_id=:enrollment_id ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":status",$status,PDO::PARAM_STR);
            $stmt->bindParam(":enrollment_id",$enrollment_id,PDO::PARAM_STR);
            $is_update_ok = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $is_update_ok;
        }
        
    }
?>