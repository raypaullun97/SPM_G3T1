<?php 
require './model/Quiz.php';
require './model/QuizDAO.php';

class QuizTest extends \PHPUnit\Framework\TestCase
{   
    public function testInsertQuiz()
    {
        $quiz = new QuizDAO();
        $status = $quiz->createQuiz('G2', 'IS212', '8', '3', '50', '10', 'Ungraded', 'TestTDD');
        $this->assertEquals(true, $status);
    }
}