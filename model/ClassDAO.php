<?php
    class ClassDAO{

        # Add a new user to the database
        public function add($class_id, $course_id, $capacity, $day, $start_register_date, $end_register_date, $start_date,
                            $end_date, $start_time, $end_time, $engineer_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "insert into class (class_id, course_id, capacity, day, start_register_date, end_register_date, start_date, end_date, start_time, end_time, engineer_id) 
                    values (:class_id, :course_id, :capacity, :day, :start_register_date, :end_register_date, :start_date, :end_date, :start_time, :end_time, :engineer_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":class_id",$class_id);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->bindParam(":capacity",$capacity);
            $stmt->bindParam(":day",$day);
            $stmt->bindParam(":start_register_date",$start_register_date);
            $stmt->bindParam(":end_register_date",$end_register_date);
            $stmt->bindParam(":start_date",$start_date);
            $stmt->bindParam(":end_date",$end_date);
            $stmt->bindParam(":start_time",$start_time);
            $stmt->bindParam(":end_time",$end_time);
            $stmt->bindParam(":engineer_id",$engineer_id);
            $status = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $status;
        }
        
        # Retrieve a course with a given course_id
        # Return null if no such course exists
        
        public function update($class_id, $course_id, $capacity, $day, $start_register_date, $end_register_date, $start_date,
        $end_date, $start_time, $end_time, $engineer_id) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "UPDATE course SET class_id=:class_id, course_id=:course_id, capacity=:capacity 
                    , day=:day, start_register_date=:start_register_date
                    , end_register_date=:end_register_date, start_date=:start_date
                    , end_date=:end_date, start_time=:start_time
                    , end_time=:end_time, engineer_id=:engineer_id WHERE class_id=:class_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":class_id",$class_id,PDO::PARAM_STR);
            $stmt->bindParam(":course_name",$course_name,PDO::PARAM_STR);
            $stmt->bindParam(":description",$description,PDO::PARAM_STR);
            $is_update_ok = $stmt->execute();
            
            $stmt = null;
            $pdo = null;
            return $is_update_ok;
        }
    }
?>