<?php 
    class Quiz{
        private $quiz_id;
        private $course_id;
        private $class_id;
        private $section_id;
        private $engineer_id;
        private $passing_mark;
        private $time_limit;
        private $type;
        private $quiz_name;
        
        public function __construct($quiz_id, $course_id, $class_id, $section_id, $engineer_id, $passing_mark, $time_limit, $type, $quiz_name){
            $this->quiz_id = $quiz_id;
            $this->course_id = $course_id;
            $this->class_id = $class_id;
            $this->section_id = $section_id;
            $this->engineer_id = $engineer_id;
            $this->passing_mark = $passing_mark;
            $this->time_limit = $time_limit;
            $this->type = $type;
            $this->quiz_name = $quiz_name;



        }
        
    }
?>