<?php 
    # Done by Jia Cheng

    require './model/LearningMaterialDAO.php';
    require './model/LearningMaterial.php';

    class LearningMaterialTest extends \PHPUnit\Framework\TestCase {

        public function testselectLearningMaterialById() {
            $learning = new LearningMaterialDAO;
            $result = $learning->select_learning_material_by_id(3);
            $this->assertEquals('6', $result->section_id);
            $this->assertEquals('G2', $result->class_id);
            $this->assertEquals('IS212', $result->course_id);
        }

        public function testselectLearningMaterialByCourse() {
            $learning = new LearningMaterialDAO;
            $result = $learning->select_learning_material_by_course('G2', 'IS212', '4');
            $this->assertTrue($result->learning_material_id != '');
        }

        public function testdeleteLearningMaterial() {
            $learning = new LearningMaterialDAO;
            $result = $learning->delete_learning_material('4');
            $this->assertEquals(TRUE, $result);
        }

        public function testUpdateLearningMaterial() {
            $learning = new LearningMaterialDAO;
            $result = $learning->update_learning_material('4', 'G2' ,'IS212', 'Week1 Updated', '.pptx', 'Data Mining', 1);

            $learning_material_id= 1;
            $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
            $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
            $sql = "select * from learning_material where learning_material_id = :learning_material_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':learning_material_id', $learning_material_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $learning_material= null;
            if($row = $stmt->fetch()){   
                $learning_material = new LearningMaterial($row["learning_material_id"],$row["section_id"],$row["class_id"],$row["course_id"],$row["description"],$row["type"],$row["document_name"]);
            }
            
            $stmt = null;
            $pdo = null;
            $learning_material;

            $this->assertEquals('Week1 Updated', $learning_material->description);
        }
    }

?>