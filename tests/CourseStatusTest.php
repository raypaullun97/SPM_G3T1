<?php 
require './model/CourseStatus.php';
require './model/CourseStatusDAO.php';


class CourseStatusTest extends \PHPUnit\Framework\TestCase
{

    public function testInsertStatus()
    {
        $courseStatus = new CourseStatusDAO();
        $status = $courseStatus->insertCourseStatus('1', 'IS123', 'Incomplete');
        $this->assertEquals(true, $status);
    }

    public function testRetrieveStatus() 
    {
        $courseStatus = new CourseStatusDAO();
        $result = $courseStatus->retrieveStatus('IS123','1' );
        $this->assertTrue($result->status != '');
    }

    public function testDeleteStatus()
    {
        $courseStatus = new CourseStatusDAO();
        $status = $courseStatus->deleteCourseStatusDAO('1', 'IS123');
        $this->assertEquals(true, $status);
    }



}