<?php 
    class LearningMaterial{
       
        public $learning_material_id;
        public $section_id;
        public $class_id;
        public $course_id;
        public $description;
        public $type;
        public $document_name;

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