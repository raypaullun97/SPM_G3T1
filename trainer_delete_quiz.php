<?php 
spl_autoload_register(
    function($class){
        require_once "model/$class.php";
    }
);

function deleteQuestion($quiz_id)
{
    $dsn = "mysql:host=localhost;dbname=lms;port=8888";
    $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
    $sql = 'delete from question where quiz_id = :temp';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":temp", $quiz_id);
    $delQuestionStatus = $stmt->execute();
    $stmt = null;
    $pdo = null;
    
    return $delQuestionStatus;
}

function deleteQuiz($quiz_id)
{
    $dsn = "mysql:host=localhost;dbname=lms;port=8888";
    $pdo = new PDO($dsn,"root",'MCWUlrGKEOi2');
    $sql = 'delete from quiz where quiz_id = :temp';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":temp", $quiz_id);
    $delQuizStatus = $stmt->execute();
    $stmt = null;
    $pdo = null;

    return $delQuizStatus;
}

    $quiz_id = $_GET['quiz_id'];
    $delQuizStatus = deleteQuiz($quiz_id);

    if ($delQuizStatus)
    {
        $delQuestionStatus = deleteQuestion($quiz_id);
        
        if ($delQuestionStatus)
        {
            header('Location: trainer_view_section.php?course_id='.$_GET["course_id"].'&class_id='.$_GET["class_id"]);
        }
    }
?>