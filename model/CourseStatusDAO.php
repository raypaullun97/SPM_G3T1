<?php
    class CourseStatusDAO{

        # Retrieve a course with a given course_id
        # Return null if no such course exists
        public function retrieveStatus($course_id, $engineer_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "SELECT status from course_status where engineer_id = $engineer_id and course_id = $course_id ";
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

    }
?>