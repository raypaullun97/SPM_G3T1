<?php 
#DONE BY Jia Xiang
require './model/Section.php';
require './model/SectionDAO.php';

class SectionTest extends \PHPUnit\Framework\TestCase
{   
    public function testInsertSection()
    {
        $section = new SectionDAO();
        $status = $section->insertSection('G10', 'IS123', 'Session 1', 'TDD Testing');
        $this->assertEquals(true, $status);

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
        $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
        $sql = 'delete from section where class_id = "G10" and course_id = "IS123" and section_name = "Session 1" and description = "TDD Testing"';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $stmt = null;
        $pdo = null;
    }
}    