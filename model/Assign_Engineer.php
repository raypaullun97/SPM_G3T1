<?php 
    class Assign_Engineer{
        public $engineer_id;
        public $course_id;
        public $class_id;
        
        public function __construct($engineer_id, $course_id,$class_id,$status){
            $this->engineer_id = $engineer_id;           
            $this->course_id = $course_id;
            $this->class_id = $class_id;
            $this->status = $status;

        }
        
    }
?>