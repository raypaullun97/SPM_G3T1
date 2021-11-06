<?php 
    class Section{
        public $section_id;
        public $class_id;
        public $section_name;
        public $description;

        public function __construct($section_id,$class_id, $section_name, $description){
            $this->section_id = $section_id;
            $this->class_id = $class_id;
            $this->section_name = $section_name;
            $this->description = $description;
        }
    }
?>