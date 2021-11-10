<?php 
#DONE BY CHERYL
require './model/ClassDAO.php';

class ClassTest extends \PHPUnit\Framework\TestCase
{
    public function testAddClass() 
    {
        $class = new ClassDAO;
        $status = $class->add('G1', 'IS453', '45', '3', '2021-11-01', '2021-11-12', '2021-12-01',
        '2021-12-25', '12:00:00', '14:30:00', '10');

        $this->assertEquals(true, $status);
    }

    public function testUpdateClass()
    {
        $class = new ClassDAO();
        $status = $class->update('G1', 'IS453', '20', '5', '2021-11-01', '2021-11-12', '2021-12-01',
        '2021-12-25', '12:00:00', '15:00:00', '10');
        $this->assertEquals(true, $status);

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
        $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
        $sql = 'delete from class where course_id = "IS453" and class_id = "G1"';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $stmt = null;
        $pdo = null;
    }



}