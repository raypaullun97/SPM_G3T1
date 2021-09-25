<?php 
    class User{
        public function __construct($section_id,$class_id, $section_name, $description,){
            $this->section_id = $section_id;
            $this->class_id = $class_id;
            $this->section_name = $section_name;
            $this->description = $description;
         
        }
        public function getSectionID(){
            return $this->section_id;
        }
        public function getClassID(){
            return $this->class_id;
        }
        public function getSectionName(){
            return $this->section_name;
        }
        public function getSectionDesciption(){
            return $this->description;
        }
    }
?>