<?php 
#DONE BY WEILUN
require './model/Course.php';
require './model/CourseDAO.php';

class CourseTest extends \PHPUnit\Framework\TestCase
{   
    public function testRetrieveQuizById()
    {
        $course = new CourseDAO();
        $status = $course->add('IS123', 'TDD', 'Testing for Course');
        $this->assertEquals(true, $status);
    }

    public function testRetrieveAllCourse()
    {
        $course = new CourseDAO();
        $result = $course->retrieveAllCourse();
        $this->assertTrue($result->course_id != '');
    }

    public function testRetrieveCourseById()
    {
        $course = new CourseDAO();
        $result = $course->retrieveCourseByID('IS123');
        $this->assertTrue($result->course_id != '');
    }

    public function testUpdateCourse()
    {
        $course = new CourseDAO();
        $status = $course->updateCourse('IS123', 'TDD Update', 'Testing Update for Course');
        $result = $course->retrieveCourseByID('IS123');

        $this->assertEquals($result->description, 'Testing Update for Course');
        $this->assertEquals($result->course_name, 'TDD Update');

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
        $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
        $sql = 'delete from course where course_id = "IS123"';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $stmt = null;
        $pdo = null;
    }
}
