<?php 
    class LearningMaterialComplete{
        public $learning_material_id;
        public $engineer_id;

        public function __construct($learning_material_id,$engineer_id){
            $this->learning_material_id = $learning_material_id;
            $this->engineer_id = $engineer_id;
        }
    }
?>