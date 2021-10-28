<?php
    class QuizDAO{

        # Add a new user to the database
        public function add($class_id, $course_id, $section_id, $engineer_id, $passing_mark, $time_limit, $type, $quiz_name){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = 'insert into quiz(`class_id`, `course_id`,`section_id`, `engineer_id`, `passing_mark`, `time_limit`, `type`, `quiz_name`) VALUES 
            (:class_id, :course_id, :section_id, :engineer_id, :passing_mark, :time_limit, :type, :quiz_name)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":class_id",$class_id);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->bindParam(":section_id",$section_id);
            $stmt->bindParam(":engineer_id",$engineer_id);
            $stmt->bindParam(":passing_mark",$passing_mark);
            $stmt->bindParam(":time_limit",$time_limit);
            $stmt->bindParam(":type",$quiz_type);
            $stmt->bindParam(":quiz_name",$quiz_name);

            $status = $stmt->execute();
            $stmt = null;
            $pdo = null;

            return $status;
        }

        public function retrieveLastQuizId()
        {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = '
            SELECT quiz_id FROM `quiz` order by quiz_id DESC limit 1
            ';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            if($row = $stmt->fetch()){
                $lastQuiz_id = $row['quiz_id'];
            }

            $stmt = null;
            $pdo = null;

            return $lastQuiz_id;
        }

        # Retrieve a quiz with a given course_id, class_id and section_id
        # Return null if no such course exists
        public function retrieveCourseByID($course_id, $class_id, $section_id){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $sql = "select * from quiz where course_id=:course_id and class_id = :class_id and section_id = :section_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":course_id",$course_id,PDO::PARAM_STR);
            $stmt->bindParam(":class_id",$class_id);
            $stmt->bindParam(":section_id",$section_id);

            $stmt->execute();
            
            $quiz = null;
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($row = $stmt->fetch()){
                $quiz = new Quiz($quiz_id, $course_id, $class_id, $section_id, $engineer_id, $passing_mark, $time_limit, $type, $quiz_name);
            }
            
            $stmt = null;
            $pdo = null;
            return $quiz;
        }
        public function updateQuiz($quiz_id, $quiz_name, $passing_mark, $time_limit, $type) {
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            
            $query = 'UPDATE quiz set quiz_name = :quiz_name, passing_mark = :passing_mark, time_limit = :time_limit, type = :type where quiz_id = :quiz_id';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":quiz_name", $quiz_name);
            $stmt->bindParam(":passing_mark", $passing_mark);
            $stmt->bindParam(":time_limit", $time_limit);
            $stmt->bindParam(":type", $type);
            $stmt->bindParam(":quiz_id", $quiz_id);

            $stmt->execute();
            $stmt = null;
            $pdo = null;

            return; 
        }
    }
?>