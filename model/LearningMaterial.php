<?php 
    class LearningMaterial{
        private $conn;
        private $table_name = 'learning_material';

        public $learning_material_id;
        public $section_id;
        public $description;
        public $type;
        public $document_name;

        public function __construct($db){
            $this->conn = $db;
        }


        public function search($section_id, $class_id){
            $query = "SELECT * FROM learning_material where section_id = :section_id and class_id= :class_id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":section_id", $section_id, PDO::PARAM_STR);
            $stmt->bindParam(":class_id", $class_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        }

        public function insert($section_id,$class_id, $description, $type, $document_name){
            $query = "INSERT into learning_material (section_id, description, type, document_name) values (:section_id, :class_id, :description, :type, :document_name)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":section_id", $section_id, PDO::PARAM_STR);
            $stmt->bindParam(":class_id", $class_id, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":type", $type, PDO::PARAM_STR);
            $stmt->bindParam(":document_name", $document_name, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt;

        }
    }
?>