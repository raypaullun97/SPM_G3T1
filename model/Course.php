<?php 
    class Course{
        private $course_id;
        private $course_name;
        private $description;
        
        public function __construct($course_id,$course_name, $description){
            $this->course_id = $course_id;
            $this->course_name = $course_name;
            $this->description = $description;


        }
        
    }
?>