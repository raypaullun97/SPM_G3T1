<?php 
require './model/Quiz.php';
require './model/QuizDAO.php';

class QuizTest extends \PHPUnit\Framework\TestCase
{   
    public function testRetrieveQuizById()
    {
        $quiz = new QuizDAO();
        $result = $quiz->retrieveQuizByID('IS212', 'G2', '5');
        $this->assertEquals('IS212', $result->course_id);
        $this->assertEquals('G2', $result->class_id);
        $this->assertEquals('5', $result->section_id);
    }

    public function testRetrieveLastQuizId()
    {
        $quiz = new QuizDAO();
        $insert_status = $quiz->createQuiz('G2', 'IS212', '10', '3', '50', '10', 'Ungraded', 'TestTDD');
        $result = $quiz->retrieveQuizByID('IS212', 'G2', '10');
        $test_result = $quiz->retrieveLastQuizId();
        $this->assertEquals($result->quiz_id, $test_result);

        $status = $quiz->deleteQuiz($result->quiz_id);
        $this->assertEquals(true, $status);

    }
    public function testInsertQuiz()
    {
        $quiz = new QuizDAO();
        $status = $quiz->createQuiz('G2', 'IS212', '11', '3', '50', '10', 'Ungraded', 'TestInsertQuiz');
        $this->assertEquals(true, $status);
    }

    public function testUpdateQuiz()
    {
        $quiz = new QuizDAO();
        $result = $quiz->retrieveQuizByID('IS212', 'G2', '11');

        $status = $quiz->updateQuiz($result->quiz_id, 'UpdateQuizTest', '1', '1', 'Graded');
        $result = $quiz->retrieveQuizByID('IS212', 'G2', '11');

        $this->assertEquals($result->quiz_name, 'UpdateQuizTest');
        $this->assertEquals($result->passing_mark, '1');
        $this->assertEquals($result->time_limit, '1');
        $this->assertEquals($result->type, 'Graded');
    }

    public function testDeleteQuiz()
    {
        $quiz = new QuizDAO();
        $result = $quiz->retrieveQuizByID('IS212', 'G2', '11');
        $status = $quiz->deleteQuiz($result->quiz_id);
        $this->assertEquals(true, $status);
    }
}
