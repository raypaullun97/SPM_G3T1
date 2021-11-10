<?php 
# Done by Jia Cheng 

require './model/LearningMaterialComplete.php';
require './model/LearningMaterialCompleteDAO.php';


class LearningMaterialCompleteTest extends \PHPUnit\Framework\TestCase
{

    public function testInsertLearningMaterialComplete()
    {
        $learning_material = new LearningMaterialCompleteDAO();
        $status = $learning_material->insert_learning_material_complete('100', '1');
        $this->assertEquals(true, $status);
    }

    public function testRetrieveLearningMaterialComplete()
    {
        $learning_material = new LearningMaterialCompleteDAO();
        $result = $learning_material->retrieve_learning_material_complete('100', '1');
        $this->assertTrue($result->learning_material_id == '100');
        $this->assertTrue($result->engineer_id == '1');

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
        $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
        $sql = 'delete from learning_material_complete where learning_material_id = "100" and engineer_id = "1"';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $stmt = null;
        $pdo = null;
    }
}