<?php 
#DONE BY IAN
require './model/QuestionDAO.php';

class QuestionTest extends \PHPUnit\Framework\TestCase
{   
    public function testInsertQuestion()
    {
        $question = new QuestionDAO();
        $status = $question->insertListing('100', '1', 'TDD Testing Question', 'TDD 1', 'TDD 2', 'TDD 3', 'TDD 4', 'Answer 1', 'MCQ');
        $this->assertEquals(true, $status);

        $dsn = "mysql:host=127.0.0.1;dbname=lms;port=8888";
        $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
        $sql = 'delete from question where quiz_id = "100"';
        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $stmt = null;
        $pdo = null;
    }
}    