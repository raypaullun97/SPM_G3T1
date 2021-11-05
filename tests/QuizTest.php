<?php 
require './model/Quiz.php';
require './model/QuizDAO.php';
$quiz = new QuizDAO();

class QuizTest extends \PHPUnit\Framework\TestCase
{   
    public function testInsertQuiz()
    {
        $status = $quiz->createQuiz('G2', 'IS212', '8', '3', '50', '10', 'Ungraded', 'TestTDD');
        $this->assertEquals(true, $status);
    }


}