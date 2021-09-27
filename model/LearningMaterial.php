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


        public function search($section_id){
            $query = "SELECT * FROM learning_material where section_id = :section_id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":section_id", $section_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        }
    }
?>