<require_
<?php
    class CourseDAO{

        # Add a new user to the database
        public function add($course_id, $course_name, $description){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into course (course_id, course_name, description) 
                    values (:course_id, :course_name, :description)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->bindParam(":course_name",$course_name);
            $stmt->bindParam(":description",$description);
            $status = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $status;
        }
        public function retrieveAllCourse(){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from course";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            $course = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $course = new Course($row["course_id"],$row["course_name"],$row["description"] );
            }
            
            $stmt = null;
            $pdo = null;
            return $course;
        }
        # Retrieve a course with a given course_id
        # Return null if no such course exists
        public function retrieveCourseByID($course_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from course where course_id=:course_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":course_id",$course_id,PDO::PARAM_STR);
            $stmt->execute();
            
            $course = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $course = new Course($row["course_id"],$row["course_name"],$row["description"] );
            }
            
            $stmt = null;
            $pdo = null;
            return $course;
        }
        public function updateCourse($course_id, $course_name, $description) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "UPDATE course SET course_id=:course_id, course_name=:course_name, description=:description WHERE course_id=:course_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":course_id",$course_id,PDO::PARAM_STR);
            $stmt->bindParam(":course_name",$course_name,PDO::PARAM_STR);
            $stmt->bindParam(":description",$description,PDO::PARAM_STR);
            $is_update_ok = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $is_update_ok;
        }
    }
?>