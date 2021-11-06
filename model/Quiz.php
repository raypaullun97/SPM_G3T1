<?php 
    class Quiz{
        public $quiz_id;
        public $course_id;
        public $class_id;
        public $section_id;
        public $engineer_id;
        public $passing_mark;
        public $time_limit;
        public $type;
        public $quiz_name;
        
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