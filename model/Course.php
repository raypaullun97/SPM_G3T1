<?php 
    class Course{
        public $course_id;
        public $course_name;
        public $description;
        
        public function __construct($course_id,$course_name, $description){
            $this->course_id = $course_id;
            $this->course_name = $course_name;
            $this->description = $description;


        }
        
    }
?>