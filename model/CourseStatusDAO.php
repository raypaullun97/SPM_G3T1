<?php
    class CourseStatusDAO{

        # Retrieve a course with a given course_id
        # Return null if no such course exists
        public function retrieveStatus($course_id, $engineer_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "SELECT status from course_status where engineer_id = :engineer_id and course_id = :course_id ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":engineer_id",$engineer_id,PDO::PARAM_STR);
            $stmt->bindParam(":course_id",$course_id,PDO::PARAM_STR);
            $stmt->execute();
            
            $course = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            if($row = $stmt->fetch()){
                $course = new CourseStatus($row["status"]);
                
            }
            
            $stmt = null;
            $pdo = null;
            return $course;
        }
        public function deleteCourseStatusDAO($engineer_id, $course_id) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "DELETE FROM course_status  WHERE engineer_id=:engineer_id and course_id =:course_id ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":course_id",$course_id,PDO::PARAM_STR);
            $stmt->bindParam(":engineer_id",$engineer_id,PDO::PARAM_STR);
            $is_update_ok = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $is_update_ok;
        }

        public function insertCourseStatus($engineer_id, $course_id, $status)
        {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = 'insert into course_status(`course_id`, `engineer_id`, `status`) VALUES 
            (:course_id, :engineer_id, :status)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":status",$status);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->bindParam(":engineer_id",$engineer_id);

            $insertStatus = $stmt->execute();
            $stmt = null;
            $pdo = null;

            return $insertStatus;
        }

    }
?>