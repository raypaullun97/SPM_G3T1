<?php
    class SectionDAO{

        # Add a new user to the database
        function insertSection($class_id, $course_id, $section_name, $description){
            $conn_manager = new ConnectionManager();
            $pdo = $conn_manager->getConnection();
            $sql = 'insert into section(`class_id`, `course_id`,`section_name`, `description`) VALUES 
            (:class_id, :course_id, :section_name, :description)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":class_id",$class_id);
            $stmt->bindParam(":course_id",$course_id);
            $stmt->bindParam(":section_name",$section_name);
            $stmt->bindParam(":description",$description);

            $status = $stmt->execute();
            $stmt = null;
            $pdo = null;

            return $status;
         }
    }
?>