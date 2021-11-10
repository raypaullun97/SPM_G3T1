<?php
# Done by Cheryl 

require './model/Assign_Engineer.php';
require './model/Assign_EngineerDAO.php';

class Assign_EngineerTest extends \PHPUnit\Framework\TestCase
{   
    public function testAddEngineer()
    {
        $engineer = new Assign_EngineerDAO();
        $status = $engineer->addEngineer('10','IS453', 'G1','Pending');
        $this->assertEquals(true, $status);
    }

    public function testAddEngineerCourseStatus()
    {
        $engineer = new Assign_EngineerDAO();
        $status = $engineer->addEngineer_course_status('10','IS453','Incomplete');
        $this->assertEquals(true, $status);

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
        $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
        $sql = 'delete from course_status where engineer_id = "10" and course_id = "IS453" and status = "Incomplete"';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":engineer", $engineer_id);
        $stmt->bindParam(":course_id", $course_id);
        $stmt->bindParam(":status2", $status2);

        $stmt->execute();

        $stmt = null;
        $pdo = null;

    }

    public function testRetrieveAllEnrollment()
    {
        $engineer = new Assign_EngineerDAO();
        $result = $engineer->retrieveAllenrollment();
        $this->assertTrue($result->engineer_id != '');

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
        $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
        $sql = 'delete from learner_enrollment where engineer_id = "10" and course_id = "IS453" and class_id = "G1" and status = "Pending"';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $stmt = null;
        $pdo = null;
    }
}
