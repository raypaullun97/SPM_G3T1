<?php 
    class LearningMaterial{
       
        private $learning_material_id;
        private $section_id;
        private $class_id;
        private $course_id;
        private $description;
        private $type;
        private $document_name;

        public function __construct($learning_material_id, $section_id, $class_id, $course_id, $description, $type, $document_name){
            $this->learning_material_id = $learning_material_id;
            $this->section_id = $section_id;
            $this->class_id = $class_id;
            $this->course_id = $course_id;
            $this->description = $description;
            $this->type = $type;
            $this->document_name = $document_name;
    }
}
?>